<?php
require "conexion.php";                  
   
if(isset($_SESSION['id']) && $_SESSION['tipoUsuario']==1){
    $usuario = $_SESSION['nombre'];
    }
    else{
        echo"Pagina Prohibida. Inicie Sesion";
        echo "<br><br><h2><a href=index.php><button class='btn btn-info'>Iniciar sesion</button></a></h2>";
        exit();
    }

include "header.php";              
?>

    <title>Agregar Alumnos</title>
</head>

<body id="fondo">
    <main class="m-3">
        <div class="row">
            <div class="col-12 col-sm-4 pt-1 pb-3">
                <h1>Agregar Alumno</h1>
                <br>
                <h3><?php echo $apellido; ?>, <?php echo $nombre; ?></h3>
                <a href="loggout.php">Cerrar sesión</a>

                <br><br>
            </div>
            <div class="col-sm-8">
            <?php if(isset($_SESSION['mensaje'])){ ?>
                <div class="alert alert-<?= $_SESSION['tipo_mensaje']; ?> alert-dismissible fade show" role="alert">
                    <?= $_SESSION['mensaje'] ?>
                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                </div>
                <?php session_unset();} ?>
            </div>
        </div>
        <div class="row">
            <div class="col-12 col-sm-4">
                <form action="carga.php" method=post>
                    <!-- <div class="pb-3">
                        <input type="text" name="txtMatricula" id="txtMatricula" placeholder="Matricula"
                            class="form-control shadow" title="Matricula" required >
                    </div> -->
                    <div class="pb-3">
                        <input type="text" name="txtNombre" id="txtNombre" placeholder="Nombre"
                            class="form-control shadow" title="Nombre" required >
                    </div>
                    <div class="pb-3">
                        <input type="text" name="txtapellido" id="txtapellido" placeholder="apellido"
                            class="form-control shadow" title="Apellido" required >
                    </div>
                    <div class="pb-3">
                        <input type="text" name="txtUsuario" id="txtUsuario" placeholder="Usuario" class="form-control shadow"
                        title="Usuario" required >
                    </div>
                    <div class="pb-3">
                        <input type="password" name="txtPass" id="txtPass" placeholder="Contraseña"
                            class="form-control shadow" title="Contraseña" required >
                    </div>
                    <!-- <div class="pb-3">
                        <input type="text" name="txtDireccion" id="txtDireccion" placeholder="Direccion"
                            class="form-control shadow" title="Dirección" required >
                    </div>
                         <div class="pb-3">
                            <input type="text" name="txtLocalidad" id="txtLocalidad" placeholder="Localidad"
                                class="form-control shadow" title="Localidad" required >
                        </div> 
                    <div class="pb-3">
                        <input type="tel" name="txtTelefono" id="txtTelefono" placeholder="Telefono/Celular"
                            class="form-control shadow" title="Telefono" >
                    </div> -->
                    <div>
                        <button type="submit" id="btnAgregar" name="btnAgregar" class="btn btn-primary" style="margin-right: 25px;">Agregar</button>
                        <a href="admin.php" class="btn btn-primary">Volver</a>
                        <!-- <input type="text" name="txtBuscar" id="txtBuscar" placeholder="Buscar por Matricula"
                            class="form-control shadow" title="Buscar por Matricula" style="width: 50%;display: inline;">
                        <button type="submit" id="btnBuscar" name="btnBuscar" class="btn btn-primary" formaction="" formmethod="get">Buscar</button> -->
                    </div>
                    <div>
                        <!-- <a class="btn btn-primary" href="index.php" role="button" style="margin-top: 10px;">Mostrar todo</a> -->
                    </div>
                </form>
            </div>
            <?php 
                $bcr=todoAlumnos();

                // if (isset($_GET['btnBuscar'])){
                //     $bcr=buscarAlum();
                // }                               
            ?>
            <div class="col-12 col-sm-8">
                <div style="padding: 10px;">
                    <input type="text" id="myInput" onkeyup="searchTable()" placeholder="Buscar..." style=" width: 300px" class="form-control shadow">
                </div>
                    <div class="table">
                        <table class="table shadow">
                            <thead class="table-dark table-striped">
                                <tr>
                                    <th>ID</th>
                                    <th>Nombre</th>
                                    <th>Apellido</th>
                                    <th>Usuario</th>
                                    <!-- <th>Direccion</th>
                                    <th>Fecha de nacimiento</th>
                                    <th>Telefono</th> -->
                                    <th>Acciones</th>
                                </tr>
                            </thead>
                            <tbody id="myTable">
                                <?php
                                    if (mysqli_num_rows($bcr)> 0){
                                    while($registro=mysqli_fetch_array($bcr)){ //muestra las filas relacionadas con la posicion
                                ?>
                                        <tr>
                                            <td><?php echo $registro[0]?></td>
                                            <td><?php echo $registro[1]?></td>
                                            <td><?php echo $registro[2]?></td>
                                            <td><?php echo $registro[3]?></td>
                                            <!-- <td><?php //echo $registro[4]?></td>
                                            <td><?php // echo $registro[5]?></td>
                                            <td><?php //echo $registro[6]?></td> -->
                                            <td><a href="actualizarAlumno.php?id=<?php echo $registro[0]?>" title="Editar" style="margin-right: 15px" ><i class="fa-solid fa-marker"></i></a>                                            
                                            <a href="ver.php?id=<?php echo $registro[0]?>" method="get" title="Borrar"><i class="fa-solid fa-trash-can" style="color: red;"></i></a></td>                                            
                                        </tr>
                                <?php
                                    }
                                } else{
                                    echo "No hay alumnos cargados";
                                }
                                ?>
                            </tbody>
                        </table>
                    </div>
            </div>
        </div>
<?php include "footer.php" ?>