<?php
# Parameteres
$working_dc = 0;
# Init
$dc = array('pa','ny');
$filePath_src = dirname(__FILE__).'/src_'.$dc[$working_dc].'.txt';
$filePath_log = dirname(__FILE__).'/output.log';
function log_insert($fptr,$str) {
	fwrite($fptr,date('M-d-Y H:i:s').'|'.$str."\r\n");
}
# Run
$fLogPtr = fopen($filePath_log,'w') or die("Error opening file: $filePath_log");
$fileLines = file($filePath_src) or die("Error opening file: $filePath_src");
foreach($fileLines as $line) {
	$lineComponent = explode('|',$line);
	if(file_exists('/web'.$lineComponent[1])) {
		$dbSize = $lineComponent[0];
		clearstatcache();
		$hddSize = filesize('/web'.$lineComponent[1]);
		if ($dbSize != $hddSize)
			log_insert($fLogPtr,'fileSync ID|'.trim($lineComponent[2]).'|Delta|'.($dbSize - $hddSize));
	}
}

fclose($fLogPtr);
echo "Done !";
echo chr(7); 
echo chr(7);
echo chr(7);
?>