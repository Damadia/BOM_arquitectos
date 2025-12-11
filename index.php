<?php
	session_start();
?>

<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<title>BOM - Inicio </title>
	<link rel="stylesheet" href="css/bootstrap.min.css">
	<link rel="stylesheet" href="css/generalStyle.css">
	<link rel="stylesheet" href="css/indexStyle.css">
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


	<div class="container-fluid carouselContainer">
		<div id="carouselMain" class="carousel slide" data-bs-ride="carousel">
			<div class="heading">
				<h1> HEADING</h1>
				<p class="normalText">Lorem ipsum, dolor sit, amet consectetur adipisicing elit. Aliquid, magni.</p>
			</div>

			<div class="carousel-indicators">
				<button type="button" data-bs-target="#carouselMain" data-bs-slide-to="0" class="active" aria-current="true" aria-label="Slide 1"></button>
				<button type="button" data-bs-target="#carouselMain" data-bs-slide-to="1" aria-label="Slide 2"></button>
				<button type="button" data-bs-target="#carouselMain" data-bs-slide-to="2" aria-label="Slide 3"></button>
				<button type="button" data-bs-target="#carouselMain" data-bs-slide-to="3" aria-label="Slide 4"></button>
			</div>

			<div class="carousel-inner">
				<div class="carousel-item active">
					<img src="images/highResolutionImage(vertically).png" class="img-fluid" alt="...">
				</div>
				<div class="carousel-item">
					<img src="images/highResolutionImage.png" class="img-fluid" alt="...">
				</div>
				<div class="carousel-item">
					<img src="images/bomLogo.jpg" class="img-fluid	" alt="...">
				</div>
				<div class="carousel-item">
					<img src="images/ontario/1EntradaTechado.jpg" class="img-fluid	" alt="...">
				</div>
			</div>

			<button class="carousel-control-prev" type="button" data-bs-target="#carouselMain" data-bs-slide="prev">
				<span class="carousel-control-prev-icon" aria-hidden="true"></span>
				<span class="visually-hidden">Previous</span>
			</button>

			<button class="carousel-control-next" type="button" data-bs-target="#carouselMain" data-bs-slide="next">
				<span class="carousel-control-next-icon" aria-hidden="true"></span>
				<span class="visually-hidden">Next</span>
			</button>
		</div>
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
<script src="js/main.js"></script>
<script src="https://kit.fontawesome.com/f1a5c638bd.js" crossorigin="anonymous"></script>
</body>
</html>