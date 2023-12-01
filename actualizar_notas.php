<?php
session_start();
if (isset($_POST['notaId'])) {
    $notaID = $_POST['notaId'];
    $alu_id = $_POST ['idAlumno'];
    $mat_id = $_POST ['idMat'];
    $p1 = $_POST ['parcial1'];
    $p2 = $_POST ['parcial2'];
    $final = $_POST ['final'];
    if ($p1 == NULL){
        $p1 = "NULL";
    } 

    if ($p2 == NULL){
        $p2 = "NULL";
    } 

    if ($final == NULL){
        $final = "NULL";
    } 

    echo"$notaID, $alu_id, $mat_id, $p1, $p2, $final";
    // Conectarte a la base de datos
    require "conexion.php";
    $c = conectar();
    // Actualizar las notas en la base de datos
    $updateQuery = "UPDATE notas SET nota_1=$p1, nota_2=$p2, nota_final=$final
                    WHERE alu_id = $alu_id AND mat_id = $mat_id";
    $result = mysqli_query($c, $updateQuery);
    if ($result) {
        $_SESSION['mensaje'] = 'Los datos fueron actualizados';
        $_SESSION['tipo_mensaje'] = 'success';
        Header("location: profesor.php");
    } else {
        $_SESSION['mensaje'] = 'Error al actualizar las notas';
        $_SESSION['tipo_mensaje'] = 'warning';
        Header("location: profesor.php");
    }
}
?>
