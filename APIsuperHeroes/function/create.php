<?php 

include '../conexion/conexion.php';


if (empty($_POST['nombre']) || empty($_POST['grupoHeroe']) || empty($_POST['checkTipoPoder']) || empty($_POST['ciudadHeroe']) || empty($_POST['condicion']) || empty($_POST['vehiculo'])) {
	echo json_encode("Por favor llene todo los datos");
} else {
	$nombre = $_POST['nombre'];
	$grupoHeroe = $_POST['grupoHeroe'];
	$ciudadHeroe = $_POST['ciudadHeroe'];
	$condicion = $_POST['condicion'];
	$vehiculo = $_POST['vehiculo'];
	$imagenNombre = $_FILES['imagen']['name'];
	if (empty($imagenNombre)) {
		echo json_encode("Seleciona una imagen");
	} else {
		// $carpeta = $_SERVER['DOCUMENT_ROOT']."../image/";
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
				echo json_encode("Se añadio un nuevo super");
			} else {
				echo json_encode("Error al cargar los datos de super");
			}
		}
	}


	// echo json_encode($checkTipoPoder);
	// if ($_FILES['imagen']) {
	// 	$carpeta = "image/";
	// 	$imagen = $_FILES['imagen']['name'];
	// 	//move_uploaded_file($_FILES['imagen']['tmp_name'], $carpeta.$imagen);
	// 	$consulta = mysqli_query($conexion, "INSERT INTO super(nomSuper, idGrupoHeroe, idCiudadHeroe, idCondicion, idVehiculo, img) VALUES ('$nombre','$grupoHeroe','$ciudadHeroe','$condicion','$vehiculo','$imagen')");
	// 	echo json_encode("Con imagen");
	// } else {
	// 	$consulta = mysqli_query($conexion, "INSERT INTO super(nomSuper, idGrupoHeroe, idCiudadHeroe, idCondicion, idVehiculo, img) VALUES ('$nombre','$grupoHeroe','$ciudadHeroe','$condicion','$vehiculo','null.jpg')");
	// 	echo json_encode("Sin imagen");		
	// }

	// if ($consulta) {
	// 	$consID = mysqli_query($conexion, "SELECT max(idSuper) as ID from super");
	// 	$fetchID = mysqli_fetch_array($consID);
	// 	foreach ($checkTipoPoder as $tipoPoder) {
	// 		$poderes = mysqli_query($conexion, "INSERT into poderes (idSuper, idTipoPoder) VALUES ('".$fetchID['ID']."', '$tipoPoder')");
	// 	}
	// 	echo json_encode("Se añadio un nuevo super");
	// } else {
	// 	echo json_encode("Error al ingresar al super");
	// }
}

?>