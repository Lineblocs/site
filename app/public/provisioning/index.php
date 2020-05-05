<?PHP

function getMethod() {
	$method = $_SERVER['REQUEST_METHOD'];
	$override = isset($_SERVER['HTTP_X_HTTP_METHOD_OVERRIDE']) ? $_SERVER['HTTP_X_HTTP_METHOD_OVERRIDE'] : (isset($_GET['method']) ? $_GET['method'] : '');
	if ($method == 'POST' && strtoupper($override) == 'PUT') {
		$method = 'PUT';
	} elseif ($method == 'POST' && strtoupper($override) == 'DELETE') {
		$method = 'DELETE';
	}
	return $method;
}

$server_type = 'http';


//Check if it's allowed in FreePBX through Endpoint Manager first
if ((!isset($server_type)) OR ($server_type != 'http')) {
	header('HTTP/1.1 403 Forbidden', true, 403);
	echo "<h1>"._("Error 403 Forbidden")."</h1>";
	echo _("Access denied!");
	die();
}


$provis_ip = "0.0.0.0";

if(((getMethod() == 'PUT') OR (getMethod() == 'POST'))) {
    //write log files or other files to drive. not sussed out yet completely.

    /* PUT data comes in on the stdin stream */
    //$putdata = fopen("php://input", "r");

    /* Open a file for writing */
    //$fp = fopen($endpoint->global_cfg['config_location'] . $_SERVER['REDIRECT_URL'], "a");

    /* Read the data 1 KB at a time
        and write to the file */
    //while ($data = fread($putdata, 1024))
    //    fwrite($fp, $data);

    /* Close the streams */
    //fclose($fp);
    //fclose($putdata);
    header('HTTP/1.1 200 OK', true, 200);
    die();
}

if(getMethod() == "GET") {
    # Workaround for SPAs that don't actually request their type of device
    # Assume they're 504G's. Faulty in firmware 7.4.3a
    $filename = basename($_SERVER["REQUEST_URI"]);
    $web_path = 'http://'.$_SERVER["SERVER_NAME"].dirname($_SERVER["PHP_SELF"]).'/';
    /*
    if ($filename == "p.php") { 
            $filename = "spa502G.cfg";
            $_SERVER['REQUEST_URI']=$_SERVER['REQUEST_URI']."/spa502G.cfg";
            $web_path = $web_path."p.php/";
    }
     */
    
    # Firmware Linksys/SPA504G-7.4.3a is broken and MUST be upgraded.
    if (preg_match('/7.4.3a/', $_SERVER['HTTP_USER_AGENT'])) {
            $str = '<flat-profile><Upgrade_Enable group="Provisioning/Firmware_Upgrade">Yes</Upgrade_Enable>';
            $str .= '<Upgrade_Rule group="Provisioning/Firmware_Upgrade">http://'.$provis_ip.'/current.bin</Upgrade_Rule></flat-profile>';
            echo $str;
            exit;
    }
	
    //$filename = str_replace('p.php/','', $filename);
    $strip = str_replace('spa', '', $filename);
    if(preg_match('/[0-9A-Fa-f]{12}/i', $strip, $matches) && !(preg_match('/[0]{10}[0-9]{2}/i',$strip))) {
        
        $mac_address = $matches[0];
        $full_path = __DIR__."/../fs/provisioning/cfg".$mac_address.'.xml';
        if(!is_file($full_path)) {
            header("HTTP/1.0 404 Not Found", true, 404);
            echo "<h1>"._("Error 404 Not Found")."</h1>";
            echo _("File not Found!");
            die();
        }
        echo file_get_contents( $full_path );
    } 
} 
else {
    header('HTTP/1.1 403 Forbidden', true, 403);
    echo "<h1>"._("Error 403 Forbidden")."</h1>";
    echo _("Access denied!");
    die();
}
