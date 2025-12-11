<?php
	include('connection.php');
	if ($_SERVER['REQUEST_METHOD'] == "POST")
	{
		$messagesErrors = array();

		$email = $_POST['emailUs'];
		$password = $_POST['passUs'];

		$query = "SELECT * FROM usuario WHERE CorreoElectronico='".$email."' AND Contraseña='".$password."';";

		if (empty($messagesErrors))
		{
			try
			{
				$result = $connec->query($query);
			}
			catch (Exceptio $e)
			{
				header('Location: errorsTerminal.php');
			}

			
			if ($result->num_rows > 0)
			{
				session_start();
				$userData = $result->fetch_assoc();
				$_SESSION['user'] = $userData['Nombre']; //Uso fethc assoc porque se que solo hay UN registro para la consulta dada, si no fuera el caso, la fila tendría que cambiar usando fetch_row
				$_SESSION['email'] = $userData['CorreoElectronico'];
				$_SESSION['tier'] = $userData['Tipo'];
				header('Location: index.php');
			}
			else
			{
				$messagesErrors['notFoundUser'] = 'El usuario dado no está registrado';
				header('Location: errorsTerminal.php');
			}

		}
		else
		{
			header('Location: errorsTerminal.php');
		}

	}
?>