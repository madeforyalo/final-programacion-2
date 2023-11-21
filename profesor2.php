<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Profesor</title>
</head>
<body>
    <div>
        <h1>Cargar notas</h1>
    </div>
    <form action="">
        <div>
            <option value="carrera">
                <option value="0">Seleccione una carrera</option>
            </option>
        </div>
        <div>
            <option value="materia">
                <option value="0">Seleccione una materia</option>
            </option>
        </div>
        <div>
            <option value="alumno">
                <option value="0">Seleccione un alumno</option>
            </option>
        </div>
        <div>
            <button name="buscar">Buscar</button>
        </div>
        <?php 
            if (isset($_POST['buscar'])){
                $buscarNota = buscarAlum();

                while()
            }

        ?>
    </form>
</body>
</html>