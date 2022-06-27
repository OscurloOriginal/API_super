<?php 

include '../conexion/conexion.php';

$idSuper = $_POST['id'];
$nomSuper = $_POST['nombre'];

if (isset($_POST['ciudadHeroe'])) {
	$ciudadHeroe = $_POST['ciudadHeroe'];
	$consActualizar = "UPDATE super SET nomSuper = '$nomSuper', idCiudadHeroe = $ciudadHeroe WHERE idSuper = $idSuper";
	$queryActualizar = mysqli_query($conexion, $consActualizar);

	if ($queryActualizar) {
		echo json_encode('Se actualizaron los datos');
	} else {
		echo json_encode('Error al actualizar los datos');
	}
} else {
	$consActualizar = "UPDATE super SET nomSuper = '$nomSuper' WHERE idSuper = $idSuper";
	$queryActualizar = mysqli_query($conexion, $consActualizar);

	if ($queryActualizar) {
		echo json_encode('Se actualizaron los datos');
	} else {
		echo json_encode('Error al actualizar los datos');
	}
}
