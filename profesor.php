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
<script>
$(document).ready(function() {
  $(".cargar-nota").click(function() {
    var row = $(this).closest("tr");
    var aluxmat_id = row.data("aluxmat-id");
    var parcial1 = row.find(".parcial1").val();
    var parcial2 = row.find(".parcial2").val();
    var final = row.find(".final").val();

    console.log("aluxmat_id:", aluxmat_id);
    console.log("parcial1:", parcial1);
    console.log("parcial2:", parcial2);
    console.log("final:", final);

    $.ajax({
      method: "POST",
      url: "actualizar_notas.php",
      data: {
        aluxmat_id: aluxmat_id,
        parcial1: parcial1,
        parcial2: parcial2,
        final: final
      },
      success: function(response) {
        // Manejar la respuesta, por ejemplo, mostrar un mensaje de éxito
        alert("Notas actualizadas correctamente");
      },
      error: function() {
        alert("Error al actualizar las notas");
      }
    });
  });
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
                <div>
                    <button type="submit" name="btnBuscar">Buscar</button>
                </div>
            </form>
            <?php
            
                if (isset($_POST['btnBuscar'])){
                    $busalum = buscarAlum();
                    if (mysqli_num_rows($busalum) > 0){
            ?>
        <form action="actualizar_notas.php" method="post">
            <div style="padding: 10px;">
                <input type="text" id="myInput" onkeyup="searchTable()" placeholder="Buscar..." style=" width: 300px">
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
                                        <tr data-aluxmat-id="<?php echo $registro['nota_id']?>">
                                            <td><input type=radio name="alumno1" value="<?php echo $registro['nota_id']?>" required></td>
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
                                    <?php
                                        }
                                    ?>
                            </tbody>
                        </table>
                    </div>
        </form>
                    <?php
                            }else{echo "No hay alumnos cargados para esta materia";}
                        }
                    ?>

</main>
<?php include "footer.php" ?>