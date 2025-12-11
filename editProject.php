<?php
	session_start();
	include('getProData.php');

?>
<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<title>BOM - Edición proyecto </title>
	<link rel="stylesheet" href="css/bootstrap.min.css">
	<link rel="stylesheet" href="css/generalStyle.css">
	<link rel="stylesheet" href="css/projectsTempleateLayaout.css">
	<link rel="stylesheet" href="css/formLayaout.css">
	<link rel="stylesheet" href="css/styleProEdit.css">
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

	<form action="changeProData.php" method="POST">
		<input type="text" value="<?php echo $proyectData['Id_proyecto']?>" name="PRO_ID" style="display: none;">
		<h2 class="headingData">Datos del proyecto.</h2>
		<div class="projectDataBox fields">
			<p class="fieldElement">	
				<label for="titlePro">Nombre del proyecto:</label>
				<input class="fieldElement" name="titlePro" type="text" value="<?php echo $proyectData['Nombre']?>" required>
			</p>

			<p class="fieldElement">
				<label for="dayB">Día de inicialización:</label>
					<input class="fieldElement" name="dayB" type="date" value="<?php echo $proyectData['Diainicializacion']?>" required>	
			</p>

			<p class="fieldElement">
				<label for="dayE">Día de finalización:</label>
				<input class="fieldElement" name="dayE" type="date" value="<?php echo $proyectData['Diafinalizacion']?>">	
			</p>

			<p class="fieldElement">
				<label for="typeBuilt">¿Cuál es el caracter de la edificación?:</label>
                <select class='fieldElement' name='typeBuilt' required>
                  <option class='fieldElement' value='' >Seleccione una opción</option>
                  <option class='fieldElement' value='Casa'>Casa</option>
                  <option class='fieldElement' value='Restaurante'>Restaurante</option>
                  <option class='fieldElement' value='Comercio local'>Comercio local</option>
                  <option class='fieldElement' value='Palapa'>Palapa</option>
                  <option class='fieldElement' value='Jardín'>Jardín</option>
                  <option class='fieldElement' value='Departamento'>Departamento</option>
                  <option class='fieldElement' value='Obra pública cívil'>Obra pública cívil</option>
                  <option class='fieldElement' value='Condominio'>Condominio</option>
                </select>	
			</p>

			<p class="fieldElement">
				<label for="usePro">¿Cuál es el uso del proyecto?:</label>
                <select class='fieldElement' name='usePro' required>
                  <option class='fieldElement' value=''>Seleccione una opción</option>
                  <option class='fieldElement' value='Residencial'>Residencial</option>
                  <option class='fieldElement' value='Laboral'>Laboral</option>
                  <option class='fieldElement' value='Comercial'>Comercial</option>
                  <option class='fieldElement' value='Recreativo'>Recreativo</option>
                  <option class='fieldElement' value='Urbanismo'>Urbanismo</option>
                  <option class='fieldElement' value='Industrial'>Industrial</option>
                  <option class='fieldElement' value='Institucional'>Institucional</option>
                </select>	
			</p>

			<p class="fieldElement">
				<label for="typePro">¿Qué tipo es el proyecto?:</label>
                <select class='fieldElement' name='typePro' required>
                  <option class='fieldElement' value=''>Seleccione una opción</option>
                  <option class='fieldElement' value='Remodelación'>Remodelación</option>
                  <option class='fieldElement' value='Interiorismo'>Interiorismo</option>
                  <option class='fieldElement' value='Proyecto nuevo'>Proyecto nuevo</option>
                  <option class='fieldElement' value='Remodelación Urbana'>Remodelación Urbana</option>
                  <option class='fieldElement' value='Visualización'>Visualización</option>
                </select>	
			</p>

			<p class="fieldElement">
				<label for="currentStatePro">¿En qué estado se encuentra el proyecto?:</label>
                <select class='fieldElement' name='currentStatePro' required>
                  <option class='fieldElement' value=''>Seleccione una opción</option>
                  <option class='fieldElement' value='Concepción'>Concepción</option>
                  <option class='fieldElement' value='En proceso'>En proceso</option>
                  <option class='fieldElement' value='Finalizado'>Finalizado</option>
                </select>	
			</p>
			<p class='largeFieldElement'>
				<label for="descPro">Descripción del proyecto:</label>
				<textarea maxlength='1200' class='largeFieldElement' rows='7' name='descPro'><?php echo $proyectData['Descripcion']?></textarea>
			</p>
			
			
		</div>
		<hr class="separationLine">	
		<h2 class="headingData">Datos de la dirección.</h2>
		<div class="dirDataBox fields">
			<p class="fieldElement">
				<label for="dirCountry">País:</label>
				<input name="dirCountry" class="fieldElement" type="text" placeholder="Aquí el país" value="<?php echo $dirData['Pais'] ?>" required>
			</p>
			<p class="fieldElement">
				<label for="dirStateC">Estado del país:</label>
				<input name="dirStateC" class="fieldElement" type="text" placeholder="Aquí el estado (opcional)" value="<?php echo $dirData['Estado'] ?>">
			</p>
			<p class="fieldElement">
				<label for="dirCity">Ciudad:</label>
				<input name="dirCity" class="fieldElement" type="text" placeholder="Aquí la ciudad" required value="<?php echo $dirData['Ciudad'] ?>">
			</p>
			<p class="fieldElement">
				<label for="dirStreet">Calle:</label>
				<input name="dirStreet" class="fieldElement" type="text" placeholder="Aquí la calle" required value="<?php echo $dirData['Calle'] ?>">
			</p>
			<p class="fieldElement">
				<label for="dirNumber">Número:</label>
				<input name="dirNumber" class="fieldElement" type="number" placeholder="Aquí el número de residencia (opcional)" value="<?php echo $dirData['NumeroResidencia'] ?>">
			</p>
		</div>
		<div class="boxForUploadImages"></div>
		<p class="centerField">
			<input class="submitBtn" style="background:RGB(245, 202, 59); color: rgb(24, 24, 24);" type="submit" value="Cambiar datos" style="background: background: RGB(33, 150, 243);">
		</p>
	</form>

	

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
<script src="js/main.js"></script>
</body>
</html>