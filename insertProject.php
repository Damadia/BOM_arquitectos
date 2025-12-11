<?php
	session_start();
	$insertProErrors = array();
	$success = false;

	if ($_SERVER["REQUEST_METHOD"] == "POST") 
	{
		$dateBegin = DateTimeImmutable::createFromFormat('Y-m-d', $_POST['proDayB']);
		$dateEnd = DateTimeImmutable::createFromFormat('Y-m-d', $_POST['proDayE']);


		if ($dateEnd < $dateBegin && $dateEnd != false)
			$insertProErrors['incorrectDaysRange'] = 'La fecha de finalización no puede ser menor que la fecha de inicio';

		if ($_POST['currentStatePro'] == 'Finalizado' && !$dateEnd)
			$insertProErrors['incongruityWithState'] = 'No se puede marcar como finalizado un proyecto que no tiene fecha de fin';
		elseif ($_POST['currentStatePro'] != 'Finalizado' && $dateEnd != false)
			$insertProErrors['incongruityWithState'] = 'No se puede marcar como no finalizado un proyecto que tiene fecha de fin'; 

		include('connection.php');

		$searchQuery = "SELECT CorreoElectronico 
						FROM usuario
						WHERE CorreoElectronico = '".$_POST['userEmail']."';";

		if ($connec->query($searchQuery)->num_rows == 0)
			$insertProErrors['notFoundUser'] = 'No se encontró el usuario para asociarlo a dicho proyecto';

		if (empty($insertProErrors))
		{
			if ($dateEnd != false)
				$insertQueryPro = "INSERT INTO proyecto (Nombre, Descripcion, DiaInicializacion, DiaFinalizacion, UsoProyecto, CaracterEdificicacion, TipoProyecto, Estado, CorreoUsuario) 
							VALUES ('".$_POST['namePro']."', '".$_POST['descPro']."', '".$dateBegin->format('Y-m-d')."', '".$dateEnd->format('Y-m-d')."','".$_POST['usePro']."', '".$_POST['typeBuilt']."', '".$_POST['typePro']."', '".$_POST['currentStatePro']."', '".$_POST['userEmail']."')";
			else
				$insertQueryPro = "INSERT INTO proyecto (Nombre, Descripcion, DiaInicializacion, UsoProyecto, CaracterEdificicacion, TipoProyecto, Estado, CorreoUsuario) 
								VALUES ('".$_POST['namePro']."', '".$_POST['descPro']."', '".$dateBegin->format('Y-m-d')."', '".$_POST['usePro']."', '".$_POST['typeBuilt']."', '".$_POST['typePro']."', '".$_POST['currentStatePro']."', '".$_POST['userEmail']."')";


			$resultIpro = $connec->query($insertQueryPro);

			if (!$resultIpro)
			{
				$insertProErrors['unexpectedError'] = 'Algo salió mal al insertar tu información (proyecto), vuelva a intentarlo';	
				$insertProErrors['detailsUnexErr'] = $connec->error;	
				foreach ($insertProErrors AS $error)
				echo $error."<br>";
//				header('Location: errorsTerminal.php');
			}
			else
			{
				//Con esto obtendré el último proyecto insertado, como cada proyecto se inserta uno a la vez, se que el último ID corresponde al proyecto insertado justo acá arriba en el cófdigo

				$queryPro = "SELECT ID_Proyecto FROM proyecto 
							 ORDER BY ID_Proyecto DESC LIMIT 1";  
				if (!$queryPro)
				{
					$insertProErrors['errorGetLastPro'] = "Algo salió mal a la hora de buscar el último proyecto";
					foreach ($insertProErrors AS $error)
						echo $error."<br>";
				}
				else
				{
					$lastIdPro = $connec->query($queryPro)->fetch_row();

					$auxStateC = $_POST['proStateCountry'];
					$auxProNum = $_POST['proNumber'];
					if ($auxStateC == "")
						$auxStateC = null;
					if ($auxProNum == "")
						$auxProNum = null;

					$insertQueryDir = "INSERT INTO direccion (pais, Estado, ciudad, Calle, NumeroResidencia, Id_proyecto) 
									   VALUES('".$_POST['proCountry']."','".$_POST['proStateCountry']."', '".$_POST['proCity']."', '".$auxProNum."', '".$auxStateC."', '".$lastIdPro[0]."')";

					$resultIDir = $connec->query($insertQueryDir);

					if (!$resultIDir)
					{
						$insertProErrors['unexpectedError'] = 'Algo salió al insertar tu información (dirección), vuelva a intentarlo';
						$insertProErrors['detailsUnexErr'] = $connec->error;	
						foreach ($insertProErrors AS $error)
							echo $error."<br>"; 
					}

					if (empty($insertProErrors))
					{
						$success = true;
		//				header('Location: insertProject.php');
					}
				}

			}
		}
		else
		{
			foreach ($insertProErrors AS $error)
				echo $error."<br>";
		}



	}

?>

