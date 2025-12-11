<?php 
    session_start();
  include('connection.php');
  $success = false;
  $contactErrors = array();
  $result = null;

  if ($_SERVER["REQUEST_METHOD"] == "POST")
  {
    $userEmail = $_POST['emailUs'];
    $userPassword = $_POST['passUs'];

    $searchUserQuery = "SELECT CorreoElectronico
             FROM usuario
             WHERE usuario.CorreoElectronico = '".$userEmail."' AND usuario.Contraseña = '".$userPassword."';";
    
    $result = $connec->query($searchUserQuery);

    // $row = $result->fetch_assoc();

    if ($result->num_rows < 1)
      $contactErrors['notRegisterUser'] = "El usuario que nos proporcionó no se encuentra registrado";

    $detailsProyect = $_POST['detailsPro'];
    if (strlen($detailsProyect) > 500)
        $contactErrors['veryLongDetails'] = 'Envió una descripción muy larga';


    $typeProyect = $_POST['typePro'];
    if ($typeProyect == "null")
      $contactErrors['nosSelectedTypePro'] = "No seleccionaste ningún tipo de proyecto";
    
    if (!isset($_POST['withConstruction']))
      $construction = 0;
    else
      $construction = 1;


    if (empty($contactErrors))
    {
        $insertQuery = "INSERT INTO solicitud
                        VALUES (NULL, '".$detailsProyect."', '".date("Y/m/d")."', '".$typeProyect."', 'No atendida', 0, '".$userEmail."', '".$construction."', NULL);";
          $result = $connec->query($insertQuery);
          if ($result)
          {
            $success = true;
            echo "todo bien";
          }
          else
          { 
              echo "Algo mal <br>";
              echo $connec->error;
          }
        }
        else
        {
          foreach($contactErrors as $error)
            echo $error;

        }
    }
?>

<!DOCTYPE html>
    <html lang="en">
    <head>
      <meta charset="UTF-8">
      <meta name="viewport" content="width=device-width, initial-scale=1.0">
      <title>BOM - Contacto</title>
      <!-- Bootstrap CSS -->
      <link rel="stylesheet" href="css/bootstrap.min.css">
      <link rel="stylesheet" href="css/generalStyle.css">
      <link rel="stylesheet" href="css/contactStyle.css">
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

    <div class="heroImgContainer">
        <img src="images/highResolutionImage.png" class="heroImg" alt="">
        <div class="heading">
            <h1 class="headingTitle"> Formas de contactarnos </h1>
            <div class="contactBox">
                <div class="textContact">
                    <p class="labelContact"> TELÉFONO</p>
                    <a class="contactData" href="https://api.whatsapp.com/send?phone=9932062633" target="blank">(+52) 993 206 2633</a>
                </div>

                <div class="textContact">
                    <p class="labelContact"> CORREO </p>
                    <a class="contactData" href="mailto:Byron_Ortiz97@hotmail.com" target="blank">Byron_Ortiz97@hotmail.com</a>
                </div>

          </div>
        </div>
    </div>    


    <?php 
        if (isset($_SESSION['email']))
            echo "<form class='form2Style' style='border-radius:0;' action='contact.php' method='post'>

                    <legend class='TitleForm'> Llena los datos y te responderemos </legend>
                    <!-- A session start check -->

                    <label class='FormLabel'>Correo</label>  
                    <input class='fieldElement' type='email' name='emailUs' required>

                    <label class='FormLabel' >Contraseña</label>  
                    <input class='fieldElement' type='password' name='passUs' id='nameField' required>

                    <label class='FormLabel'>Danos detalles de tu proyecto</label>
                    <textarea maxlength='600' class='largeFieldElement' rows='5' name='detailsPro'></textarea>

                    <label class='FormLabel'>¿Qué tipo de proyecto desea solicitar?</label>
                    <select class='fieldElement' name='typePro' required>
                      <option class='fieldElement' value=''>Seleccione una opción</option>
                      <option class='fieldElement' value='Remodelación'>Remodelación</option>
                      <option class='fieldElement' value='Interiorismo'>Interiorismo</option>
                      <option class='fieldElement' value='Proyecto nuevo'>Nuevo proyecto</option>
                      <option class='fieldElement' value='Remodelación Urbana'>Remodelación Urbana</option>
                      <option class='fieldElement' value='Visualización'>Visualización</option>
                    </select>

                    <label class='FormLabel'>¿Lo desea con obra?</label>
                    <input class='fieldElement' value='1' type='checkbox' name='withConstruction' style='width: 1.5%;'>

                    <input class='centerField hyStyle' type='submit' value='Mandar solicitud'>

                    <hr class='FormLine' style='border:solid white .1rem;'>

                    <a class='hyStyle' href='request.php'> Ver mis solicitudes </a> 
                </form>";
        else
            echo "<p class='notRegisterMsg'> Resgistrate para mandarnos una solictud de proyecto
                    <a class='hyStyle' href='formRegister.php'>Registrarme</a>
                </p>";            
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
</body>
</html>
