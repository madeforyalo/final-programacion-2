<?php
require "conexion.php";
$conn=conectar();
$nombre=$_POST ['txtNombre'];
$apellido=$_POST ['txtapellido'];
$dni=$_POST ['txtdni'];

$sql="insert into profesores(prof_id, prof_nom, prof_ape, prof_dni)
values (null, '$nombre', '$apellido', $dni);";

$query=mysqli_query($conn,$sql);

$_SESSION['mensaje'] = 'Los datos se cargaron con exitó!';
$_SESSION['tipo_mensaje'] = 'success';

if ($query){
    Header("location: agregar_profesor.php");
};

?>