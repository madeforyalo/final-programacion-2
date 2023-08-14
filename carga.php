<?php
require "conexion.php";
$conn=conexion();
$nombre=$_POST ['txtNombre'];
$apellido=$_POST ['txtapellido'];
$dni=$_POST ['txtdni'];
$fechaDeNac=$_POST ['txtFecha'];
$direccion=$_POST ['txtDireccion'];
$tel=$_POST ['txtTelefono'];

$sql="insert into alumnos(alu_id, alu_nom, alu_ape, alu_dni, alu_dir, alu_fecha, alu_tel)
values (null, '$nombre', '$apellido', $dni, '$direccion', '$fechaDeNac', $tel);";

$query=mysqli_query($conn,$sql);

$_SESSION['mensaje'] = 'Los datos se cargaron con exitó!';
$_SESSION['tipo_mensaje'] = 'success';

if ($query){
    Header("location: index.php");
};

?>