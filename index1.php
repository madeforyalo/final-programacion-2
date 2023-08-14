<!DOCTYPE html>
<html>
<head>
	<title>Tabla con Buscador</title>
	<style>
		table {
			border-collapse: collapse;
			width: 100%;
			font-family: Arial, sans-serif;
			font-size: 14px;
			text-align: left;
		}
		th, td {
			padding: 8px;
			border: 1px solid #ddd;
		}
		input[type=text] {
			padding: 5px;
			border: 1px solid #ddd;
			margin-bottom: 10px;
			width: 100%;
			box-sizing: border-box;
		}
	</style>
</head>
<body>
<form>
  <label for="carrera">Seleccione la carrera:</label>
  <select id="carrera" name="carrera">
    <option value="ingenieria">Ingeniería</option>
    <option value="medicina">Medicina</option>
    <option value="derecho">Derecho</option>
  </select>
  <br>
  <br>
  <table>
    <thead>
      <tr>
        <th>Materia</th>
        <th>Seleccionar</th>
      </tr>
    </thead>
    <tbody id="tabla-materias">
    </tbody>
  </table>
  <br>
  <input type="button" value="Enviar" onclick="enviarFormulario()">
</form>



<script>
  function seleccionarCarrera() {
    // Obtener el valor seleccionado en el elemento "select"
    var carrera = document.getElementById("carrera").value;
    
    // Consultar la base de datos o el archivo de texto para obtener las materias de la carrera seleccionada
	<?php
require "conexion.php";        

$c = conectar();
$sql = "SELECT mat_id, mat_nom FROM materias WHERE car_id = '$carrera'";
$query = mysqli_query($c, $sql);

include "header.php";
?>
    var materias = array();
	while ($fila = $query->fetch_assoc()) {
    $materias[] = $fila['mat_nom'];}
    
    // Mostrar las materias en una tabla
    var materias = []; // ejemplo de materias obtenidas
    var tablaMaterias = document.getElementById("tabla-materias");
    tablaMaterias.innerHTML = ""; // Limpiar la tabla
    
    for (var i = 0; i < materias.length; i++) {
      var materia = materias[i];
      var filaMateria = document.createElement("tr");
      var celdaNombreMateria = document.createElement("td");
      var celdaSeleccionMateria = document.createElement("td");
      var checkboxMateria = document.createElement("input");
      checkboxMateria.type = "checkbox";
      checkboxMateria.name = "materias[]"; // Usar un array para enviar los valores seleccionados
      checkboxMateria.value = materia;
      celdaNombreMateria.textContent = materia;
      celdaSeleccionMateria.appendChild(checkboxMateria);
      filaMateria.appendChild(celdaNombreMateria);
      filaMateria.appendChild(celdaSeleccionMateria);
      tablaMaterias.appendChild(filaMateria);
    }
  }

  function enviarFormulario() {
    // Obtener los valores seleccionados
    var checkboxesMaterias = document.getElementsByName("materias[]");
    var materiasSeleccionadas = [];
    
    for (var i = 0; i < checkboxesMaterias.length; i++) {
      var checkboxMateria = checkboxesMaterias[i];
      
      if (checkboxMateria.checked) {
        materiasSeleccionadas.push(checkboxMateria.value);
      }
    }
    
    // Enviar los valores seleccionados al servidor
    // ...
  }

  // Asignar la función "seleccionarCarrera" al evento "onchange" del elemento "select"
  document.getElementById("carrera").onchange = seleccionarCarrera;
</script>



<ul id="materias"></ul>

</body>
</html>
