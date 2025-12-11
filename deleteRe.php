<?php
	include ('connection.php');
	$id_request = $_POST['id_re'];

	$querySet = "DELETE FROM solicitud
				 WHERE ID_Solicitud = ".$id_request.";";

	$result = $connec->query($querySet);

	if (!$result)
		echo $connec->error;
	else
		echo "todo bien";


	$connec->close();
	header('Location: request.php');
?>