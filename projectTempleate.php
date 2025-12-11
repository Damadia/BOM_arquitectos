<?php
	session_start();
	include('getProData.php');

?>

<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<title>BOM - <?php echo $proyectData['Nombre'];?> </title>
	<link rel="stylesheet" href="css/bootstrap.min.css">
	<link rel="stylesheet" href="css/generalStyle.css">
	<link rel="stylesheet" href="css/projectsTempleateLayaout.css">
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

	<div class="heroImgContainer">
		<img class="heroImg" src="images/highResolutionImage(vertically).png" alt="">
		<div class="headingBox">	
			<h2 class="headingTitle"><?php echo $proyectData['Nombre']?></h2>
		</div>	
	</div>

	<div class="technicalSheet">	
		<h2 class="headingTitle" style="color: rgb(24, 24, 24); border: solid .1rem rgba(24, 24, 24, 1.0);">Ficha técnica</h2>

		<p class="technicalData"><span class="technicalTitle">País:</span><?php echo $dirData['Pais']?></p>
		<p class="technicalData"><span class="technicalTitle">Ciudad:</span><?php echo $dirData['Ciudad'].", ".$dirData['Estado']?></p>
		<p class="technicalData"><span class="technicalTitle">Ubicada en:</span><?php echo $dirData['Calle']." ".$dirData['NumeroResidencia']?></p>
		<p class="technicalData"><span class="technicalTitle">Fecha de elaboración:</span><?php if (isset($proyectData['Diafinalizacion'])) 
																									echo $proyectData['Diainicializacion']." --- ".$proyectData['Diafinalizacion'];
																								else 
																									echo $proyectData['Diainicializacion']." --- Actualmente"?></p>
		<p class="technicalData"><span class="technicalTitle">Caracter del edificio:</span><?php echo $proyectData['CaracterEdificicacion'];?></p>
		<p class="technicalData"><span class="technicalTitle">Uso del proyecto:</span><?php echo $proyectData['Usoproyecto'];?></p>
		<p class="technicalData"><span class="technicalTitle">Tipo de proyecto:</span><?php echo $proyectData['Tipoproyecto'];?></p>
		<p class="technicalData"><span class="technicalTitle">Estado del proyecto:</span><?php echo $proyectData['Estado'];?></p>
	</div>

	<div class="descriptionProject">
		<h2 class="headingTitle" style="color: rgb(24, 24, 24); border: solid .1rem rgba(24, 24, 24, 1.0);">Descripción</h2>
		<?php echo $proyectData['Descripcion'];?>
	</div>

	<div class="gallery">
		<h2 class="headingTitle" style="color: rgb(24, 24, 24); border: solid .1rem rgba(24, 24, 24, 1.0);">Galería</h2>

		<div class="images">
			<img class="imgGallery" src="images/highResolutionImage(vertically).png" alt="">
			<img class="imgGallery" src="images/highResolutionImage.png" alt="">
			<img class="imgGallery" src="images/highResolutionImage.png" alt="">
			<img class="imgGallery" src="images/highResolutionImage(vertically).png" alt="">
			<img class="imgGallery" src="images/highResolutionImage.png" alt="">
			<img class="imgGallery" src="images/highResolutionImage(vertically).png" alt="">
			<img class="imgGallery" src="images/highResolutionImage.png" alt="">	
		</div>
	</div>


	<?php 
		if (isset($_SESSION['tier']) && (int)$_SESSION['tier'] == 2)
			echo "<div class='actionsOpt'>
					<form action='editProject.php' method='Get'>
						<input type='text' name='id_Pro' value='".$proyectData['Id_proyecto']."' style='display: none;' readonly>
						<input class='hyStyle' type='submit' value='Editar proyecto'>
					</form>
					<hr>
					<form action='deleteProject.php' method='Post'>
						<input type='text' name='id_Pro' value='".$proyectData['Id_proyecto']."' style='display: none;' readonly>
						<div class='checkFix'>
							<label class='conCheck' for='confirmCheck'>Confirma esta casilla para proseguir:</label>
							<input name='confirmCheck' type='checkbox' required style='margin: ;'>
						</div>
						<input class='hyStyle warningBtn' type='submit' value='Borrar proyecto'>
					</form>
				</div>";
	?>
		
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