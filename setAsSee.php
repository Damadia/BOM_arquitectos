<?php
	include('connection.php');

	$requestAdminErrors = array();

	$updateRequest = "UPDATE solicitud
					  SET visualizada = 1";

	$theRequest = $connec->query($updateRequest);

	if (!$theRequest)
	{
		$requestAdminErrors['wrongQuery'] = 'Hubo un error al actualizar la información';
		$requestAdminErrors['detailsBadUpdate'] = $connec->error;
	}
	
	$connec->close();
?>