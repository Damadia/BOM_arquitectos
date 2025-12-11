<?php
	include('connection.php');
	include('setAsSee.php');
	$userWithRequest = getUsers();
	$flag = true;
	$userHeadText = "";

	$currentUser = $userWithRequest->fetch_row();

	while ($currentUser != null)
	{
		$requestsUser = getRequestByUser($currentUser[0]);
		$currentRequest = $requestsUser->fetch_assoc();

		while ($currentRequest !=  null)
		{	
			if ($currentRequest['Visualizada'] == 0)
				$visualized = "No";
			else
				$visualized = "Si";

			if ($currentRequest['SolicitudObra'] == 0)
				$withConstruction = "No";
			else
				$withConstruction = "Si";

			if ($currentRequest['FechaValidacion'] != null)
				$acceptDate = $currentRequest['FechaValidacion'];
			else
				$acceptDate = "N/a";

			$userHeadText = "<h2 class='requestUserTitle'>Solicitud de: ".$currentUser[1]."<span class='requestUserTitle requestEmailTitle'>".$currentUser[0]."</span></h2>";

			echo "<div class='requestContainer'>".$userHeadText."
					<div class='requestEntrance'>
						<p class='details'><span class='titleAttribute'>Descripción:</span>".$currentRequest['Descripcion']."</p>
						<div class='theOthersAttributes'>
							<p class='requestAttribute'><span class='titleAttribute'>Tipo de proyecto:</span>".$currentRequest['TipoProyecto']."</p>
							<p class='requestAttribute'><span class='titleAttribute'>Estado:</span>".$currentRequest['Estado']."</p>
							<p class='requestAttribute'><span class='titleAttribute'>Visualizada:</span>".$visualized."</p>
							<p class='requestAttribute'><span class='titleAttribute'>Solicitud de obra:</span>".$withConstruction."</p>
							<p class='requestAttribute'><span class='titleAttribute'>Fecha de solicitud:</span>".$currentRequest['FechaPeticion']."</p>
							<p class='requestAttribute'><span class='titleAttribute'>Fecha de validación:</span>".$acceptDate."</p>
						</div>
						<div class='options'>
							<form action='acceptRe.php' method='Post'>
								<input type=text name='id_re' value='".$currentRequest['Id_Solicitud']."' style='display:none;'>
								<input type='submit' value='Aceptar' class='hyStyle acceptBtn'>
							</form>
							<form action='rejectRe.php' method='Post'>
								<input type=text name='id_re' value='".$currentRequest['Id_Solicitud']."' style='display:none;' readonly>
								<input type='submit' value='Rechazar' class='hyStyle warningBtn'>
							</form>
							<form action='deleteRe.php' method='Post'>
								<input type=text name='id_re' value='".$currentRequest['Id_Solicitud']."' style='display:none;' readonly>
								<input type='submit' value='Eliminar' class='hyStyle dangerBtn'>
								<div class='checkFix fieldElement' style='width: 100%;'>
									<label class='conCheck' for='confirmCheck' required>Confirmo querer eliminar está petición:</label>
									<input name='confirmCheck' type='checkbox' required>
								</div>

							</form>
						</div>
					</div>
				</div>";



			$currentRequest = $requestsUser->fetch_assoc();
		}


		$currentUser = $userWithRequest->fetch_row();
		$flag = true;

	}


	/*Esta función me regresa solamente usuarios con solicitudes, el valor de retorno es una query*/
	function getUsers()
	{
		include('connection.php');
		$usersWithRequest = "SELECT CorreoElectronico, Nombre
							 FROM usuario
							 WHERE usuario.CorreoElectronico IN (SELECT CorreoPropietario
                                    							 FROM solicitud
                                    							 GROUP BY CorreoPropietario)";
		$resultQuery = $connec->query($usersWithRequest);

		if (!$resultQuery)
		{
			$requestAdminErrors['issuesGetUsers'] = 'No se pudo obtener la información de los usuarios';
			$requestAdminErrors['detailsGetUsers'] = $connec->error;
			echo $connec->error;
		}	

		$connec->close();

		return $resultQuery;
	}

	// Con el nombre obtener todas las solicitudes que hizo esa persona
	function getRequestByUser($email)
	{
		include('connection.php');
		$queryRequest = "SELECT Descripcion, FechaPeticion, TipoProyecto, Estado, Visualizada, SolicitudObra, FechaValidacion, Id_Solicitud
						 FROM solicitud
						 WHERE CorreoPropietario = '".$email."';";

		$resultQuery = $connec->query($queryRequest);
		if (!$resultQuery)
		{
			$requestAdminErrors['issuesGetRequest'] = 'No se pudo obtener la información de las solicitudes';
			$requestAdminErrors['detailsGetRequest'] = $connec->error;
			echo $connec->error;
		}

		$connec->close();
		return $resultQuery;
	}


?>