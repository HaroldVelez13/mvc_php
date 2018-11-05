<?php require  ROUTE_APP.'/views/layouts/header.php'?>

<a class="btn btn-light"href="<?php echo ROUTE_URL; ?>/users"> <i class="fa fa-backward"></i> Volver</a>

<div class="card card-body bg-light mt-5">
	<h2>Eliminar Usuario</h2>
	<form action="<?php echo ROUTE_URL; ?>/users/delete/<?php echo $datos['id_user'] ?>" method="POST">

		<div class="form-group">
			<label for="name">Nombre: <sup>*</sup></label>
			<input class="form-control"type="text" name="name" value="<?php echo  $datos['name']?>">
		</div>

		<div class="form-group">
			<label for="email">Correo: </label>
			<input class="form-control"type="email" name="email" value="<?php echo  $datos['email']?>">
		</div>

		<div class="form-group">
			<label for="phone">Telefono: </label>
			<input class="form-control" type="text" name="phone" value="<?php echo  $datos['phone']?>">
		</div> 

		<button class="btn btn-success" type="submit">Eliminar</button>
		
	</form>
	
</div>

<?php require  ROUTE_APP.'/views/layouts/footer.php'?>