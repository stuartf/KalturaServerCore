<?php

class PdfFlavorParams extends flavorParams implements PdfFlavorParamsInterface
{
	
	//TODO: which TAGS are valid ??
	
	// -- Conversion Parameters --
	
	public function setResolution($resolution)
	{
		parent::putInCustomData('resolution', $resolution);
	}
	
	public function getResolution()
	{
		return parent::getFromCustomData('resolution');
	}
	
	
	// -- Paper size --
	
	public function setPaperHeight($height)
	{
		parent::putInCustomData('paperHeight', $height);
	}
	
	public function getPaperHeight()
	{
		return parent::getFromCustomData('paperHeight');
	}
	
	public function setPaperWidth($width)
	{
		parent::putInCustomData('paperWidth', $width);
	}
	
	public function getPaperWidth()
	{
		return parent::getFromCustomData('paperWidth');
	}

	/**
	 * @param bool $isReadonly
	 */
	public function setReadonly($isReadonly)
	{
		parent::putInCustomData('readonly', $isReadonly);
	}
	
	/**
	 * @return bool
	 */
	public function getReadonly()
	{
		return parent::getFromCustomData('readonly');
	}
	
}