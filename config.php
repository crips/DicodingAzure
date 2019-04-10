<?php
	$host = "tcp:bukabuku.database.windows.net, 1433";
	$user = "mafrizal";
    $pass = "Timpakul2016+";
    $db = "bukabuku";

    try {
		$con = new PDO("sqlsrv:Server = $host; Database = $db", $user, $pass);
        $con->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    } catch (Exception $e) {
		echo "Failed : " . $e;
    }
	
	$connectionInfo = array("UID" => "mafrizal@bukabuku", "pwd" => "Timpakul2016+", "Database" => "bukabuku", "LoginTimeout" => 30, "Encrypt" => 1, "TrustServerCertificate" => 0);
	$serverName = "tcp:bukabuku.database.windows.net, 1433";
	$conn = sqlsrv_connect($serverName, $connectionInfo);
?>