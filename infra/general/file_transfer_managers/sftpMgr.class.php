<?php
/**
 * Extends the 'kFileTransferMgr' class & implements a file transfer manager using the SFTP protocol.
 * For additional comments please look at the 'kFileTransferMgr' class.
 * 
 * @package infra
 * @subpackage Storage
 */
class sftpMgr extends kFileTransferMgr
{
	
	private $sftp_id = false;
	
	private $sftp_pass = null;

	private $sftp_server;
	
	private $sftp_port;
	 
	private $sftp_user;
	
	private $sftp_privKeyFile;
	
	private $useCmd;
	
	// instances of this class should be created usign the 'getInstance' of the 'kFileTransferMgr' class
	protected function __construct($useCmd = false)
	{
		$this->useCmd = $useCmd;
	}

	
	
	public function getConnection()
	{
		if ($this->sftp_id != null && $this->sftp_id != false) {
			return $this->sftp_id;
		}
		else {
			return $this->connection_id;
		}
	}
	
	private function getSsh2Connection() {
		return $this->connection_id;
	}
	
	private function getSftpConnection() {
		return $this->sftp_id;
	}
	
	/**********************************************************************/
	/* Implementation of abstract functions from class 'kFileTransferMgr' */
	/**********************************************************************/
	
	// sftp connect to server:port
	protected function doConnect($sftp_server, &$sftp_port)
	{
		// try connecting to server
		if (!$sftp_port || $sftp_port == 0) {
                	$sftp_port = 22;
		}
		$this->sftp_port = $sftp_port;
		$this->sftp_server = $sftp_server;
		return ssh2_connect($sftp_server, $sftp_port);
	}
	
	
	// login to an existing connection with given user/pass (ftp_passive_mode is irrelevant)
	protected function doLogin($sftp_user, $sftp_pass, $ftp_passive_mode = TRUE)
	{
		$this->sftp_user = $sftp_user;
		$this->sftp_pass = $sftp_pass;
		// try to login
		if (ssh2_auth_password($this->getSsh2Connection(), $sftp_user, $sftp_pass)) {
			$this->sftp_id = ssh2_sftp($this->getSsh2Connection());
			return ($this->sftp_id != false && $this->sftp_id != null);
		}
		else {
			return false;
		}
	}
	
	
	// login using a public key
	protected function doLoginPubKey($user, $pubKeyFile, $privKeyFile, $passphrase = null)
	{
		$this->sftp_user = $user;
		$this->sftp_privKeyFile = $privKeyFile;
		
		// try to login
		if (ssh2_auth_pubkey_file($this->getSsh2Connection(), $user, $pubKeyFile, $privKeyFile, $passphrase)) {
			$this->sftp_id = ssh2_sftp($this->getSsh2Connection());
			return ($this->sftp_id != false && $this->sftp_id != null);
		}
		else {
			return false;
		}
	}
	
	
	// upload a file to the server (ftp_mode is irrelevant
	protected function doPutFile ($remote_file , $local_file , $ftp_mode, $http_field_name = null, $http_file_name = null)
	{
		$sftp = $this->getSftpConnection();
		$remote_file = ltrim($remote_file,'/');
		$absolute_path = trim($this->start_dir,'/').'/'.$remote_file;
		$absolute_path = trim($absolute_path, '/');
		
		if ($this->sftp_privKeyFile == null || !$this->useCmd)
		{
			$stream = @fopen("ssh2.sftp://$sftp/$absolute_path", 'w');
        	if (!$stream)
        		return false;

        	//Writes the file in chunks (for large files bug)
        	$fileToReadHandle = fopen($local_file, "r");
        	$ret = $this->writeFileInChunks($fileToReadHandle, $stream);
        	@fclose($fileToReadHandle);
			@fclose($stream);
			return $ret;
		}
		else
		{
			//else the authentication is by private key
			$sftpPutCommand = "put $local_file $remote_file";
			$cmd = "echo -e '$sftpPutCommand \n quit' | sftp -oPort=$this->sftp_port -o IdentityFile=$this->sftp_privKeyFile -o 'StrictHostKeyChecking=no'  $this->sftp_user@$this->sftp_server";
			KalturaLog::debug('Put file using command: ' . $cmd);
			system($cmd, $return_value);		
						
			return true;
		}
	}
		
	// download a file from the server (ftp_mode is irrelevant)
	protected function doGetFile ($remote_file, $local_file, $ftp_mode)
	{	
		$sftp = $this->getSftpConnection();
		$remote_file = ltrim($remote_file,'/');
		$absolute_path = trim($this->start_dir,'/').'/'.$remote_file;
		$absolute_path = trim($absolute_path, '/');
        $stream = @fopen("ssh2.sftp://$sftp/$absolute_path", 'r');
        if (!$stream) {
        	return false;
        }
        
        //Writes the file in chunks (for large files bug)
        $fileToWriteHandle = fopen($local_file, "w+");
        $ret = $this->writeFileInChunks($stream, $fileToWriteHandle);
        @fclose($fileToWriteHandle);
        @fclose($stream);

        return $ret;
	}
	
