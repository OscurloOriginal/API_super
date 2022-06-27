<?php include '../conexion/conexion.php';
$ID = $_GET['id'];


if (empty($ID)) {
	header('location:../index.php');
}


$consDatos = "SELECT * from super, ciudadHeroe, condicion, vehiculo where idSuper = $ID && ciudadHeroe.idCiudadHeroe = super.idCiudadHeroe && condicion.idCondicion = super.idCondicion && vehiculo.idVehiculo = super.idVehiculo";
$queryDatos = mysqli_query($conexion, $consDatos);
$fetchDatos = mysqli_fetch_array($queryDatos);

?>

<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<link rel="stylesheet" href="../style/css/bootstrap-5.1.3-dist/css/bootstrap.css">
	<link rel="stylesheet" href="../style/css/style.css">
	<title>Document</title>
</head>
<?php 
$consBackground = "SELECT grupoHeroe from grupoHeroe, super where super.idGrupoHeroe = ".$fetchDatos['idGrupoHeroe']." && grupoHeroe.idGrupoHeroe = ".$fetchDatos['idGrupoHeroe'];
$queryBackground = mysqli_query($conexion, $consBackground);
$fetchBackground = mysqli_fetch_array($queryBackground);
 ?>
<body>
	<div>
		<div class="px-5 box row <?php echo $fetchBackground['grupoHeroe'] ?>">
			<div class="col-3"><img src="../image/bird-skull-gcf3e97ba1_1920.jpg" class="img-fluid" alt="..."></div>
			<div class="col-9">
				<h1><?php echo $fetchDatos['nomSuper'] ?></h1>
				<hr style="width: 1000px;">
				<p><b>GRUPO: </b><?php echo $fetchBackground['grupoHeroe'] ?></p>
				<p><b>CIUDAD: </b><?php echo $fetchDatos['ciudadHeroe'] ?></p>
				<p><b>CONDICION: </b><?php echo $fetchDatos['tipoCondicion'] ?></p>
				<p><b>VEHICULO: </b><?php echo $fetchDatos['vehiculo'] ?></p>
				<b>Tipo de poder</b>
				<ul>
					<?php 
					$consPoder = "SELECT * FROM poderes, tipoPoder where idSuper = $ID && poderes.idTipoPoder = tipoPoder.idTipoPoder";
					$queryPoder = mysqli_query($conexion, $consPoder);
					foreach ($queryPoder as $poder) { ?>
						<li><?php echo $poder['tipoPoder'] ?></li>
					<?php } ?>
				</ul>
				<button type="submit" class="btn btn-success" data-bs-toggle="modal" data-bs-target="#exampleModal">
					Actualizar
				</button>
				<div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
					<div class="modal-dialog">
						<div class="modal-content">
							<div class="modal-header">
								<h5 class="modal-title" id="exampleModalLabel">Modal title</h5>
								<button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
							</div>
							<div class="modal-body">
								<form id="formActualizar">
									<div class="pt-3">
										<label class="form-label" for="nombre">Nombre del super</label>
										<input class="form-control" type="text" name="nombre" value="<?php echo $fetchDatos['nomSuper'] ?>">
										<input type="hidden" name="id" value="<?php echo $ID ?>">
									</div>
									<div class="pt-3">
										<label class="form-label" for="nombre">Lugar de operación</label>
										<select class="form-select" name="ciudadHeroe">
											<option selected disabled>Ciudad actual: <?php echo $fetchDatos['ciudadHeroe'] ?></option>
											<?php
											$consCiudad = "SELECT * from ciudadHeroe";
											$queryCiudad = mysqli_query($conexion, $consCiudad);
											foreach ($queryCiudad as $ciudad) { ?>
												<option value="<?php echo $ciudad['idCiudadHeroe'] ?>"><?php echo $ciudad['ciudadHeroe'] ?></option>
											<?php } ?>
										</select>
									</div>
									<div class="modal-footer">
										<button type="button" class="btn btn-secondary" data-bs-dismiss="modal" onclick="location.reload()">Cancelar</button>
										<button type="submit" class="btn btn-success">Actualizar</button>
									</div>
								</form>
							</div>
							<div id="respuesta"></div>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>
	<script src="../style/css/bootstrap-5.1.3-dist/js/bootstrap.js"></script>
	<script src="../style/js/info.js"></script>
</body>
</html>