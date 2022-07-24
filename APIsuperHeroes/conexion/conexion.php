<?php 

$conexion = @mysqli_connect("localhost", "root", "", "APIsuperHeroes");

function funcionMaster ($valorFiltrar, $campoFiltrar, $dato, $tabla) {
	$conexion = mysqli_connect("localhost", "root", "", "APIsuperHeroes");
	$consSelectMaster = mysqli_query($conexion, "SELECT $dato from $tabla where $campoFiltrar = $valorFiltrar");
	if ($consSelectMaster) {
		$fetcSelectMaster = mysqli_fetch_array($consSelectMaster);
		$newDato = $fetcSelectMaster["$dato"];
		return ($newDato);
	} else {
		return ('Error');
	}
}