<?
    #get server name
    $hostname = php_uname('n');
    #determine datacenter
    $dc = substr($hostname,0,2)=="ny" ? "ny" :"pa";
    $dcOther = ($dc == "ny" ? "pa" : "ny"); 
     
    #list of pindgom probes from NY access logs
    $probes["ny"] = array(  "174.34.156.130",
                            "174.34.162.242",
                            "176.31.228.137",
                            "178.255.155.2",
                            "184.75.210.186",
                            "67.205.112.79",
                            "78.136.27.223",
                            "82.103.128.63",
                            "94.46.4.1",
                            "178.255.152.2",
                            "178.255.153.2",
                            "178.255.154.2",
                            "212.84.74.156",
                            "46.165.195.139",
                            "46.20.45.18",
                            "64.237.55.3",
                            "69.59.28.19",
                            "69.64.56.47",
                            "76.72.167.90",
                            "83.170.113.102",
                            "85.25.176.167",
                            "94.247.174.83",
                            "94.46.240.121",
                            "95.211.87.85",
                            "96.31.66.245");

    #list of pindgom probes from PA access logs
    $probes["pa"] = array(  "208.43.68.59",
                            "67.192.120.134",
                            "108.62.115.226",
                            "173.204.85.217",
                            "173.248.147.18",
                            "199.87.228.66",
                            "204.152.200.42",
                            "207.218.231.170",
                            "207.97.207.200",
                            "64.141.100.136",
                            "67.228.213.178",
                            "70.32.40.2",
                            "72.46.130.42",
                            "74.52.50.50",
                            "50.23.94.74");

    #get client ip address
    if (isset($_GET['testip']))
        $ip = $_GET['testip'];
    else
        $ip = $_SERVER['REMOTE_ADDR'];
    
    if (in_array($ip,$probes[$dc]))   
        #if client ip is in suitable dc 
        echo "OK";
    elseif (in_array($ip,$probes[$dcOther]))
		#probe went to wrong dc
		echo "ERROR:Wrong DC";
    else
		#probe is unregistered
		echo "ERROR:Unregistered Probe";
?>
