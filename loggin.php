<?php
  $nombre=$_GET['usuario'];
  $contra=$_GET['pass'];

  require "conexion.php";
  $conn=conectar();
  $sql="SELECT * FROM usuarios where usu_usuario='$nombre'";

  $resulset=mysqli_query($conn,$sql);

  $registro=mysqli_fetch_assoc($resulset);

  if(mysqli_affected_rows($conn)>0){

    if($contra==$registro['usu_pass']){
     
      switch($registro['rol_id']){
        case 1:
          header("Location:admin.php");
          break;
        case 2:
          header("Location:directivo.php");
          break;
        case 3:
            header("Location:profesor.php");
            break;
        case 4:
            header("Location:alumno.php");
            break;
        default:
        break;        
      }
    }

    else {
        echo "La contraseña es incorrecta ";
    }

  }
  else {
      echo "No existe el usuario $nombre";
  }

?>