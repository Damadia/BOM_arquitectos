<?php
	include ('connection.php');
	$deleteProErros = array(); 

	$id_delete = $_POST['id_Pro'];

	$deleteQuery = "DELETE FROM direccion
					WHERE Id_proyecto =".$id_delete.";";
	$result = $connec->query($deleteQuery);

	if (!$result)
	{
		$deleteProErros['wrongDirDelete'] = 'Algo salió mal al borrar (dirección)';
		$deleteProErros['dirDeleteDetails'] = $connec->error;

		foreach ($deleteProErros as $error)
			echo $error."<br>";
	}
	else
	{
		$deleteQuery = "DELETE FROM proyecto
						WHERE Id_proyecto =".$id_delete.";";

		$result = $connec->query($deleteQuery);
		if (!$result)
		{
			$deleteProErros['wrongDirDelete'] = 'Algo salió mal al borrar (dirección)';
			$deleteProErros['dirDeleteDetails'] = $connec->error;

			foreach ($deleteProErros as $error)
				echo $error."<br>";
		}

		if (empty($deleteProErros))
			header('Location: projects.php');

	}



?>