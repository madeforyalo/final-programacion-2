<?php

require "conexion.php";

$actualizar=actualizarProf();

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

include "header.php"
?>

    <title>Actualizar profesor</title>
</head>
<body id="fondo">
    <main class="m-3">
        <div class="row">
            <div class="col-12 col-sm-4 pt-1 pb-3">
                <h1>Editar profesor</h1>
                <br>
                <h3><?php echo $apellido; ?>, <?php echo $nombre; ?></h3>
                <a href="loggout.php">Cerrar sesión</a>

                <br><br>
            </div>
            <div class="row">
                <div class="col-12 col-sm-4" style="margin-left: 5%;">
                    <form action="" method=post>
                        <?php while ($resulset = mysqli_fetch_array($actualizar)){?> 
                            
                            <div class="pb-3">
                                <input type="text" name="txtMatricula" id="txtMatricula" value="<?php echo $resulset[0]?>"
                                    class="form-control shadow" readonly="true" title="Matricula" required>

                            </div>
                            <div class="pb-3">
                                <input type="text" name="txtNombre" id="txtNombre" placeholder="<?php echo $resulset[1]?>"
                                    class="form-control shadow" title="Nombre" value="<?php echo $resulset[1]?>" required >
                            </div>
                            <div class="pb-3">
                                <input type="text" name="txtapellido" id="txtapellido" placeholder="<?php echo $resulset[2]?>"
                                    class="form-control shadow" title="Apellido" value="<?php echo $resulset[2]?>" required >
                            </div>
                            
                            <div class="pb-3">
                                <input type="text" name="txtUsuario" id="txtUsuario" placeholder="<?php echo $resulset[3]?>"
                                 class="form-control shadow" title="Usuario" value="<?php echo $resulset[3]?>" required >
                            </div>
                            <input type="text" name="txtusu" id="txtusu" placeholder="<?php echo $resulset[3]?>" hidden>
                       
                        <?php ;} ?>
                        <div>
                            <button type="submit" id="btnActualizar" name="btnActualizar" class="btn btn-primary">Actualizar</button>
                            <a class="btn btn-primary" href="agregar_profesor.php" role="button">Volver</a>
                        </div>
                        <?php
                            
                            if (isset($_POST['btnActualizar'])){
                                updateUsuario();
                                updateProf();
                                $_SESSION['mensaje'] = 'Los datos fueron actualizados';
                                $_SESSION['tipo_mensaje'] = 'warning';
                                Header("location: agregar_profesor.php");
                            }
                        ?>
                    </form>                        
            </div>
            
<?php include "footer.php" ?>