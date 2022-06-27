<?php include 'conexion/conexion.php'; ?>

<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<title>Document</title>
	<link rel="stylesheet" href="style/css/bootstrap-5.1.3-dist/css/bootstrap.css">
	<link rel="stylesheet" href="style/css/style.css">
</head>
<body>
	<div class="container py-5">
		<!-- no tengo ni la menor idea de como hacer el buscador :/ -->
		<input class="form-control" type="text" id="buscador">

		<div class="row" id="diosito">
			<?php 
			$query = "SELECT * from super";
			$sqlQuery = mysqli_query($conexion, $query);

			foreach ($sqlQuery as $datosSuper) {
				$consGrupoHeroe = "SELECT * from grupoHeroe where idGrupoHeroe = ".$datosSuper['idGrupoHeroe'];
				$queryGrupoHeroe = mysqli_query($conexion, $consGrupoHeroe);
				$fetchGrupoHeroe = mysqli_fetch_array($queryGrupoHeroe);
				?>
				<div class="col-12 col-md-3 col-sm-6 py-3">
					<div class="card rounded <?php echo $fetchGrupoHeroe['grupoHeroe'] ?>" style="width: 18rem;">
						<img src="image/<?php echo $datosSuper['img'] ?>" class="card-img-top" alt="<?php echo $datosSuper['nomSuper']?>">
						<div class="card-body">
							<p class="card-title"><?php echo $datosSuper['nomSuper'] ?></p>
							<!--a class="btn btn-primary" href="function/info.php?id=<?php echo $datosSuper['idSuper'] ?>">Ver descripcion</a-->
							<button type="button" id="<?php echo $datosSuper['idSuper'] ?>" class="btn btn-success" data-bs-toggle="modal" data-bs-target="#Rmodal" onclick="obtenerIdSuper(<?php echo $datosSuper['idSuper'] ?>)">Ver descripción</button>
						</div>
					</div>
				</div>
			<?php } ?>
		</div>
		<div class="px-2 py-2 fixed-bottom">
			<button type="button" class="btn" data-bs-toggle="modal" data-bs-target="#Cmodal"><?xml version="1.0" standalone="no"?><!DOCTYPE svg PUBLIC "-//W3C//DTD SVG 20010904//EN" "http://www.w3.org/TR/2001/REC-SVG-20010904/DTD/svg10.dtd"><svg version="1.0" xmlns="http://www.w3.org/2000/svg" width="50px" height="50px" viewBox="0 0 512.000000 512.000000" preserveAspectRatio="xMidYMid meet"><g transform="translate(0.000000,512.000000) scale(0.100000,-0.100000)" fill="#000000" stroke="none"><path d="M2325 5109 c-592 -61 -1119 -304 -1539 -709 -423 -409 -682 -925 -762 -1520 -20 -150 -22 -459 -5 -605 56 -457 226 -884 493 -1240 70 -92 371 -401 470 -481 237 -191 564 -360 869 -449 241 -70 446 -98 714 -98 400 1 768 85 1120 258 999 489 1569 1572 1406 2670 -104 699 -494 1326 -1075 1729 -321 223 -687 368 -1079 427 -153 23 -473 33 -612 18z m351 -1153 c57 -27 115 -81 138 -131 31 -65 36 -140 36 -556 l0 -419 419 0 c416 0 491 -5 556 -36 50 -23 104 -81 131 -138 62 -133 0 -308 -131 -370 -65 -31 -140 -36 -556 -36 l-418 0 -3 -457 c-3 -444 -4 -459 -24 -504 -27 -57 -86 -118 -139 -144 -51 -24 -152 -31 -212 -15 -68 19 -136 78 -169 147 l-29 58 -3 457 -3 457 -458 3 -457 3 -59 30 c-100 51 -155 142 -155 257 0 112 58 206 158 255 l57 28 458 3 457 3 0 427 c0 467 4 510 57 582 36 48 59 67 118 96 69 33 160 33 231 0z"/></g></svg></button>
		</div>
		<div class="modal fade" id="Cmodal" tabindex="-1" aria-labelledby="modalLabel" aria-hidden="false">
			<div class="modal-dialog modal-xl">
				<div class="modal-content">
					<div class="modal-header">
						<h5 class="modal-title" id="modalLabel">Nuevo super</h5>
						<button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
					</div>
					<div class="modal-body">
						<form id="form" class="row" >
							<!-- nombre del super -->

							<!-- bien -->
							<div class="mb-3 col-12">
			      				<label for="nombre" class="form-label"><h6>Nombre del super</h6></label>
			      				<input type="text" class="form-control" name="nombre">
			      			</div>
			      			<!-- clase a la que pertence ya sea hereo, villano o antiheroe -->

			      			<!-- bien -->
			      			<div class="mb-3 col-12">
			      				<label for="grupoHeroe" class="form-label"><h6>Tipo de super</h6></label>
			      				<select class="form-select" name="grupoHeroe">
			      					<option selected disabled>Categoria a la que pertenece</option>
			      					<?php 
			      					$consGh = "SELECT * from grupoHeroe";
			      					$queryGh = mysqli_query($conexion, $consGh);

			      					foreach ($queryGh as $grupoHeroe) { ?>
			      						<option value="<?php echo $grupoHeroe['idGrupoHeroe'] ?>"><?php echo $grupoHeroe['grupoHeroe'] ?></option>
			      					<?php } ?>
								</select>
			      			</div>
			      			<!-- tipo o tipos de poderes que pueden tener -->
			      			<div class="mb-3 col-12 row">
			      				<label for="" class="form-label"><h6>Tipo de poder</h6></label>
			      				<?php 
			      				$consTp = "SELECT * from tipoPoder";
			      				$queryTp = mysqli_query($conexion, $consTp);

			      				foreach ($queryTp as $tipoPoder) { ?>
			      					<div class="form-check col-6">
			      						<label class="form-label" for="checkTipoPoder"><?php echo $tipoPoder['tipoPoder'] ?></label>
			      						<input class="form-check-input" type="checkbox" value="<?php echo $tipoPoder['idTipoPoder'] ?>" name="checkTipoPoder[]" id="checkTP<?php echo $tipoPoder['idTipoPoder'] ?>">
			      					</div>
			      				<?php } ?>
			      			</div>
			      			<!-- ciudad de operacion -->
			      			<div class="mb-3 col-6">
			      				<label for="ciudadHeroe" class="form-label"><h6>ciudad del super</h6></label>
			      				<select class="form-select" name="ciudadHeroe">
			      					<option selected disabled>Seleccione la ciudad</option>
			      					<?php 
			      					$consCh = "SELECT * from ciudadHeroe";
			      					$queryCh = mysqli_query($conexion, $consCh);
			      					foreach ($queryCh as $ciudadHeroe) { ?>
			      						<option value="<?php echo $ciudadHeroe['idCiudadHeroe'] ?>"><?php echo $ciudadHeroe['ciudadHeroe'] ?></option>
			      					<?php } ?>
								</select>
							</div>
							<!-- estado en el que se encuentra, supongo solo aplica para villanos -->
							<div class="mb-3 col-6">
			      				<label for="condicion" class="form-label"><h6>Estado</h6></label>
			      				<select class="form-select" name="condicion">
			      					<option selected disabled>Seleccione el estado</option>
			      					<?php 
			      					$consC = "SELECT * from condicion";
			      					$queryC = mysqli_query($conexion, $consC);
			      					foreach ($queryC as $condicion) { ?>
			      						<option value="<?php echo $condicion['idCondicion'] ?>"><?php echo $condicion['tipoCondicion'] ?></option>
			      					<?php } ?>
								</select>
							</div>
							<!-- vehiculo -->
							<div class="mb-3 col-12">
								<label for="vehiculo" class="form-label"><h6>Vehiculo</h6></label>
								<select class="form-select" name="vehiculo">
									<option selected disabled>Vehiculo del super</option>
									<?php 
									$consV = "SELECT * from vehiculo";
									$queryV = mysqli_query($conexion, $consV);

									foreach ($queryV as $vehiculo) { ?>
										<option value="<?php echo $vehiculo['idVehiculo'] ?>"><?php echo $vehiculo['vehiculo'] ?></option>
									<?php } ?>
								</select>
							</div>
							<div class="mb-3 col-12">
								<label for="imagen" class="form-label"><h6>Foto</h6></label>
								<input type="file" name="imagen" accept="image/jpg, image/png, image/jpeg">
							</div>
							<div class="modal-footer">
								<button type="button" class="btn btn-secondary" data-bs-dismiss="modal" onclick="location.reload()">Cancelar</button>
								<button type="submit" class="btn btn-success" value="UPLOAD">Agregar</button>
							</div>
						</form>
					</div>
					<div id="respuesta"></div>
				</div>
			</div>
		</div>
		<!---->
		<div class="modal fade" id="Rmodal" tabindex="-1" aria-labelledby="modalLabel" aria-hidden="false">
			<div class="modal-dialog modal-xl">
				<div class="modal-content">
					<div class="modal-header">
						<h5 class="modal-title" id="modalLabel">Nuevo super</h5>
						<button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
					</div>
					<div class="modal-body">
						<form id="formActualizar" class="row" >
							<div class="mb-3 col-12">
			      				<label for="nombre" class="form-label"><h6>Nombre del super</h6></label>
			      				<input type="text" class="form-control" name="nombre">
			      			</div>
			      			<div class="mb-3 col-12">
			      				<label for="grupoHeroe" class="form-label"><h6>Tipo de super</h6></label>
			      				<select class="form-select" name="grupoHeroe">
								</select>
			      			</div>
			      			<div class="mb-3 col-12 row">
			      				<label for="" class="form-label"><h6>Tipo de poder</h6></label>
			      			</div>
			      			<!-- ciudad de operacion -->
			      			<div class="mb-3 col-6">
			      				<label for="ciudadHeroe" class="form-label"><h6>ciudad del super</h6></label>
			      				<select class="form-select" name="ciudadHeroe">
								</select>
							</div>
							<div class="mb-3 col-6">
			      				<label for="condicion" class="form-label"><h6>Estado</h6></label>
			      				<select class="form-select" name="condicion">
								</select>
							</div>
							<div class="mb-3 col-12">
								<label for="vehiculo" class="form-label"><h6>Vehiculo</h6></label>
								<select class="form-select" name="vehiculo">
								</select>
							</div>
							<div class="mb-3 col-12">
								<label for="imagen" class="form-label"><h6>Foto</h6></label>
								<input type="file" name="imagen" accept="image/jpg, image/png, image/jpeg">
							</div>
							<div class="modal-footer">
								<button type="button" class="btn btn-secondary" data-bs-dismiss="modal" onclick="location.reload()">Cancelar</button>
								<button type="submit" class="btn btn-success" value="UPLOAD">Actualizar</button>
							</div>
						</form>
					</div>
					<div id="respuesta"></div>
				</div>
			</div>
		</div>
		<!---->
	</div>
	<script src="style/js/index.js"></script>
	<script>
		function obtenerIdSuper(idSuper) {
			let NidSuper;
			NidSuper = idSuper;
			console.log(NidSuper)
		}
	</script>
	<script src="style/css/bootstrap-5.1.3-dist/js/bootstrap.js"></script>
	<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.0/jquery.min.js" integrity="sha512-894YE6QWD5I59HgZOGReFYm4dnWc1Qt5NtvYSaNcOP+u1T9qYdvdihz0PPSiiqn/+/3e7Jo4EaG7TubfWGUrMQ==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
</body>
</html>