<?php
require "conexion.php";
$conn=conectar();
$nombre=$_POST ['txtNombre'];
$apellido=$_POST ['txtapellido'];
$usuario=$_POST ['txtUsuario'];
$pass=$_POST ['txtPass'];
// $direccion=$_POST ['txtDireccion'];
// $tel=$_POST ['txtTelefono'];

$sql="SELECT * FROM alumnos WHERE usu_usuario = '$usuario'";
$query=mysqli_query($conn,$sql);
$resulset= mysqli_fetch_assoc($query);

if ($resulset['usu_usuario'] == $usuario){
    $_SESSION['mensaje'] = 'El Alumno ya se encuentra cargado';
    $_SESSION['tipo_mensaje'] = 'danger';
    Header("location: agregarAlumno.php");
}else{

    $sql3= "INSERT INTO usuarios VALUES (null,'$nombre', '$apellido', '$usuario', '$pass',  4);";
    $query3=mysqli_query($conn,$sql3);

    $sql2="insert into alumnos(alu_id, alu_nom, alu_ape, usu_usuario, rol_id)
    values (null, '$nombre', '$apellido', '$usuario', 4);";
    $query2=mysqli_query($conn,$sql2);

    if ($query2){
        $_SESSION['mensaje'] = 'Los datos se cargaron con exitó!';
        $_SESSION['tipo_mensaje'] = 'success';
        Header("location: agregarAlumno.php");
    };
}
?>