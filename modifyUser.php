<?php
	session_start();
	include('connection.php');
	$emailUser =$_GET['id_user'];
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
		
		<form action="mUser.php" id="formForRegister" method="post" class="form1Style">
			<p class="TitleForm">Modificando al usuario</p>
			<div class="fields">
				<input type="text" name="originalEmailUs" value='<?php echo $emailUser ?>' style="display:none;">	
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

				<p class="fieldElement" style="color: rgba(230, 230, 230, 1.0);">
					<label for="rangeUser">¿Cuál va a ser el rango del usuario?:</label>
	                <select class='fieldElement' name='rangeUser' required>
	                  <option class='fieldElement' value='' >Seleccione una opción</option>
	                  <option class='fieldElement' value='Normal'>Usuario normal (rango 0)</option>
	                  <option class='fieldElement' value='aProyectos'>Usuario administrador de proyectos (rango 1)</option>
	                  <option class='fieldElement' value='superUsuario'>Superusuario (rango 2)</option>
	                </select>	
				</p>

				<p class="centerField">
					<input class="hyStyle" type="submit" value="Modificar">
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