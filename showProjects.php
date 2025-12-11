<?php
	
	$queryRequest = "SELECT * 
					 FROM proyecto;";


	$result = $connec->query($queryRequest);
	$actualRow =array();
	$actualRow = $result->fetch_assoc();

	$topTitle = true;
	while ($actualRow != NULL)
	{
		//Después modificar está parte para hacer que el título de los proyectos intercale entre arriba y abajo



		if ($topTitle)
			echo "<form action='projectTempleate.php' method='Get' class='cardProject'>
					<div class='textCard'>
						<label for='headTitle'><span class='cardTitle'>".$actualRow['Nombre']."</span></label>
						<input name='headTitle' type='text' value='".$actualRow['Nombre']."' readonly style='display: none;'>
	 					<p class='cardThumb'>".$actualRow['CaracterEdificicacion']."</p>
					</div>
					<img class='imgCard' src='images/highResolutionImage.png' alt=''>
					<input type='text' name='id_Pro' value='".$actualRow['ID_Proyecto']."' readonly style='display: none;''>
					<input class='sbtStyle' type='submit' value='Ver proyecto' class='cardThumb'>
				</form>";
		else
			echo "<form action='projectTempleate.php' method='Get' class='cardProject'>
					<img class='imgCard' src='images/highResolutionImage.png' alt=''>
					<div class='textCard'>
						<label for='headTitle'><span class='cardTitle'>".$actualRow['Nombre']."</span></label>
						<input name='headTitle' type='text' value='".$actualRow['Nombre']."' readonly style='display: none;'>
	 					<p class='cardThumb'>".$actualRow['CaracterEdificicacion']."</p>
					</div>
					<input type='text' name='id_Pro' value='".$actualRow['ID_Proyecto']."' readonly style='display: none;''>
					<input class='sbtStyle' type='submit' value='Ver proyecto' class='cardThumb'>
				</form>";
		$actualRow = $result->fetch_assoc();
		$topTitle = !$topTitle;
	}
?>
