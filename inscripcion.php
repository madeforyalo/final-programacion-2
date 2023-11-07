<?php
require "conexion.php";        

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
                $.post("conexion.php", { car_id: car_id }, //function(data){
                    //$("#materia").html(data);
                );            
            });
        })
    });
    
    //   $(document).ready(function(){
    //        $("#alumnos").change(function () {
    //            $("#alumnos option:selected").each(function () {
    //                alu_id = $(this).val();
    //                $.post("inscripcion.php", { alu_id: alu_id }, //function(data){
    //              //       $("#alumnos").html(data);
    //              );                        
    //            });
    //        })
    //   });

    // $(document).ready(function(){
    //     $("#materia").change(function () {
    //         $("#materia option:selected").each(function () {
    //             mat_id = $(this).val();
    //             $.post("conexion.php", { mat_id: mat_id }, //function(data){
    //                // $("#alumnos").html(data);
    //         );                        
    //         });
    //     })
    // });
</script>

    <title>inscripcion</title>
</head>
<body id="fondo">

        <div>
            <h1>Inscripcion</h1>
        </div>
        <div class="col-sm-12">
            <?php if(isset($_SESSION['mensaje'])){ ?>
            <div class="alert alert-<?= $_SESSION['tipo_mensaje']; ?> alert-dismissible fade show" role="alert">
                <?= $_SESSION['mensaje']; ?>
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close" style="margin-top: 20px;padding: unset;"></button>
            </div>
            <?php }
                //session_unset(); ?>
        </div>
            <form id="combo" name="combo" action="" method="post">
                <div>
                    <label for="carrera">Carrera:  </label>
                    <select name="carrera" id="carrera">
                        <option selected disabled value="0">Seleccione una Carrera...</option>
                        <?php 
                            $query=carrera();
                            while($row=mysqli_fetch_assoc($query)){ ?>
                        <option value="<?php echo $row['car_id'];?>"><?php echo $row['car_desc'];?></option>
                        <?php } ?>
                    </select>
                </div>
                <div>
                    <button type="submit" name="btnBuscar">Buscar</button>
                </div>
            <!-- </form>
            <form action="" method="post"> -->
            <?php
            if (isset($_POST['btnBuscar'])){
                $bcr=materias();                                
            ?>
            <div>
                <label for="alumnos">Alumno: </label>
                <select name="idalumnos" id="alumnos">
                    <option value="0" selected disabled>seleccione un alumno...</option>
                    <?php
                    $query = alumnos();
                    while($row = mysqli_fetch_assoc($query)){
                        ?><option value="<?php $row['alu_id']; ?>"><?php echo $row['alu_ape'].' ' .$row['alu_nom'];?></option>
                    <?php
                    };
                    ?>
                </select>
                
                
                </div>
            <div class="col-12 col-sm-8">
                    <div class="table">
                        <table class="table shadow" >
                            <thead class="table-dark table-striped">
                                <tr>
                                    <th>ID</th>
                                    <th>Nombre</th>
                                     <th>
                                        
                                     </th>
                                    <!--<th>DNI</th>
                                    <th>Direccion</th>
                                    <th>Fecha de nacimiento</th>
                                    <th>Telefono</th>-->
                                    <th>Acciones</th> 
                                </tr>
                            </thead>
                            <tbody>
                                <?php
                                    while($registro=mysqli_fetch_array($bcr)){ //muestra las filas relacionadas con la posicion
                                ?>
                                        <tr>
                                            <input type="text" value="<?php echo $registro[0]?>" name="idmateria" style="display: none;">
                                            <td><?php echo $registro[0]?></td>
                                            <td><?php echo $registro[1]?></td>
                                            <td></td>
                                            <td><button type="submit" name="inscribir">inscribir</button></td>
                                        </tr>
                                <?php
                                    }
                                ?>
                            </tbody>
                        </table>
                    </div>
            </div>
            <?php }?> 
        </form>
        <?php
            if (isset($_POST['inscribir'])){
                $alu_id = $_POST['idalumnos'];
                echo $alu_id;
                $mat_id = $_POST['idmateria'];
                echo $mat_id;
                // $sql="INSERT INTO aluxmat VALUE (null, $alu_id, $mat_id);";
                // $query=mysqli_query($c, $sql);
                // // Obtener el último valor generado
                // $ultimoID = mysqli_insert_id($c);
                // if(mysqli_affected_rows($sql)){
                //     $sqlNotas="INSERT INTO notas VALUE(null, null, null, $ultimoID)";
                //     $queryNotas=mysqli_query($c, $sqlNotas);
                // }
                // if(mysqli_affected_rows($sql)){
                //         $_SESSION['mensaje'] = 'Agregado correctamente';
                //         $_SESSION['tipo_mensaje'] = 'success';
                //         // Header("location: inscripcion.php");
                //  }else{
                //         $_SESSION['mensaje'] = 'No se pudo cargar';
                //         $_SESSION['tipo_mensaje'] = 'warning';
                //         // Header("location: inscripcion.php");
                //      }
            }
        ?>
<?php include "footer.php" ?>