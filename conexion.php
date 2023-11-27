<?php
session_start();
function conectar(){
    $serv="localhost";
    $usr="root";
    $pss="";
    $bd="final";

    $c=mysqli_connect($serv, $usr, $pss, $bd);
    return $c;
}

function todoAlumnos(){
    $conn = conectar();
    $sqlMostrar = "SELECT * FROM alumnos;";                    
    $query = mysqli_query ($conn, $sqlMostrar);    
    return $query;
}

function todoProf(){
    $conn = conectar();
    $sqlMostrar = "SELECT * FROM profesores;";                    
    $query = mysqli_query ($conn, $sqlMostrar);    
    return $query;
}

function loggin(){
    $c = conectar();
    $usuario=$_POST['usuario'];
    $pass=$_POST['pass'];

    $sql="SELECT * FROM usuarios WHERE usu_usuario='$usuario'";
    $query=mysqli_query($conn, $sql);
    $registro = mysqli_fetch_assoc($query);

    if (mysqli_affected_rows($c)>0){
        //echo "se encontro el user ";
        session_start();
        $_SESSION['id']=$registro['usu_id'];
        $_SESSION['nombre']=$registro['usu_nombre']. " ". $registro['usu_apellido'];
        $_SESSION['usuario']=$usuario;
        $_SESSION['rol']=$registro['rol'];
    
        switch($_SESSION['rol']){
            case 1:
                //Superadmin
                header("location: superadmin.php?loggin");
                break;
            case 2:
                //Admin
                header("location: admin.php?loggin");
                break;
            case 3:
                //Profesor
                header("location: profesor.php?loggin");
        }
        if($pass==$registro['usu_contra']){
            echo "la contraseña es correcta";
        }
        else{
            header("location: index.php?noPass");
        }
    }
    else{
        header("location: index.php?noUser=$usuario");
    }
}
function buscarAlum(){
    $mat_id = $_POST['materia'];
    $alu_id = $_POST['alumnos'];
    $c = conectar();
    $sql="SELECT notas.mat_id, notas.alu_id, alumnos.alu_nom, alumnos.alu_ape, notas.nota_1, notas.nota_2, notas.nota_final, notas.mat_id
    FROM notas
    INNER JOIN alumnos ON notas.alu_id = alumnos.alu_id
    WHERE mat_id = $mat_id and notas.alu_id = $alu_id";
    $query = mysqli_query($c, $sql);
    return $query;
}

function update(){
    $conn=conectar();
    $matricula=$_POST ['txtMatricula'];
    $nombre=$_POST ['txtNombre'];
    $apellido=$_POST ['txtapellido'];
    $dni=$_POST ['txtdni'];
    $fechaDeNac=$_POST ['txtFecha'];
    $direccion=$_POST ['txtDireccion'];
    $tel=$_POST ['txtTelefono'];

    $sql="UPDATE alumnos SET alu_nom='$nombre', alu_ape='$apellido', alu_dni=$dni, alu_dir='$direccion', alu_fecha='$fechaDeNac', alu_tel=$tel
    WHERE alu_id='$matricula';";

    $query = mysqli_query($conn, $sql);
    return $query;
}

function actualizar(){
    $conn=conectar();
    $id_matricula=$_GET['id'];
    $sql="SELECT * FROM alumnos WHERE alu_id='$id_matricula';";
    $query=mysqli_query($conn, $sql);
    return $query;
}

function materias(){
    $c = conectar();
    $car_id = $_POST['carrera'];
    $sql="SELECT * FROM materias WHERE car_id='$car_id'";
    $query= mysqli_query($c,$sql);
    return $query;
}

function alumnos(){
$c= conectar();
$sql="SELECT * FROM alumnos ORDER BY alu_ape ASC";
$query= mysqli_query($c,$sql);
return $query;
}
function carrera(){
$c = conectar();
$sql = "SELECT car_id, car_desc FROM carreras ORDER BY car_desc ASC";
$query = mysqli_query($c, $sql);
return $query;
}

function guardarNota(){
    $alu_id = $_POST ['alumno'];
    $mat_id = $_POST ['materia'];
    $p1 = $_POST ['nota_1'];
    $p2 = $_POST ['nota_2'];
    $final = $_POST ['nota_final'];
    $c = conectar();
    $sql = "UPDATE notas SET nota_1=$p1, nota_2=$p2, nota_final=$final
            WHERE alu_id = $alu_id and mat_id = $mat_id";
    $query = mysqli_query($c, $sql);
    return $query;
    #$_SESSION['mensaje'] = 'Los datos fueron actualizados';
    #$_SESSION['tipo_mensaje'] = 'warning';
    #Header("location: profesor.php");
    
}
?>
