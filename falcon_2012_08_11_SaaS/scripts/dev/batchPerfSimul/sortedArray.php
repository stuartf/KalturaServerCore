<?php

define('MIN_SEGMENT_SIZE', 15);
define('MAX_SEGMENT_SIZE', 75);

function binary_search($array, $getOrderFunc, $searchedValue, $context = null)
{
	$low = 0;
	$high = Count($array) - 1;
	
	while ( $high >= $low )
	{
		$probe = intval(($high + $low) / 2);
		$comparison = call_user_func($getOrderFunc, $array[$probe], $context) - $searchedValue;
		if ($comparison < 0)
		{
			$low = $probe + 1;
		}
		elseif ($comparison > 0)
		{
			$high = $probe - 1;
		}
		else
		{
			$low = $probe;
			break;
		}
	}
	
	return $low;
}

class SortedArraySegment
{
	function __construct($getKeyFunc, $getKeyFuncContext, $elements = array())
	{
		$this->elements = $elements;
		$this->getKeyFunc = $getKeyFunc;
		$this->getKeyFuncContext = $getKeyFuncContext;
	}
	
	static function getFirstKey($segment, $context)
	{
		return call_user_func($segment->getKeyFunc, $segment->elements[0], $segment->getKeyFuncContext);
	}
	
	function insert($object, $key)
	{
		$index = binary_search($this->elements, $this->getKeyFunc, $key, $this->getKeyFuncContext);
		array_splice($this->elements, $index, 0, array($object));
	}

	function insertTail($object)
	{
		$this->elements[] = $object;
	}
	
	function getCount()
	{
		return count($this->elements);
	}
	
	function &getAt($index)
	{
		return $this->elements[$index];
	}
	
	function split()
	{
		$splitOffset = intval($this->getCount() / 2);
		return array(
			new SortedArraySegment($this->getKeyFunc, $this->getKeyFuncContext, array_slice($this->elements, 0, $splitOffset)), 
			new SortedArraySegment($this->getKeyFunc, $this->getKeyFuncContext, array_slice($this->elements, $splitOffset))
			);
	}
	
	function removeAt($index)
	{
		array_splice($this->elements, $index, 1);
	}

	function getHead()
	{
		return $this->elements[0];
	}
}

class SortedArray
{
	const FAW_CONTINUE = 0;
	const FAW_STOP = 1;
	const FAW_STOP_REMOVE = 2;

	function __construct($getKeyFunc, $getKeyFuncContext = null)
	{
		$this->segments = array();
		$this->elemCount = 0;
		$this->getKeyFunc = $getKeyFunc;
		$this->getKeyFuncContext = $getKeyFuncContext;
	}
		
	function insert($object, $key = null)
	{
		if ($key === null)
		{
			$key = call_user_func($this->getKeyFunc, $object, $this->getKeyFuncContext);
		}
	
		# create initial segment if needed
		if ($this->elemCount == 0)
		{
			$this->segments[] = new SortedArraySegment($this->getKeyFunc, $this->getKeyFuncContext);
			$this->segments[0]->insert($object, $key);
			$this->elemCount++;
			return;
		}
		
		# find the index of the segment to insert to
		$segmentIndex = binary_search($this->segments, array('SortedArraySegment', 'getFirstKey'), $key);
		if ($segmentIndex > 0)
		{
			$segmentIndex--;
		}
		$targetSegment = &$this->segments[$segmentIndex];
		
		# insert to segment
		$targetSegment->insert($object, $key);
		$this->elemCount++;
		
		# split the segment if needed
		if ($targetSegment->getCount() < MAX_SEGMENT_SIZE)
		{
			return;
		}
		
		$splittedSegment = $targetSegment->split();
		array_splice($this->segments, $segmentIndex, 1, $splittedSegment);
	}

	function insertTail($object)
	{
		# create initial segment if needed
		if ($this->elemCount == 0)
		{
			$this->segments[] = new SortedArraySegment($this->getKeyFunc, $this->getKeyFuncContext);
		}
		
		# find the index of the segment to insert to
		$segmentIndex = count($this->segments) - 1;
		$targetSegment = &$this->segments[$segmentIndex];

		# insert to segment
		$targetSegment->insertTail($object);
		$this->elemCount++;
		
		# split the segment if needed
		if ($targetSegment->getCount() < 200)
		{
			return;
		}
		
		$splittedSegment = $targetSegment->split();
		array_splice($this->segments, $segmentIndex, 1, $splittedSegment);
	}
	
	function removeElement($segmentIndex, $elemIndex)
	{
		$this->elemCount--;
		
		# remove all
		if ($this->elemCount == 0)
		{
			$this->segments = array();
			return;
		}

		# remove from segment
		$curSeg = &$this->segments[$segmentIndex];
		$curSeg->removeAt($elemIndex);
		
		# merge segments if needed
		if ($curSeg->getCount() >= MIN_SEGMENT_SIZE || count($this->segments) <= 1)
		{
			return;
		}

		if ($segmentIndex >= count($this->segments) - 1 ||
			($segmentIndex > 0 && 
			 $this->segments[$segmentIndex - 1]->getCount() < $this->segments[$segmentIndex + 1]->getCount()))
		{
			$segmentIndex--;
		}
		$joinedElems = array_merge($this->segments[$segmentIndex]->elements, $this->segments[$segmentIndex + 1]->elements);
		$joinedSegment = new SortedArraySegment($this->getKeyFunc, $this->getKeyFuncContext, $joinedElems);
		array_splice($this->segments, $segmentIndex, 2, array($joinedSegment));
	}
	
	function walk($callback, $context = null)
	{
		$segCount = count($this->segments);
		for ($segmentIndex = 0; $segmentIndex < $segCount; $segmentIndex++)
		{
			$curSeg = &$this->segments[$segmentIndex];
			$curSegElemCount = $curSeg->getCount();
			for ($elemIndex = 0; $elemIndex < $curSegElemCount; $elemIndex++)
			{
				$curElem = $curSeg->getAt($elemIndex);
				$callbackResult = call_user_func($callback, $curElem, $context);
				switch ($callbackResult)
				{
				case self::FAW_CONTINUE:
					break;
				case self::FAW_STOP:
					return $curElem;
				case self::FAW_STOP_REMOVE:
					$this->removeElement($segmentIndex, $elemIndex);
					return $curElem;
				}
			}
		}
		
		return null;
	}
	
	function getHead()
	{
		return $this->segments[0]->getHead();
	}

	function removeHead()
	{
		$result = $this->getHead();
		$this->removeElement(0, 0);
		return $result;
	}
	
	function getCount()
	{
		return $this->elemCount;
	}
}
