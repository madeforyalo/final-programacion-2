<?php
if (isset($_POST['alumno1'])) {
    
    $alu_id = $_POST ['alumno1'];
    $mat_id = $_POST ['materia1'];
    $p1 = $_POST ['nota_1'];
    $p2 = $_POST ['nota_2'];
    $final = $_POST ['final'];
    if ($final == NULL){
        $final = "NULL";
    }

    echo"$alu_id, $mat_id, $p1, $p2, $final";

    // Conectarte a la base de datos
    require "conexion.php";
    $c = conectar();
    // Actualizar las notas en la base de datos
    $updateQuery = "UPDATE notas SET nota_1=$p1, nota_2=$p2, nota_final=$final
                    WHERE alu_id = $alu_id AND mat_id = $mat_id";
    $result = mysqli_query($c, $updateQuery);
  if ($result) {
        echo "Notas actualizadas exitosamente";
    } else {
        echo "Error al actualizar las notas";
    }
}
?>
