<?php
require "conexion.php";
$c= conectar();
$alu_id = $_GET['alumnos'];
$mat_id = $_GET['mat'];
$sql="INSERT INTO aluxmat VALUE (null, '$alu_id', '$mat_id');";
$query=mysqli_query($c, $sql);

if(mysqli_affected_rows($sql)){
        $_SESSION['mensaje'] = 'Agregado correctamente';
        $_SESSION['tipo_mensaje'] = 'success';
        Header("location: inscripcion.php");
}else{
        $_SESSION['mensaje'] = 'No se pudo cargar';
        $_SESSION['tipo_mensaje'] = 'warning';
        Header("location: inscripcion.php");
    }
?>