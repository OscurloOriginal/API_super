<?php 
include '../conexion/conexion.php';


if (isset($_GET['action'])) {
	$action = $_GET['action'];
} else {
	$action = "Nada";
}



if ($action == 'Delete') {
	$idSuper = $_GET['idSuper'];
	$eliminar = mysqli_query($conexion, "DELETE from super where idSuper = '$idSuper'");
	if ($eliminar) {
		echo "Bien";
	} else {
		echo "Error";
	}
} else if ($action == 'buscar') {
	$consulta = $_GET['consulta'];

	$consDatosSuper = mysqli_query($conexion, "
		SELECT
		A.idSuper,
		A.nomSuper,
		A.idGrupoHeroe,
		A.idCiudadHeroe,
		A.idCondicion,
		A.img,
		A.idVehiculo from super A
		inner join ciudadheroe B on A.idCiudadHeroe = B.idCiudadHeroe
		inner join condicion C on A.idCondicion = C.idCondicion
		inner join grupoheroe D on A.idGrupoHeroe = D.idGrupoHeroe
		inner join vehiculo G on A.idVehiculo = G.idVehiculo
		where A.nomSuper like '%$consulta%' || D.grupoHeroe like '%$consulta%' || B.ciudadHeroe like '%$consulta%' || C.tipoCondicion like '%$consulta%' || G.nomVehiculo like '%$consulta%';");
	$algo = mysqli_num_rows($consDatosSuper);
	$idSuper = "'idSuper'";
	if ($algo > 0) {
		foreach ($consDatosSuper as $datos) {
			echo ('
				<!------------------------------------------------------------------------------------------------------------------------->
				<div class="col-12 col-md-3 col-sm-6 py-3">
					<div class="card rounded '.funcionMaster($datos["idGrupoHeroe"], "idGrupoHeroe", "grupoHeroe", "grupoheroe").'" style="width: 18rem">
						<img src="image/'.$datos['img'].'" class="card-img-top" alt="'.$datos['nomSuper'].'">
						<div class="card-body">
							<p class="card-body">'.$datos['nomSuper'].'</p>
							<button type="button" id="'.$datos['idSuper'].'" class="btn btn-success" data-bs-toggle="modal" data-bs-target="#Rmodal" onclick="ObtenerInfoSuper('.$datos['idSuper'].', '.$idSuper.')">Ver descripción</button>
							<a href="javascript:Delete('.$datos['idSuper'].')" class="btn btn-danger"><i class="fa fa-times">&times;</i></a>
						</div>
					</div>	
				</div>
				<!------------------------------------------------------------------------------------------------------------------------->
				');
		}
	} else {
			echo ('<div class="col-12" style="display:flex;justify-content:center;align-items:center;min-height:60vh"><h3>Sin resultados para mostrar :/</h3></div>');
	}
} else {
	$consDatosSuper = mysqli_query($conexion, "SELECT * from super");
	$algo = mysqli_num_rows($consDatosSuper);
	if ($algo > 0) {
		foreach ($consDatosSuper as $datos) {
			$nombre = $datos['nomSuper'];
			$nombre = "'$nombre'";
			echo ('
				<!------------------------------------------------------------------------------------------------------------------------->
				<div class="col-12 col-md-3 col-sm-6 py-3">
					<div class="card rounded '.funcionMaster($datos["idGrupoHeroe"], "idGrupoHeroe", "grupoHeroe", "grupoheroe").'" style="width: 18rem">
						<img src="image/'.$datos['img'].'" class="card-img-top" alt="'.$datos['nomSuper'].'">
						<div class="card-body">
							<p class="card-body">'.$datos['nomSuper'].'</p>
							<button type="button" id="'.$datos['idSuper'].'" class="btn btn-success" data-bs-toggle="modal" data-bs-target="#Rmodal" onclick="ObtenerInfoSuper('.$datos['idSuper'].')">Ver descripción</button>
							<a href="javascript:Delete('.$datos['idSuper'].', '.$nombre.')" class="btn btn-danger"><i class="fa fa-times">&times;</i></a>
						</div>
					</div>	
				</div>
				<!------------------------------------------------------------------------------------------------------------------------->
				');
		}
		echo "<script>window.load = cargarDatos()</script>";
	} else {
		echo ('<div class="col-12" style="display:flex;justify-content:center;align-items:center;min-height:60vh"><h3>Sin información para mostrar :/</h3></div>');
		echo "<script>window.load = cargarDatos()</script>";
	}
}
?>