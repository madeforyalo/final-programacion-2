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

            // $('#alumnos').find('option').remove().end().append('<option value="whatever"></option>').val('whatever');
            
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
                $.post("conexion.php", { mat_id: mat_id }, //function(data){
                   // $("#alumnos").html(data);
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
            <div class="col-12 col-sm-4 pt-1 pb-3">
                <h1>Cargar notas</h1>
            </div>
            <form id="combo" name="combo" action="" method="post">
                <div>
                    <label for="carrera">Carrera:  </label>
                    <select name="carrera" id="carrera">
                        <option selected disabled value="0">Seleccione una Carrera...</option>
                        <?php while($row=mysqli_fetch_assoc($query)){ ?>
                        <option value="<?php echo $row['car_id'];?>"><?php echo $row['car_desc'];?></option>
                        <?php } ?>
                    </select>
                </div>
                <div>
                    <label for="materia">Materia: </label>
                    <select name="materia" id="materia" style=" width: 300px"></select>
                </div>
                <!-- <div>
                    <label for="alumnos">Alumnos: </label>
                    <select name="alumnos" id="alumnos" style=" width: 300px"></select>
                </div> -->
                <div>
                    <button type="submit" name="btnBuscar">Buscar</button>
                </div>
            </form>
            <?php
            
                if (isset($_POST['btnBuscar'])){
                    $busalum = buscarAlum();
                    if (mysqli_num_rows($busalum) > 0){
            ?>
                <input type="text" id="myInput" onkeyup="searchTable()" placeholder="Buscar..." style=" width: 300px">
                <div class="table" style="overflow: auto;">
                        <table class="table shadow" id="myTable" >
                            <thead class="table-dark table-striped">
                                <tr>
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
                                        <tr>
                                            <td><?php echo $registro['alu_nom']?></td>
                                            <td><?php echo $registro['alu_ape']?></td>
                                            <td><input type="number" name="parcial1" id="parcial1" value="<?php echo $registro['nota_1']?>"></td>                                            
                                            <td><input type="number" name="parcial2" id="parcial2" value="<?php echo $registro['nota_2']?>"></td>
                                            <?php  
                                            $p1 = $registro['nota_1'];
                                            $p2 = $registro['nota_2'];
                                            $f = ($p1 + $p2)/2;
                                            if ($f < 4) {
                                            ?>                                            
                                            <td><input type="number" name="final" id=""  disabled></td>
                                            <?php 
                                            }else {?> <td><input type="number" name="final" id="" value="<?php echo $registro['nota_final']?>"></td> <?php } ?>
                                            <td><a href="actualizar.php?id=<?php echo $registro['alu_id'] ?>" title="Guardar" ><i class="fa-solid fa-arrow-up-from-bracket"></i></a></td>
                                        </tr>
                                            <!-- <div>
                                                <a href="actualizar.php?id=<?php  #echo $registro['alu_id']?>">
                                                <button type="submit" name="gnota" formaction = "conexion.php" formmethod="post">Guardar</button>
                                            </div> -->
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