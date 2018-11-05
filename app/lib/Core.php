<?php 
/*
Mapeamos la URL del navegador:
0-Controlador
1-Metodo
2-parametro
*/
class Core {
	protected $actualController = 'Users';
	protected $actualMethod     = 'index';
	protected $actualParams      = [];

	public function __construct(){
		$url = $this->getUrl();
		//Buscar en controllers si el Controllers Existe
		if (file_exists('../app/controllers/'.ucwords($url[0]).'.php')) {
			# Si existe se Setea como el controller por defecto
			$this->actualController = ucwords($url[0]);

			//unset ('liberamos') del indice 0
			unset($url[0]);
		}
		//Importamos nuestro controlador
		//Y si existe lo Seteamos
		require_once('../app/controllers/'.$this->actualController.'.php');
		$this->actualController = new $this->actualController;
		//Verificamos la segunda parte de la URL, es decir el Metodo

		if ( isset($url[1]) ) {

			if (method_exists($this->actualController, $url[1])) {

				//Verificamos el metodo
				$this->actualMethod = $url[1];
				//unset ('liberamos') del indice 0
				unset($url[1]);
			}
		}
		//Verificamos si existen los parametros
		$this->actualParams = $url ? array_values($url) : [];
		
		//Llamamos Callback con parametros array
		call_user_func_array([$this->actualController, $this->actualMethod], $this->actualParams);

	}

	public function getUrl(){
		//url es una variable que la pasa el access
		
		if (isset($_GET['url'])) {
			$url = rtrim($_GET['url'], '/');
			$url = filter_var($url, FILTER_SANITIZE_URL);
			$url = explode('/', $url);

			return $url;
		}
	}

}
?>
