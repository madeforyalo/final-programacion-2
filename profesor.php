<?php
require "conexion.php"; 
if(isset($_SESSION['id']) && $_SESSION['tipoUsuario']==3 || $_SESSION['tipoUsuario']==1){
    $usuario = $_SESSION['usuario'];
    $nombre = $_SESSION['nombre'];
    $apellido = $_SESSION['apellido'];
}
else{
    echo"Pagina Prohibida. Inicie Sesion";
    echo "<br><br><h2><a href=index.php><button class='btn btn-info'>Iniciar sesion</button></a></h2>";
    exit();
}
$c = conectar();
$sql = "SELECT car_id, car_desc FROM carreras ORDER BY car_desc ASC";
$query = mysqli_query($c, $sql);                 
   
include "header.php";
?>

<script language="javascript">
    $(document).ready(function(){
        $("#carrera").change(function () {
            
            $("#carrera option:selected").each(function () {
                car_id = $(this).val();
                $.post("getMaterias.php", { car_id: car_id }, function(data){
                    $("#materia").html(data);
                });            
            });
        })
    });
    
     $(document).ready(function(){
          $("#materia").change(function () {
              $("#materia option:selected").each(function () {
                  mat_id = $(this).val();
                  $.post("getAlumnos.php", { mat_id: mat_id }, function(data){
                      $("#alumnos").html(data);
                  });                        
              });
          })
     });

    $(document).ready(function(){
        $("#materia").change(function () {
            $("#materia option:selected").each(function () {
                mat_id = $(this).val();
                $.post("conexion.php", { mat_id: mat_id }
            );                        
            });
        })
    });
</script>

    <title>Notas</title>
</head>

<body id="fondo">
    <main class="m-3">
        <div class="row">
        <div class="row">
            <div class="col-12 col-sm-4 pt-1 pb-3">
                <h1>Cargar notas</h1>
                <br>
                <h3><?php echo $apellido; ?>, <?php echo $nombre; ?></h3>
                <a href="loggout.php">Cerrar sesión</a>
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
        <form id="combo" name="combo" action="" method="post">
                <div>
                    <label for="carrera">Carrera:  </label>
                    <select name="carrera" id="carrera" class="form-control" style=" width: 300px">
                        <option selected disabled value="0">Seleccione una Carrera...</option>
                        <?php while($row=mysqli_fetch_assoc($query)){ ?>
                        <option value="<?php echo $row['car_id'];?>"><?php echo $row['car_desc'];?></option>
                        <?php } ?>
                    </select>
                </div>
                <div>
                    <label for="materia">Materia: </label>
                    <select name="materia" id="materia" style=" width: 300px" class="form-control"></select>
                </div>
                <div>
                    <button type="submit" name="btnBuscar">Buscar</button>
                </div>
            </form>
            <?php
            
                if (isset($_POST['btnBuscar'])){
                    $busalum = buscarAlum();
                    if (mysqli_num_rows($busalum) > 0){
            ?>

                        <div style="padding: 10px;">
                            <input type="text" id="myInput" onkeyup="searchTable()" placeholder="Buscar..." style=" width: 300px" class="form-control shadow">
                        </div>    
                            <div class="table" style="overflow: auto;">
                                    <table class="table shadow" id="myTable" >
                                        <thead class="table-dark table-striped">
                                            <tr>
                                                <th></th>
                                                <th>Nombre</th>
                                                <th>Apellido</th>
                                                <th>Primer parcial</th>
                                                <th>Segundo parcial</th>
                                                <th>Final</th>
                                                <th>Guardar Nota</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <?php
                                                while($registro=mysqli_fetch_assoc($busalum)){ //muestra las filas relacionadas con la posicion
                                            
                                            ?>
                                                <form action="actualizar_notas.php" method="post">
                                                    <tr>
                                                        
                                                        <td> <input type="radio" name="notaId" value="<?php echo $registro['nota_id'] ?>" require> </td>
                                                            <input type="text" name="idAlumno" class="idAlumno" value="<?php echo $registro['alu_id']?>" hidden>
                                                            <input type="text" name="idMat" class="idMat" value="<?php echo $registro['mat_id']?>" hidden>
                                                        <td><?php echo $registro['alu_nom']?></td>
                                                        <td><?php echo $registro['alu_ape']?></td>
                                                        <td><input type="number" name="parcial1" class="parcial1" value="<?php echo $registro['nota_1']?>"></td>                                            
                                                        <td><input type="number" name="parcial2" class="parcial2" value="<?php echo $registro['nota_2']?>"></td>
                                                        <?php
                                                            $p1 = $registro['nota_1'];
                                                            $p2 = $registro['nota_2'];
                                                            $f = ($p1 + $p2)/2;
                                                            if ($f < 4) {
                                                        ?>                                            
                                                        <td><input type="number" name="final" class="final"  disabled></td>
                                                        <?php 
                                                        }else {?> <td><input type="number" name="final" class="final" value="<?php echo $registro['nota_final']?>"></td> <?php } ?>
                                                        <td><button class="cargarNota">Cargar</button></td>
                                                    </tr>
                                                </form>
                                                <?php
                                                    }
                                                ?>
                                        </tbody>
                                    </table>
                                </div>
                    <?php
                            }else{echo "No hay alumnos cargados para esta materia";}
                        }
                    ?>

</main>
<?php include "footer.php" ?>