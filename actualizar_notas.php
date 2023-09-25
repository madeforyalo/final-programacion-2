<?php
if (isset($_POST['aluxmat_id'])) {
    $aluxmat_id = $_POST['aluxmat_id'];
    $parcial1 = $_POST['parcial1'];
    $parcial2 = $_POST['parcial2'];
    $final = $_POST['final'];

    // Conectarte a la base de datos
    require "conexion.php";
    $c = conectar();

    // Actualizar las notas en la base de datos
    $updateQuery = "UPDATE notas SET nota_1=$parcial1, nota_2=$parcial2, nota_final=$final WHERE aluxmat_id=$aluxmat_id";
    $result = mysqli_query($c, $updateQuery);

    if ($result) {
        echo "Notas actualizadas exitosamente";
    } else {
        echo "Error al actualizar las notas";
    }
}
?>
