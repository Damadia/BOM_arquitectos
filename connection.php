<?php
	$server = "127.0.0.1";
	$user = "Svein";
	$password = "asom2112";
	$DB = "bom";


	$connec = new mysqli($server, "$user", $password, $DB);

	if(!$connec)
	{
		die("Conexión fallida".$connec->$connect_error);
	}

?>
