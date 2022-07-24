<?php 

include '../conexion/conexion.php';


if (empty($_POST['nombre']) || empty($_POST['grupoHeroe']) || empty($_POST['checkTipoPoder']) || empty($_POST['ciudadHeroe']) || empty($_POST['condicion']) || empty($_POST['vehiculo'])) {
	echo json_encode("1");
} else {
	$nombre = $_POST['nombre'];
	$grupoHeroe = $_POST['grupoHeroe'];
	$ciudadHeroe = $_POST['ciudadHeroe'];
	$condicion = $_POST['condicion'];
	$vehiculo = $_POST['vehiculo'];
	$imagenNombre = $_FILES['imagen']['name'];
	if (empty($imagenNombre)) {
		echo json_encode("2");
	} else {
		$carpeta = "../image/";
		move_uploaded_file($_FILES['imagen']['tmp_name'], $carpeta.$imagenNombre);
		$newSuper = mysqli_query($conexion, "INSERT into super (nomSuper, idGrupoHeroe, idCiudadHeroe, idCondicion, idVehiculo, img) values ('$nombre', '$grupoHeroe', '$ciudadHeroe', '$condicion', '$vehiculo', '$imagenNombre')");
		if ($newSuper) {
			$ultSuper = mysqli_query($conexion, "SELECT max(idSuper) as ID FROM super");
			$IDSuper = mysqli_fetch_array($ultSuper);
			$ID = $IDSuper['ID'];
			foreach ($_POST['checkTipoPoder'] as $tipoPoder) {
				$tp = mysqli_query($conexion, "INSERT into poderes values ('$ID', '$tipoPoder')");
			}
			if ($tp) {
				echo json_encode("0");
			} else {
				echo json_encode("3");
			}
		}
	}
}

?>