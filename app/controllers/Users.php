<?php 
//Controlador usuario
Class Users extends Controller{
	//PAth de las paginas
	private $path = '/pages/users/';

	public function __construct(){
		//Instanciamos el modelo
		$this->userModel = $this->model('User');
	}

	//La funcion index es el metodo por defecto y/o el primero en ser ejecutado
	public function index(){
		//Optenemos los usuarios
		$usuarios = $this->userModel->getUsers();
		$datos = [
			'titulo'=>'Lista de usuarios',
			'usuarios' => $usuarios
		];
		//Retornamos la vista con los tados
		$this->view($this->path.'index', $datos);
	}

	//Create gestiona tanto la vista como la logica para crear un nuevo usuario
	public function create(){
		//Si se llama al metodo por POST
		if ($_SERVER['REQUEST_METHOD']=='POST') {
			//Estos campos vienen del formulario
			//Los recojemos en nuestra variable
			$datos = [
				'name' 	=> trim($_POST['name']),
				'email' => trim($_POST['email']),
				'phone' => trim($_POST['phone'])
			];
			//Los enviamos a nuestro modelo, y si todo sale bien
			if ($this->userModel->createUser($datos)) {
				//Redirigimos al index!
				redirect($this->path);
			}else{
				//Si sale mal el createUser
				die('Algo salio mal eal crear el Usuario');
			}

		}else{
			//Si no es por metodo POST, vaciamos la variable Datos
			$datos = [
				'name'  => '',
				'email' => '',
				'phone' => ''
			];
			//retornamos la vista para crear
			$this->view($this->path.'create', $datos);
		}

	}
	//Edit gestiona tanto la vista como la logica para editar un usuario
	public function edit($id){
		//De ser llamada por el metodo post
		if ($_SERVER['REQUEST_METHOD']=='POST') {
			//Recojemos los datos
			//Estos campos vienen del formulario
			$datos = [
				'id_user'	=> $id,
				'name' 		=> trim($_POST['name']),
				'email' 	=> trim($_POST['email']),
				'phone' 	=> trim($_POST['phone'])
			];
			//Enviamos los datos a nuestro modelo
			if ($this->userModel->editUser($datos)) {
				//Si todo sale bien volvemos al index
				redirect($this->path);
			}else{
				//Error de salir algo mal al guardar
				die('Algo salio mal al editar el Usuario');
			}

		}else{
			//De ser por el methodo get
			//Optener info usuario desde el modelo
			$usuario = $this->userModel->getUser($id);
			$datos = [
				'id_user' => $usuario->id_user,
				'name'  => $usuario->name,
				'email' => $usuario->email,
				'phone' => $usuario->phone
			];
			//Retornamos la vista para editar con los datos necesarios
			$this->view($this->path.'edit', $datos);
		}

	}
	//Delete gestiona tanto la vista como la logica para eliminar un usuario
	public function delete($id){
		//Optener info usuario desde el modelo y los asignamos a nuestra variable datos
		$usuario = $this->userModel->getUser($id);
		$datos = [
					'id_user'	=> $usuario->id_user,
					'name'  => $usuario->name,
					'email' => $usuario->email,
					'phone' => $usuario->phone
				];
		//Si es por metodo POST, eliminamos el usuario
		if ($_SERVER['REQUEST_METHOD']=='POST') {
			//Estos campos vienen del modelo
			$datos = [
					'id_user'	=> $usuario->id_user
				];
			//Si salio bien al eliminar el usuario, devolvemos el index
			if ($this->userModel->deleteUser($datos)) {
				redirect($this->path);
			}else{
				//De salir algo mal, retornamos error
				die('Algo salio mal al eliminar el usuario');
			}

		}
		//Si llegamos aqui por el metodo POST, retornamos la vista de confirmacion
		$this->view($this->path.'delete', $datos);		

	}

}
?>