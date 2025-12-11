<?php
	include ('connection.php');

	$ID_user = $_POST['id_user'];

	$queryDel = "DELETE FROM usuario
				 WHERE CorreoElectronico = '".$ID_user."';";

	$resultDel = $connec->query($queryDel);

	$connec->close();
	header('Location: users.php');

?>