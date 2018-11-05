<?php 

Class Users extends Controller{

	public function __construct(){
		$this->userModel = $this->model('User');
		//$this->articuloModelo = $this->model('Article');
		//echo 'paginas cargadas';
	}


	public function index(){
		//Optenemos los usuarios
		$usuarios = $this->userModel->getUsers();
		$datos = [
			'titulo'=>'Lista de usuarios',
			'usuarios' => $usuarios
		];

		$this->view('pages/index', $datos);
	}

	public function create(){

		if ($_SERVER['REQUEST_METHOD']=='POST') {
			//Estos campos vienen del formulario
			$datos = [
				'name' 	=> trim($_POST['name']),
				'email' => trim($_POST['email']),
				'phone' => trim($_POST['phone'])
			];

			if ($this->userModel->createUser($datos)) {
				redirect('/pages');
			}else{
				die('Algo salio mal');
			}

		}else{
			$datos = [
				'name'  => '',
				'email' => '',
				'phone' => ''
			];

			$this->view('pages/create', $datos);
		}

	}

	public function edit($id){
		
		if ($_SERVER['REQUEST_METHOD']=='POST') {
			//Estos campos vienen del formulario
			$datos = [
				'id_user'	=> $id,
				'name' 		=> trim($_POST['name']),
				'email' 	=> trim($_POST['email']),
				'phone' 	=> trim($_POST['phone'])
			];

			if ($this->userModel->editUser($datos)) {
				redirect('/pages');
			}else{
				die('Algo salio mal');
			}

		}else{
			//Optener info usuario desde el modelo
			$usuario = $this->userModel->getUser($id);
			$datos = [
				'id_user' => $usuario->id_user,
				'name'  => $usuario->name,
				'email' => $usuario->email,
				'phone' => $usuario->phone
			];

			$this->view('pages/edit', $datos);
		}

	}

	public function delete($id){
		//Optener info usuario desde el modelo

		$usuario = $this->userModel->getUser($id);
		$datos = [
					'id_user'	=> $usuario->id_user,
					'name'  => $usuario->name,
					'email' => $usuario->email,
					'phone' => $usuario->phone
				];
		if ($_SERVER['REQUEST_METHOD']=='POST') {
			//Estos campos vienen del formulario
			$datos = [
					'id_user'	=> $usuario->id_user
				];

			if ($this->userModel->deleteUser($datos)) {
				redirect('/pages');
			}else{
				die('Algo salio mal');
			}

		}

		$this->view('pages/delete', $datos);
		

	}

}
?>