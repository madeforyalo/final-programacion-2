<?php
require "conexion.php";
$c = conectar();
$sql = "SELECT car_id, car_desc FROM carreras ORDER BY car_desc ASC";
$query = mysqli_query($c, $sql);

include "header.php";
?>

<script language="javascript">
    $(document).ready(function() {
        $("#carrera").change(function() {

            // $('#alumnos').find('option').remove().end().append('<option value="whatever"></option>').val('whatever');

            $("#carrera option:selected").each(function() {
                car_id = $(this).val();
                $.post("getMaterias.php", {
                    car_id: car_id
                }, function(data) {
                    $("#materia").html(data);
                });
            });
        })
    });

    $(document).ready(function() {
        $("#materia").change(function() {
            $("#materia option:selected").each(function() {
                mat_id = $(this).val();
                $.post("getAlumnos.php", {
                    mat_id: mat_id
                }, function(data) {
                    $("#alumnos").html(data);
                });
            });
        })
    });

    $(document).ready(function() {
        $("#materia").change(function() {
            $("#materia option:selected").each(function() {
                mat_id = $(this).val();
                $.post("conexion.php", {
                        mat_id: mat_id
                    }, //function(data){
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
    
</body>

</html>