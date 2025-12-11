<?php
	session_start();
	include('connection.php');
	$success = false; // Variable del documento para hacer evaluaciones si se está registrado

		if ($_SERVER["REQUEST_METHOD"] == "POST") 
		{
			$messagesErrors = array(); // No son excepciones reales, sino validaciones antes de insertar un valor
			$insertEx = new Exception(); // Está si es una excepción que ocurre al insertar un nuevo registro


			$name = $_POST['nameUs'];
			$email = $_POST['emailUs'];
			$cell = $_POST['cellUs'];
			$password = $_POST['passUs'];
			$secondPassword= $_POST['secondPassUs'];

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

			// Un chequeo para ver si los datos fueron debidamente capturados

			if(empty($messagesErrors))
			{
				$query = "INSERT INTO usuario VALUES('".$email."','".$name."','".$cell."','".$password."', 0, '".date('Y/m/d')."')";

				try
				{
					$result = $connec->query($query);
				}
				catch (mysqli_sql_exception  $e)
				{
					$insertEx = $e;
				}

				if ($result)
					$success = true;
				else
					header('Location: errorsTerminal.php');
			}
		}
?>

<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<title>Formulario de registro</title>
	<link rel="stylesheet" href="css/bootstrap.min.css">
	<link rel="stylesheet" href="css/generalStyle.css">
	<link rel="stylesheet" href="css/formLayaout.css">
    <script src="https://kit.fontawesome.com/f1a5c638bd.js" crossorigin="anonymous"></script>
</head>
<body>	
	<header class="container-fluid headBox">
		<div class="row">
			<a class="headElement logoBox" href="#"><img src="images/bomLogo.jpg" alt=""></a>
			
			<ul class="headElement navBar">
				<li class="navElements"><a href="index.php"> INICIO </a></li>
				<li class="navElements"><a href="contact.php"> CONTACTO </a></li>
				<li class="navElements"><a href="about.php"> SOBRE NOSOTROS </a></li>
				<li class="navElements"><a href="projects.php"> PROYECTOS </a></li>
				<?php
					if (isset($_SESSION['user']) && $_SESSION['tier'] > 0)
						echo "<li class='navElements'><a href='users.php'> USUARIOS </a></li>";
				?>
				<li class="navElements"> 
					<div class="logInBox">
						<?php
							if (!isset($_SESSION['user']))
								echo "<a class='login' href='logInForm.html'> INICIAR SESIÓN </a>";
							else
								echo "<a class='login' href='logOut.php'> CERRAR SESIÓN </a>";
						?>
						<p style="display: none;"></p>
						<a class="login" href="formRegister.php"> REGISTRARSE </a>
					</div>
				</li>
			</ul>
			<?php
				if (isset($_SESSION['user']))
					echo "<p class='userWelcome headElement'>Sesión iniciada: Bienvenido(a) usuario(a), ".$_SESSION['user']."</p>"; 
			?>
		</div>
	</header>

	<div class="bigFormContainer">
		<?php		
			if ($_SERVER["REQUEST_METHOD"] == "POST")
				if(!$success)
				{
					$messagesErrors['invalidRegister'] = "El registro no se ha completado exitosamente";
					echo "El registro no se ha completado exitosamente, revise la bandeja de errores<br/>";
					// Desplegar los errores cometidos
					foreach ($messagesErrors as $err) 
						echo $err."<br/>";
				}
				else
				{
					echo "<h2 class='successLegend'>El registro ha sido exitoso, ya puedes <a href='logInForm.html''>iniciar sesión</a></h2>";
				}

		?>
		<form action="formRegister.php" id="formForRegister" method="post" class="form1Style">
			<p class="TitleForm">Completa los datos para tu registro</p>
			<div class="fields">	
				<p class="largeFieldElement">
					<label class="FormLabel" for="">Nombre de usuario:</label><br>	
					<input type="text" name="nameUs" maxlength="50" size="90" required>
				</p>

				<p class="fieldElement">
					<label class="FormLabel" for="">Correo:</label><br>	
					<input type="text" name="emailUs" maxlength="40" size="40" required>
				</p>

				<p class="fieldElement">
					<label class="FormLabel" for="">Teléfono (opcional):</label><br>	
					<input type="text" name="cellUs" maxlength="40" size="40">
				</p>

				<p class="fieldElement">
					<label class="FormLabel" for="">Contraseña:</label><br>	
					<input type="password" name="passUs" maxlength="40" size="40" required>
				</p>

				<p class="fieldElement">
					<label class="FormLabel" for="">Confirmar contraseña:</label><br>	
					<input type="password" name="secondPassUs" maxlength="40" size="40" required>
				</p>

				<p class="centerField">
					<input class="hyStyle" type="submit" value="Registrarme">
				</p>
			</div>	


		</form>


	</div>

	<footer class="container-fluid footBox">
		<div class="footerElements">
			<ul class="listBox footItem">
				<li class="contactItems"> <a href="https://api.whatsapp.com/send?phone=9932062633" target="blank">+52 (993) 157 0620</a></li>
				<li class="contactItems"> <a href="mailto:Byron_Ortiz97@hotmail.com">Byron_Ortiz97@hotmail.com</a></li>
			</ul>

			<div class="smBox footItem">
				<a href="#"><i class="fa-brands fa-x-twitter fa-2xl"></i></a>
				<a href="https://www.instagram.com/bomarquitectos/" target="blank"><i class="fa-brands fa-instagram fa-2xl"></i></a>
				<a href="https://www.facebook.com/profile.php?id=61555422154153" target="blank"><i class="fa-brands fa-square-facebook fa-2xl"></i></a>
			</div>

			<ul class="listBox footItem">
				<li class="linkElement"> <a href="contact.php">Contacto</a></li>
				<li class="linkElement"> <a href="about.php">Sobre nosotros</a></li>	
			</ul>
		</div>
	</footer>
<script src="js/jquery-3.7.1.min.js"></script>
<script src="js/bootstrap.min.js"></script>
</body>
</html>