	// create a new directory
	protected function doMkDir ($remote_path)
	{
	    $remote_path = ltrim($remote_path,'/');
		return ssh2_sftp_mkdir($this->getSftpConnection(), $remote_path);
	}
	
	// chmod the given remote file
	protected function doChmod ($remote_file, $chmod_code)
	{
	    $remote_file = ltrim($remote_file,'/');
		$chmod_cmd = 'chmod ' . $chmod_code . ' ' . $remote_file;
		$exec_output = $this->execCommand($chmod_cmd);
		return (trim($exec_output) == ''); // empty output means the command passed ok
	}
	
	// return true/false according to existence of file on the server
	protected function doFileExists($remote_file)
	{
	    $remote_file = ltrim($remote_file,'/');
		$sftp = $this->getSftpConnection();
		$stats = @ssh2_sftp_stat($sftp, $remote_file);
		return ($stats !== false);
	}

    // return the current working directory
	protected function doPwd ()
	{
		$pwd_cmd = 'pwd';
		$result = $this->execCommand($pwd_cmd);
		if (strstr($result, '/') === false) {
		    return '';
		}
		return $result;
	}

    // delete a file and return true/false according to success
    protected function doDelFile ($remote_file)
    {
        $remote_file = ltrim($remote_file,'/');
    	return ssh2_sftp_unlink($this->getSftpConnection(), $remote_file); 
    }

     // delete a directory and return true/false according to success
    protected function doDelDir ($remote_path)
    {
        //return ssh2_sftp_rmdir($this->getSftpConnection(), $remote_path);
        $remote_path = ltrim($remote_path,'/'); 
        $deldir_cmd = 'rm -r ' . $remote_path;
        $exec_output = $this->execCommand($deldir_cmd);
        return (trim($exec_output) == ''); // empty output means the command passed ok
    }

	protected function doList ($remote_path)
	{
	    $remote_path = ltrim($remote_path,'/');
        $lsdir_cmd = 'ls ' . $remote_path;
        $exec_output = $this->execCommand($lsdir_cmd);
        return array_map('trim', explode("\n", $exec_output));
	}	
	
	// download a file from the server
	public function fileGetContents ($remote_file)
	{
	    $sftp = $this->getSftpConnection();
	    $remote_file = ltrim($remote_file,'/');
	    $absolute_path = trim($this->start_dir,'/').'/'.$remote_file;
		$absolute_path = trim($absolute_path, '/');
		$uri = "ssh2.sftp://$sftp/$absolute_path";
        $stream = @fopen($uri, 'r');
        if (!$stream)
        	throw new kFileTransferMgrException("Failed to open stream [".$uri."]");
        	
        $contents = fread($stream, filesize($uri));
        if ($contents === false)
            throw new kFileTransferMgrException("Failed to read file from [".$uri."]");
                   
        return $contents;
	}
	
	// upload a file to the server
	public function filePutContents ($remote_file, $contents)
	{	
		if (!$this->fileExists(dirname($remote_file))) {
			$this->mkDir(dirname($remote_file));
		}
		
        $sftp = $this->getSftpConnection();
        $remote_file = ltrim($remote_file,'/');
        $absolute_path = trim($this->start_dir,'/').'/'.$remote_file;
		$absolute_path = trim($absolute_path, '/');
		$uri = "ssh2.sftp://$sftp/$absolute_path";
        $stream = @fopen($uri, 'w');
        if (!$stream)
        	throw new kFileTransferMgrException("Failed to open stream [".$uri."]");
        	
        if (@fwrite($stream, $contents) === false) {
            @fclose($stream);
        	throw new kFileTransferMgrException("Failed to upload file to [".$uri."]");
		}
        return @fclose($stream);
	}
	
	protected function doFileSize($remote_file)
	{
	    $remote_file = ltrim($remote_file,'/');
	    $statinfo = ssh2_sftp_stat($this->getSftpConnection(), $remote_file);
	    $filesize = isset($statinfo['size']) ? $statinfo['size'] : null;
	    return $filesize;
	}
	
	protected function doModificationTime($remote_file)
	{
	    $remote_file = ltrim($remote_file,'/');
	    $statinfo = ssh2_sftp_stat($this->getSftpConnection(), $remote_file);
	    $modificationTime = isset($statinfo['mtime']) ? $statinfo['mtime'] : null;
	    return $modificationTime;
	}
	
	
	// execute the given command on the server
	private function execCommand($command_str)
	{
		$stream = ssh2_exec($this->getSsh2Connection(), $command_str);
  		stream_set_blocking($stream, true);
   		$output = stream_get_contents($stream);
   		fclose($stream);
   		return $output;
	}
	
}
?>