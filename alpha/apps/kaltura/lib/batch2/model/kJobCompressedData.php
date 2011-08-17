<?php
/**
 * @package Core
 * @subpackage model.data
 */
class kJobCompressedData extends kJobData
{
	/**
	 * the compressed job's data
	 * @var string
	 */
	private $compressedData;
	
	public function kJobCompressedData($value){
		$this->compressedData = $value;
	}
	
	public function getCompressedData(){
		return $this->compressedData;
	}
	
}
