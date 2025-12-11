<?php
    session_start();
    include('connection.php');

?>

<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<link rel="stylesheet" href="css/bootstrap.min.css">
	<link rel="stylesheet" href="css/generalStyle.css">
	<link rel="stylesheet" href="css/aboutStyle.css">
	<script src="https://kit.fontawesome.com/f1a5c638bd.js" crossorigin="anonymous"></script>
	<title>BOM - Sobre Nosotros</title>
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


	<div class="heroImg">
		<div class="mask">	
			<p class="auItem">Sobre 'BOM arquitectos'</p>
			<p class="auItem">Misión</p>
			<p class="auItem">Visión</p>

			<div class="layoutAuItem" style="display: none;">
				<div class="iconBox">
					<i class="fa-sharp fa-regular fa-circle-xmark fa-xl iconItem"></i>				
				</div>

				<h1 class="title"> SOBRE NOSOTROS</h1>

				<p class="normalText">Lorem, ipsum dolor sit amet consectetur adipisicing, elit. Dolor, voluptates nostrum rerum molestiae? Dignissimos illo quos distinctio, cum eaque neque asperiores quis quam odio perferendis voluptas libero aliquam omnis veritatis. Lorem ipsum, dolor sit amet consectetur, adipisicing elit. Fugiat quod vel dolor libero omnis animi doloribus quo fuga, sunt quasi sint earum pariatur temporibus, molestias tenetur excepturi tempore, nemo tempora. Lorem ipsum dolor sit amet consectetur adipisicing elit. Sunt esse totam eaque cum cupiditate consectetur corrupti in quas facilis distinctio nobis, nisi rem quos, nulla eos id doloremque officia quod.</p>	

			</div>
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
<script src="js/openAbUsOpt.js"></script>
</body>
</html>