<?php
require "conexion.php";
$conn=conectar();
$nombre=$_POST ['txtNombre'];
$apellido=$_POST ['txtapellido'];
$usuario=$_POST ['txtUsuario'];
$pass=$_POST ['txtPass'];

$sql="SELECT * FROM profesores WHERE usu_usuario = '$usuario'";
$query=mysqli_query($conn,$sql);
$resulset= mysqli_fetch_assoc($query);

if ($resulset['usu_usuario'] == $usuario){
    $_SESSION['mensaje'] = 'El usuario ya se encuentra cargado';
    $_SESSION['tipo_mensaje'] = 'danger';
    Header("location: agregar_profesor.php");
}else{

    $sql3= "INSERT INTO usuarios VALUES (null,'$nombre', '$apellido', '$usuario', '$pass',  3);";
    $query3=mysqli_query($conn,$sql3);

    $sql2="INSERT INTO profesores
    values (null, '$nombre', '$apellido', '$usuario', 3);";
    $query2=mysqli_query($conn,$sql2);

    if ($query2){
        $_SESSION['mensaje'] = 'Los datos se cargaron con exitó!';
        $_SESSION['tipo_mensaje'] = 'success';
        Header("location: agregar_profesor.php");
    };
}
?>