<?php
  $usuario=$_GET['usuario'];
  $contra=$_GET['pass'];

  require "conexion.php";
  $conn=conectar();
  $sql="SELECT * FROM usuarios where usu_usuario='$usuario'";

  $resulset=mysqli_query($conn,$sql);

  $registro=mysqli_fetch_assoc($resulset);

  if(mysqli_affected_rows($conn)>0){

    if($contra==$registro['usu_contra']){

        $_SESSION['id']=$registro['usu_id'];
        $_SESSION['usuario']=$usuario;
        $_SESSION['tipoUsuario']=$registro['rol_id'];
        $_SESSION['nombre']=$registro['usu_nombre'];
        $_SESSION['apellido']=$registro['usu_apellido'];

     
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
        echo "<br><br><h2><a href=index.php><button class='btn btn-info'>Volver</button></a></h2>";
    }

  }
  else {
      echo "No existe el usuario $usuario";
      echo "<br><br><h2><a href=index.php><button class='btn btn-info'>Volver</button></a></h2>";
  }

?>