<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<title>BOM - Inserción de proyecto </title>
	<link rel="stylesheet" href="css/bootstrap.min.css">
	<link rel="stylesheet" href="css/generalStyle.css">
	<link rel="stylesheet" href="css/projectsTempleateLayaout.css">
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

	<h2 class="headingTitle" style="color: rgba(24, 24, 24, 1.0); background: rgba(230, 230, 230, 1.0); border: none;">Esto es una previsualización</h2>

	<form action="insertProject.php" method="POST">
		<div class="heroImgContainer">
			<img class="heroImg" src="images/highResolutionImage(vertically).png" alt="">
			<div class="headingBox">	
				<h2 class="headingTitle" name="namePro" style="width: 90%;"><input name="namePro" class="fieldElement" size="50" maxlength="50" style="width: 90%; text-align: center;" type="text" placeholder="Coloca aquí el título" required></h2>
			</div>	
		</div>

		<div class="technicalSheet">	
			<h2 class="headingTitle" style="color: rgb(24, 24, 24); border: solid .1rem rgba(24, 24, 24, 1.0);">Ficha técnica</h2>
			<hr class="lineProyect">	
			<p class="technicalData"><span class="technicalTitle">País:</span><input type="text" name="proCountry" class="fieldElement" placeholder="Coloca el país" required></p>
			<hr class="lineProyect">	
			<p class="technicalData"><span class="technicalTitle">Ciudad:</span><input type="text" name="proCity" class="fieldElement" placeholder="Coloca la ciudad" required><input type="text" name="proStateCountry" class="fieldElement" placeholder="Coloca el estado (opcional)"></p>
			<hr class="lineProyect">	
			<p class="technicalData"><span class="technicalTitle">Ubicada en:</span><input type="text" name="proStreet" class="fieldElement" placeholder="Coloca la calle/avenida" required> <input type="number" name="proNumber" class="fieldElement" placeholder="Coloca el número de residencia (opcional)"></p>
			<hr class="lineProyect">
			<p class="technicalData"><span class="technicalTitle">Fecha de elaboración:</span><label for="proDayB">Colocar día de inicio:</label><input style="width: 20%;" type="date" name="proDayB" class="fieldElement" placeholder="Día de inicialización" required><label for="proDayE">Colocar día de fin (opcional):</label><input style="width: 20%;" type="date" name="proDayE" class="fieldElement" placeholder="Día finalización (opcional)"></p>
			<hr class="lineProyect">
			<p class="technicalData"><span class="technicalTitle">Caracter del edificio</span><select class='fieldElement' name='typeBuilt' required>
                  <option class='fieldElement' value='' >Seleccione una opción</option>
                  <option class='fieldElement' value='Casa'>Casa</option>
                  <option class='fieldElement' value='Restaurante'>Restaurante</option>
                  <option class='fieldElement' value='Comercio local'>Comercio local</option>
                  <option class='fieldElement' value='Palapa'>Palapa</option>
                  <option class='fieldElement' value='Jardín'>Jardín</option>
                  <option class='fieldElement' value='Departamento'>Departamento</option>
                  <option class='fieldElement' value='Obra pública cívil'>Obra pública cívil</option>
                  <option class='fieldElement' value='Condominio'>Condominio</option>
                </select></p>
			<hr class="lineProyect">	
			<p class="technicalData"><span class="technicalTitle">Uso del proyecto:</span><select class='fieldElement' name='usePro' required>
	                  <option class='fieldElement' value=''>Seleccione una opción</option>
	                  <option class='fieldElement' value='Residencial'>Residencial</option>
	                  <option class='fieldElement' value='Laboral'>Laboral</option>
	                  <option class='fieldElement' value='Comercial'>Comercial</option>
	                  <option class='fieldElement' value='Recreativo'>Recreativo</option>
	                  <option class='fieldElement' value='Urbanismo'>Urbanismo</option>
	                  <option class='fieldElement' value='Industrial'>Industrial</option>
	                  <option class='fieldElement' value='Institucional'>Institucional</option>
               		  </select></p>
			<hr class="lineProyect">
			<p class="technicalData"><span class="technicalTitle">Tipo de proyecto:</span><select class='fieldElement' name='typePro' required>
	                  <option class='fieldElement' value=''>Seleccione una opción</option>
	                  <option class='fieldElement' value='Remodelación'>Remodelación</option>
	                  <option class='fieldElement' value='Interiorismo'>Interiorismo</option>
	                  <option class='fieldElement' value='Proyecto nuevo'>Proyecto nuevo</option>
	                  <option class='fieldElement' value='Remodelación Urbana'>Remodelación Urbana</option>
	                  <option class='fieldElement' value='Visualización'>Visualización</option>
	                </select></p>
			<hr class="lineProyect">
			<p class="technicalData"><span class="technicalTitle">Estado del proyecto:</span><select class='fieldElement' name='currentStatePro' required>
	                  <option class='fieldElement' value=''>Seleccione una opción</option>
	                  <option class='fieldElement' value='Concepción'>Concepción</option>
	                  <option class='fieldElement' value='En proceso'>En proceso</option>
	                  <option class='fieldElement' value='Finalizado'>Finalizado</option>
	                </select></p>
			<hr class="lineProyect">
		</div>

		<div class="descriptionProject">
			<h2 class="headingTitle" style="color: rgb(24, 24, 24); border: solid .1rem rgba(24, 24, 24, 1.0);">Descripción</h2>
			<textarea name="descPro" placeholder="Escriba una descripción" size="2000" maxlength="3000" rows="10" class="largeFieldElement" required></textarea>
			<hr class="lineProyect">
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

		<p class="technicalData">
			<span class="technicalTitle">Correo:</span><input type="email" name="userEmail" class="fieldElement" placeholder="Coloca el correo del usuario" required>
		</p>

		<div class='checkFix fieldElement'>
			<label class='conCheck' for='confirmCheck' required>Confirmo querer añadir estos datos:</label>
			<input name='confirmCheck' type='checkbox' required style='margin: ;'>
		</div>

		<input type="submit" class="submitBtn" value="Añadir el proyecto (podrá eliminarlo después)">	
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