<?php
include "header.php"?>
<body id="fondo">
    <div style="margin: auto;">
        <?php
            $paraBorrar=$_GET['id'];
            echo "Usted va a borrar el ID Alumno: $paraBorrar";
            echo "<br>Esta seguro que desea continuar<br>";
        ?>

        <form method=get>
            <a href="eliminar.php?id=<?php echo $paraBorrar?>" title="Eliminar" class="btn btn-primary">Si</a>
            <a href="agregarAlumno.php" class="btn btn-primary">No</a>
        </form>
    </div>
<?php include "footer.php" ?>