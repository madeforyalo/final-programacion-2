<?php
	require ('conexion.php');
	$c = conectar();
	$car_id = $_POST['car_id'];
	
	$sql = "SELECT mat_id, mat_nom FROM materias WHERE car_id = '$car_id' ORDER BY mat_nom ASC";
	$queryM = mysqli_query($c, $sql);
	
	$html= "<option value='0'>Seleccionar una Materia...</option>";
	
	while($rowM = mysqli_fetch_assoc($queryM))
	{
		$html.= "<option value='".$rowM['mat_id']."'>".$rowM['mat_nom']."</option>";
	}
	
	echo $html;
?>