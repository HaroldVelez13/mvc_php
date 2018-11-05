<?php 
//Llamamos las clases que estamos usando
require_once 'config/Config.php';

require_once 'helpers/Url_Helpers.php';

// require_once 'lib/DB_base.php';
// require_once 'lib/Controller.php';
// require_once 'lib/Core.php';

//AutoLoad php para las clases, para no llamarlas una por una, si no todas de una forma dinamica
spl_autoload_register(function($className){
	require_once 'lib/'.$className.'.php';
});
?>