<?php
	include('connection.php');

	$users = getUsers();
	$actualUser = $users->fetch_assoc();
	$type = "";

	while ($actualUser != NULL)
	{	
		if ($actualUser['Tipo'] == 0)
			$type = "Usuario común";
		elseif ($actualUser['Tipo'] == 1)
			$type = 'Administrador de proyectos';
		else
			$type = 'Superusuario';

		echo "<div class='userContainer'>
				<h2 class='userNameTitle'>Usuario: ".$actualUser['Nombre']."<span class='userNameTitle userEmailTitle'>Correo: ".$actualUser['CorreoElectronico']."</span></h2>
				<div class='userEntrance'>
					<div class='userAttributes'>
						<p class='userAttribute'><span class='titleAttribute'>Teléfono:</span>".$actualUser['Telefono']."</p>
						<p class='userAttribute'><span class='titleAttribute'>Rango del usuario:</span>".$type."</p>
						<p class='userAttribute'><span class='titleAttribute'>Fecha de alta del usuario:</span>".$actualUser['FechaRegistro']."</p>
					</div>
					<div class='options'>
						<form action='modifyUser.php' method='Get'>
							<input type=text name='id_user' value='".$actualUser['CorreoElectronico']."' style='display:none;' readonly>
							<input type='submit' value='Modificar' class='hyStyle warningBtn'>
						</form>
						<form action='deleteUser.php' method='Post'>
							<input type=text name='id_user' value='".$actualUser['CorreoElectronico']."' style='display:none;' readonly>
							<input type='submit' value='Eliminar' class='hyStyle dangerBtn'>
							<div class='checkFix fieldElement' style='width: 100%;'>
								<label class='conCheck' for='confirmCheck' required>Confirmo querer eliminar este usuario:</label>
								<input name='confirmCheck' type='checkbox' required>
							</div>
						</form>
					</div>
				</div>
			</div>";

		$actualUser = $users->fetch_assoc();
	}


	$connec->close();

	function getUsers()
	{
		include('connection.php');
		$queryUsers = "SELECT Nombre, CorreoElectronico, Telefono, Tipo, FechaRegistro
					   FROM usuario";

		$result = $connec->query($queryUsers);

		return $result;
	}

?>


