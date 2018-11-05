<?php require  ROUTE_APP.'/views/layouts/header.php'?>

<a class="btn" href="<?php echo ROUTE_URL; ?>/users/create/">Crear</a>
<table class="table">
	<thead>
		<tr>
			<th>Numero</th>
			<th>Nombre</th>
			<th>Email</th>
			<th>Telefono</th>
			<th>Acciones</th>			
		</tr>
	</thead>
		
	<tbody>
		<?php foreach($datos['usuarios'] as $user): ?>
		<tr>
			<td><?php echo $user->id_user; ?></td>
			<td><?php echo $user->name; ?></td>
			<td><?php echo $user->email; ?></td>
			<td><?php echo $user->phone; ?></td>
			<td>
				<a class="btn" href="<?php echo ROUTE_URL; ?>/users/edit/<?php echo $user->id_user; ?>">Editar</a>
				<a class="btn" href="<?php echo ROUTE_URL; ?>/users/delete/<?php echo $user->id_user; ?>">Eliminar</a>
			</td>
		</tr>
		<?php endforeach; ?>
	</tbody>
	
</table>


<?php require  ROUTE_APP.'/views/layouts/footer.php'?>