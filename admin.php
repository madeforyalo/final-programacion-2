<?php
require "conexion.php";  

if(isset($_SESSION['id']) && $_SESSION['tipoUsuario']==1){
    //todo ok
    $usuario = $_SESSION['usuario'];
    $nombre = $_SESSION['nombre'];
    $apellido = $_SESSION['apellido'];
    }
    else{
        echo"Pagina Prohibida. Inicie Sesion";
        echo "<br><br><h2><a href=index.php><button class='btn btn-info'>Iniciar sesion</button></a></h2>";
        exit();
    }
   
include "header.php";
?>
    <title>admin</title>
    
</head>
<body id="fondo">

<br>
                <h3><?php echo $apellido; ?>, <?php echo $nombre; ?></h3>
                <a href="loggout.php">Cerrar sesión</a>
                <br>
                <br>

<a href="agregarAlumno.php">ABM Alumnos</a>
<br>
<br>
<a href="inscripcion.php">Inscripcion</a>
<br>
<br>

<a href="agregar_profesor.php">ABM Profesor</a>
<br>
<br>

<a href="#">Agregar Materia</a>
<br>
<br>

<a href="#">Agregar Carrera</a>


<?php include "footer.php" ?>