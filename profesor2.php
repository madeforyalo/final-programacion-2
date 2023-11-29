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

<title>Carga de notas</title>
</head>

<body>
    <div>
        <h1>Cargar notas</h1>
    </div>

    <form action="" method="POST">
        <div>
            <label for="carrera">Carrera: </label>
            <select name="carrera" id="carrera" class="form-control" style=" width: 300px">
                <option selected disabled value="0">Seleccione una Carrera...</option>
                <?php while ($row = mysqli_fetch_assoc($query)) { ?>
                    <option value="<?php echo $row['car_id']; ?>"><?php echo $row['car_desc']; ?></option>

    <form action="" method="post">
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

            <select name="materia" id="materia" style=" width: 300px" class="form-control"></select>
        </div>
        <div>
            <label for="alumnos">Alumno: </label>
            <select name="alumnos" id="alumnos" style=" width: 300px" class="form-control"></select>

            <select name="materia" id="materia" style=" width: 300px"></select>
        </div>
        <div>
            <label for="alumnos">Alumno: </label>
            <select name="alumnos" id="alumnos" style=" width: 300px"></select>

        </div>
        <div>
            <button name="buscar">Buscar</button>
        </div>

    </form>
        <?php
        if (isset($_POST['buscar'])) {
            $buscarNota = buscarAlum();
            if (mysqli_num_rows($buscarNota) > 0) {
                while ($registro = mysqli_fetch_assoc($buscarNota)) { ?>

                    <input type="text" name="alumno" id="" plaseholder="<?php echo $registro['alu_nom'] . " " . $registro['alu_ape'] ?> " disabled>

                    <select name="nota_1" id="" style=" width: 300px" class="form-control">
                        <option value="0" disabled><?php echo $registro['nota_1'] ?></option>
                        <option value="1">1</option>
                        <option value="2">2</option>
                        <option value="3">3</option>
                        <option value="4">4</option>
                        <option value="5">5</option>
                        <option value="6">6</option>
                        <option value="7">7</option>
                        <option value="8">8</option>
                        <option value="9">9</option>
                        <option value="10">10</option>
                    </select>

                    <select name="nota_2" id="" style=" width: 300px" class="form-control">
                        <option value="0" disabled><?php echo $registro['nota_2'] ?></option>
                        <option value="1">1</option>
                        <option value="2">2</option>
                        <option value="3">3</option>
                        <option value="4">4</option>
                        <option value="5">5</option>
                        <option value="6">6</option>
                        <option value="7">7</option>
                        <option value="8">8</option>
                        <option value="9">9</option>
                        <option value="10">10</option>
                    </select>

                    <?php
                    $p1 = $registro['nota_1'];
                    $p2 = $registro['nota_2'];
                    $f = ($p1 + $p2) / 2;
                    if ($f < 4) {
                    ?>
                        <input type="number" name="final" class="final" disabled>
                    <?php
                    } else { ?>
                        <select name="final" id="" style=" width: 300px" class="form-control">
                            <option value="0" disabled>Final</option>
                            <option value="1">1</option>
                            <option value="2">2</option>
                            <option value="3">3</option>
                            <option value="4">4</option>
                            <option value="5">5</option>
                            <option value="6">6</option>
                            <option value="7">7</option>
                            <option value="8">8</option>
                            <option value="9">9</option>
                            <option value="10">10</option>
                        </select>
                    <?php } ?>

                    <input type="button" value="cargarNotas">

        <?php
                }
            }
        }
        ?>

    </form>    
        <?php
            
            if (isset($_POST['buscar'])){
                $busalum = buscarAlum();
                if (mysqli_num_rows($busalum) > 0){
        ?>          
            <?php
                while($registro=mysqli_fetch_assoc($busalum)){ //muestra las filas relacionadas con la posicion
            ?>
                    <form action="actualizar_notas.php" method="post">
                        <div>
                            <input type="text" name="materia1" value="<?php echo $registro['mat_id']?>" hidden>
                            <label for="alumno1">Alumno: </label>
                            <input type="text" name="alumno1" id="alumno1" value="<?php echo $registro['alu_id']?>" hidden>
                            <input type="text" name="nombreApellido" id="" value="<?php echo $registro['alu_ape'] . " " . $registro['alu_nom'] ?>" disabled>
                        </div>
                        <div>
                            <label for="nota_1">Ingrese un número del 1 al 10:</label>
                            <input type="text" id="nota_1" name="nota_1" pattern="[1-9]|10" placeholder="<?php echo $registro['nota_1']?>" value="<?php echo $registro['nota_1']?>">
                        </div>
                        <div>
                            <label for="nota_2">Ingrese un número del 1 al 10:</label>
                            <input type="text" id="nota_2" name="nota_2" pattern="[1-9]|10" placeholder="<?php echo $registro['nota_2']?>" value="<?php echo $registro['nota_2']?>">
                        </div>
                        <?php
                            $p1 = $registro['nota_1'];
                            $p2 = $registro['nota_2'];
                            $f = ($p1 + $p2)/2;
                            if ($f < 4) {
                            ?>                                            
                            <input type="number" name="final" class="final" value="NULL" hidden>
                            <?php 
                            }else { ?> <input type="number" name="final" class="final" value="<?php echo $registro['nota_final']?>">
                                <?php } ?>
                        <div>
                            <button name="cargarNota">Cargar Nota</button>
                        </div>
                        
                    </form>
        <?php
            
            }
                }else{echo "No se encontraron alumnos para esta materia";}
            }
        ?>

                    


    
</body>

</html>