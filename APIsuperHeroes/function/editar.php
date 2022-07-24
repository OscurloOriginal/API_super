<?php 
include '../conexion/conexion.php';

if ($_GET['consultar']) {
	$id = $_GET['consultar'];
	$datoSuper = mysqli_query($conexion, "SELECT * from super where idSuper = $id");
	if (mysqli_num_rows($datoSuper) > 0) {
		$super = mysqli_fetch_all($datoSuper,MYSQLI_ASSOC);
		echo json_encode($super);
		// echo json_encode("Bien");
		exit();
	} else {
		echo json_encode("Mal");
	}
}
 ?>