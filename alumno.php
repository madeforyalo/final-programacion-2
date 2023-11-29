<?php
require "conexion.php"; 
if(isset($_SESSION['id']) && $_SESSION['tipoUsuario']==4 || $_SESSION['tipoUsuario']==1){
//todo ok
$usuario = $_SESSION['usuario'];
$nombre = $_SESSION['nombre'];
$apellido = $_SESSION['apellido'];
}
else{
    echo"Pagina Prohibida. Inicie Sesion";
    echo "<br><br><h2><a href=index.php><button class='btn btn-info'>Iniciar sesion</button></a></h2>";
    exit();
}
$c = conectar();
$sql = "SELECT DISTINCT carreras.car_id, carreras.car_desc
        FROM carreras
        JOIN materias ON carreras.car_id = materias.car_id
        JOIN aluxmat ON materias.mat_id = aluxmat.mat_id
        JOIN alumnos ON aluxmat.alu_id = alumnos.alu_id
        WHERE alumnos.usu_usuario = '$usuario'
        ORDER BY mat_nom ASC";
$query = mysqli_query($c, $sql);                 
   
include "header.php";
?>

<title>Notas</title>
</head>

<body>
    
    <h1>Notas</h1>
    <br>
    <h3><?php echo $apellido; ?>, <?php echo $nombre; ?></h3>
    <a href="loggout.php">Cerrar sesión</a>

    <br><br>
    <form action="#" method="post">
        <select name="carrera" id="carrera">
            <option selected disabled value="0">Seleccione una Carrera...</option>
            <?php while($row=mysqli_fetch_assoc($query)){ ?>
                    <option value="<?php echo $row['car_id'];?>"><?php echo $row['car_desc'];?></option>
                    <?php } ?>
        </select>
        <input type="text" name="usuarioAlumno" value="<?php echo $usuario; ?>" hidden>
        <button type="submit" name="btnBuscar">Buscar</button>
    </form>
    <?php
            
            if (isset($_POST['btnBuscar'])){
                $notas = notas();
                if (mysqli_num_rows($notas) > 0){
    ?>
            <div class="table" style="overflow: auto;">
                <table class="table shadow" id="myTable" >
                    <thead class="table-dark table-striped">
                        <tr>
                            <th>Materia</th>
                            <th>Primer parcial</th>
                            <th>Segundo parcial</th>
                            <th>Final</th>
                        </tr>
                        
                    </thead>
                        <tbody>
                            <?php
                                while($registro=mysqli_fetch_assoc($notas)){ //muestra las filas relacionadas con la posicion
                                    
                            ?>
                            <tr>
                                    <td><?php echo $registro['mat_nom']?></td>
                                    <td><?php echo $registro['nota_1']?></td>
                                    <td><?php echo $registro['nota_2']?></td>
                                    <td><?php echo $registro['nota_final']?></td>
                            </tr>
                        </tbody>
    <?php
                                }
                }else{
                    echo "No hay materias cargadas";
                }
            }
        ?>
</body>
</table>
</div>

<?php include "footer.php" ?>