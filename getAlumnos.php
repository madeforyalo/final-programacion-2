<?php
	require ('conexion.php');
	$c = conectar();
	$mat_id = $_POST['mat_id'];
	
	$sql = "SELECT alumnos.alu_id, alumnos.alu_nom, alumnos.alu_ape FROM aluxmat 
        inner join alumnos on aluxmat.alu_id = alumnos.alu_id
        inner join materias on aluxmat.mat_id = materias.mat_id
        WHERE materias.mat_id = '$mat_id' 
        ORDER BY alu_ape ASC";
	$queryA = mysqli_query($c, $sql);
	
	$html= "<option value='0'>Seleccionar un Alumno...</option>";
	
	while($rowA = mysqli_fetch_assoc($queryA))
	{
		$html.= "<option value='".$rowA['alu_id']."'>".$rowA['alu_ape']." ".$rowA['alu_nom']."</option>";
	}
	
	echo $html;
?>
