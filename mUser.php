<?php
	include ('connection.php');
	if ($_SERVER["REQUEST_METHOD"] == "POST") 
		{
			$messagesErrors = array(); // No son excepciones reales, sino validaciones antes de insertar un valor
			$insertEx = new Exception(); // Está si es una excepción que ocurre al insertar un nuevo registro

			$original = $_POST['originalEmailUs'];

			$name = $_POST['nameUs'];
			$email = $_POST['emailUs'];
			$cell = $_POST['cellUs'];
			$password = $_POST['passUs'];
			$secondPassword= $_POST['secondPassUs'];
			$range = $_POST['rangeUser']; // El tipo de usuario en letras del form
			$tier = 0; // El tipo de usuario en número

			if($password != $secondPassword)
				$messagesErrors['anotherPass'] = "La confirmación de la contraseña no coincide";

			if(count(str_split($password)) < 5)
				$messagesErrors['smallPass'] = "La contraseña dada es muy pequeña, tiene que ser mayor a 4 caráteres";

			foreach(str_split($cell) as $digit)
				if (ord($digit) < 48 || ord($digit) > 57)
				{
					$messagesErrors['invalidNumber'] = "Se ha detectado un número de teléfono inválido";
					break;
				}

			if ($range == 'normal')
				$tier = 0;
			elseif ($range == 'aProyectos')
				$tier = 1;
			else
				$tier = 2;


			// Un chequeo para ver si los datos fueron debidamente capturados

			if(empty($messagesErrors))
			{
				$query = "UPDATE usuario 
						  SET CorreoElectronico = '".$email."', Nombre = '".$name."', Telefono = '".$cell."', Contraseña = '".$password."', Tipo = '".$tier."'
						  WHERE CorreoElectronico = '".$original	."';";

				try
				{
					$result = $connec->query($query);
				}
				catch (mysqli_sql_exception  $e)
				{
					$insertEx = $e;
				}

				if ($result)
				{
					header('Location: users.php');
				}
				else
					header('Location: errorsTerminal.php');
			}
		}
?>