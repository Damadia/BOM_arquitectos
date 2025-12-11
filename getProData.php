<?php
	include("connection.php");

	$proDirErrors = array();

	$dataQuery = "SELECT Nombre, Descripcion, Diainicializacion, Diafinalizacion, CaracterEdificicacion, Usoproyecto, Tipoproyecto, Estado, Id_proyecto
	          FROM proyecto 
	          WHERE proyecto.Id_proyecto = ".$_GET['id_Pro'].";";

	$proyectData = $connec->query($dataQuery)->fetch_assoc(); //Yo se que solo va a ser solo una fila porque hago la query por la llave primaria

	if ($proyectData == null)
		$messagesErrors['notFoundProyect'] = 'No se ha encontrado el proyecto.';

	$dataQuery = "SELECT Pais, Estado, Ciudad, Calle, NumeroResidencia
		          FROM direccion 
	          	  WHERE direccion.Id_proyecto = ".$_GET['id_Pro'].";";
	
	$dirData = $connec->query($dataQuery)->fetch_assoc(); //Yo se que solo va a ser solo una fila porque hago la query por la llave primaria


	if ($dirData == null)
		$messagesErrors['notFoundDirection'] = 'No se ha encontrado la dirección del proyecto.';

	if (!empty($proDirErrors))
		header('Location: errorsTerminal.php');

?>