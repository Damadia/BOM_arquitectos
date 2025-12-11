<?php
	
	$queryRequest = "SELECT * 
					 FROM solicitud
					 WHERE solicitud.CorreoPropietario = '".$_SESSION['email']."';";


	$result = $connec->query($queryRequest);
	$actualRow =array();
	$actualRow = $result->fetch_assoc();

	while ($actualRow != NULL)
	{
		if ($actualRow['Visualizada'] == 0)
			$visualized = "No";
		else
			$visualized = "Si";

		if ($actualRow['SolicitudObra'] == 0)
			$withConstruction = "No";
		else
			$withConstruction = "Si";

		if ($actualRow['FechaValidacion'] != null)
			$acceptDate = $actualRow['FechaValidacion'];
		else
			$acceptDate = "N/a";


		echo "<div class='requestContainer'>
				<div class='requestEntrance'>
					<p class='details'><span class='titleAttribute'>Descripción:</span>".$actualRow['Descripcion']."</p>
					<div class='theOthersAttributes'>
						<p class='requestAttribute'><span class='titleAttribute'>Tipo de proyecto:</span>".$actualRow['TipoProyecto']."</p>
						<p class='requestAttribute'><span class='titleAttribute'>Estado:</span>".$actualRow['Estado']."</p>
						<p class='requestAttribute'><span class='titleAttribute'>Visualizada:</span>".$visualized."</p>
						<p class='requestAttribute'><span class='titleAttribute'>Solicitud de obra:</span>".$withConstruction."</p>
						<p class='requestAttribute'><span class='titleAttribute'>Fecha de solicitud:</span>".$actualRow['FechaPeticion']."</p>
						<p class='requestAttribute'><span class='titleAttribute'>Fecha de validación:</span>".$acceptDate."</p>
					</div>
				</div>
			</div>";
		$actualRow = $result->fetch_assoc();
	}
?>
