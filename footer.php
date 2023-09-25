<!-- jQuery first, then Popper.js, then Bootstrap JS -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0-beta1/dist/js/bootstrap.bundle.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/popper.js@1.14.7/dist/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script>
<link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />
<script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>
<script src="css/bootstrap/js/bootstrap.min.js"></script>
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script>
    $("#carrera").select2({
        tags: true
    });
    $("#materia").select2({
        tags: true
    });
    $("#alumnos").select2({
        tags: true
    });
</script>
<script>
		function searchTable() {
			// Obtener el input y la tabla
			var input = document.getElementById("myInput");
			var table = document.getElementById("myTable");

			// Obtener todas las filas de la tabla
			var rows = table.getElementsByTagName("tr");

			// Recorrer todas las filas y ocultar aquellas que no coincidan con el input
			for (var i = 0; i < rows.length; i++) {
				var cells = rows[i].getElementsByTagName("td");
				var display = false;
				for (var j = 0; j < cells.length; j++) {
					// Convertir las cadenas a minúsculas antes de compararlas
					if (cells[j].innerHTML.toLowerCase().indexOf(input.value.toLowerCase()) > -1) {
						display = true;
						break;
					}
				}
				if (display) {
					rows[i].style.display = "";
				} else {
					rows[i].style.display = "none";
				}
			}
		}
	</script>

</body>

</html>