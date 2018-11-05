<?php  
//para redireccionar paginas
function redirect($page){	
	header('location: '.ROUTE_URL.$page);
}

?>
