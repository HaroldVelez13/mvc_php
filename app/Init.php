<?php 
//Llamamos las clases que estamos usando
require_once 'config/Config.php';
require_once 'helpers/Url_Helpers.php';

//AutoLoad php para las clases, para no llamarlas una por una, si no todas de una forma dinamica
spl_autoload_register(function($className){
	require_once 'lib/'.$className.'.php';
});
?>