<?php
	include('connection.php');

	$changeProErros = array();

	if (!isset($_POST['typeBuilt']))
		$changeProErros['nullTypeBuilt'] = "Información nula para el tipo del construcción";

	if (!isset($_POST['usePro']))
		$changeProErros['nullUsePro'] = "Información nula para el uso del proyecto";

	if (!isset($_POST['usePro']))
		$changeProErros['nullTypePro'] = "Información nula para el tipo del proyecto";

	if (!isset($_POST['usePro']))
		$changeProErros['nullCurrentStatePro'] = "Información nula para el estado del proyecto";



	echo $_POST['PRO_ID'];
	$queryChange = "UPDATE proyecto
	                SET Nombre ='".$_POST['titlePro']."',Descripcion ='".$_POST['descPro']."',Diainicializacion ='".$_POST['dayB']."', Diafinalizacion ='".$_POST['dayE']."', UsoProyecto ='".$_POST['usePro']."',CaracterEdificicacion ='".$_POST['typeBuilt']."',TipoProyecto ='".$_POST['typePro']."', Estado ='".$_POST['currentStatePro']."' 
	                WHERE proyecto.Id_proyecto =".$_POST['PRO_ID'].";";

	$connec->query($queryChange);

	$queryChange = "UPDATE direccion
					SET Pais = '".$_POST['dirCountry']."', Estado = '".$_POST['dirStateC']."', Ciudad = '".$_POST['dirCity']."', Calle = '".$_POST['dirStreet']."', NumeroResidencia = '".$_POST['dirNumber']."'
					WHERE direccion.Id_proyecto = ".$_POST['PRO_ID'].";";

	if (!$connec->query($queryChange))
		{
			echo "Algo salió mal <br>";
			echo $connec->error;
		}
	else
		header('Location: projects.php')

?>