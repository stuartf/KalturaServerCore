<?php

function dictArray()
{
	return array();
}

function arrValues($arr)
{
	return $arr;
}

function globalCallback($name)
{
	return $name;
}

function staticCallback($cbClass, $cbName)
{
	return array($cbClass, $cbName);
}
