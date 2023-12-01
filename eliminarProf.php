<?php

require "conexion.php";

$conn=conectar();

$id_matricula=$_GET['id'];

$buscar= "SELECT usu_usuario FROM profesores WHERE prof_id='$id_matricula';";
$query=mysqli_query($conn,$buscar);
$row = mysqli_fetch_assoc($query);
$usuario = $row['usu_usuario'];


$sql="DELETE FROM profesores WHERE usu_usuario='$usuario';";
$query2=mysqli_query($conn,$sql);

$sql1="DELETE FROM usuarios WHERE usu_usuario='$usuario';";
$query1=mysqli_query($conn,$sql1);

    if ($query1){
        $_SESSION['mensaje'] = 'Los datos fueron borrados';
        $_SESSION['tipo_mensaje'] = 'danger';
        header("location: agregar_profesor.php");
    }
?>