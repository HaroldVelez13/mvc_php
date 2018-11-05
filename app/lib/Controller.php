<?php
//Clase principal 
//Se encarga de cargar los modelos y las vistas 
class Controller{

	//Cargar modelo
	public function model($model){
		//Incluimos el modelo
		require_once '../app/models/'.$model.'.php';
		//iniciamos el modelo
		return new $model();
	}

	//Cargar vista
	public function view($view, $datos = []){
		//Incluimos el modelo
		if (file_exists('../app/views/'.$view.'.php')) {
			require_once '../app/views/'.$view.'.php';
		}else{
			die('La vista no existe');
		}
	}

}
?>