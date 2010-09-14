<?php
error_reporting(E_ERROR);

$ftpServer = 'il3.cast-tv.com';
$ftpUsername = 'TheMarker';
$ftpPassword = 'sd7f234gr';
$tags = '';
$contentType = 'video';
$targetFile = 'output.csv';

$ftp = ftp_connect ( $ftpServer );
if (! $ftp) {
	echo 'Unable to connect to the ftp server';
	die ();
}

$login = ftp_login ( $ftp, $ftpUsername, $ftpPassword );
if (! $login) {
	echo 'Unable to login to the ftp server';
	die ();
}

$fileResource = fopen($targetFile, 'w');
list_folder($ftp);
fclose($fileResource);

function list_folder($ftp, $dir = '')
{
	echo "listing folder $dir\n";
	
	$records = ftp_rawlist( $ftp, $dir );
	if(!$records)
		return;
	
	$arr = null;	
	foreach($records as $record)
	{
		if(!preg_match('/([d-])[rwx-]{9}.*\s([^\s]+)$/', $record, $arr))
			continue;
			
		$isDir = ($arr[1] == 'd');
		$recordName = $arr[2];
		
		if($isDir)
		{
			if($recordName == '.' || $recordName == '..')
				continue;
				
			list_folder($ftp, "$dir/$recordName");
				continue;
		}			
		
		write_csv_line($recordName, "$dir/$recordName");
	}
}

function write_csv_line($fileName, $path)
{
	global $ftpServer, $ftpUsername, $ftpPassword, $tags, $contentType, $fileResource;
	
	$url = "ftp://$ftpUsername:$ftpPassword@{$ftpServer}{$path}";
	$line = array(
		$fileName, // title
		$fileName, // description
		$tags,
		$url,
		$contentType
	);
	fputcsv($fileResource, $line);
}


