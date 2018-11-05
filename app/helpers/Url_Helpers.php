<?php  
//Funcion para redireccionar paginas a la base, en este caso el index del Usuario
function redirect($page){	
	header('location: '.ROUTE_URL.$page);
}

?>
