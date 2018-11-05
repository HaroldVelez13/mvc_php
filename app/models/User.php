<?php 
/**El modelo Usuario gestiona los datos 
 * Desde las cosultas hasta las actualizaciones
 */
class User{

	private $db;
	
	public function __construct()
	{	//Instanciamos nuestra clase DB_Base
		$this->db = new DB_Base;
	}

	//Seleccionamos todos los usuarios y los retornamos
	public function getUsers(){
		$this->db->query('SELECT * FROM users');//Construimos la consulta
		$usuarios = $this->db->registers();//la ejecutamos
		return $usuarios;//retornamos los datos
	}

	//Recibimos los datos del nuevo usuario para crearlo
	public function createUser($datos){
		//Contruimos la consulta para insertar
		$this->db->query('INSERT INTO users (name, email, phone) VALUES (:name, :email, :phone)');

		//vicular y validamos los valores
		$this->db->bind(':name', $datos['name']);
		$this->db->bind(':email', $datos['email']);
		$this->db->bind(':phone', $datos['phone']);

		//ejecutamos y retornamos datos
		if ($this->db->execute()) {
			return true;
		}else{
			return false;
		}

	}

	//Recivimos el id del usuario para retornar sus datos
	public function getUser($id){
		$this->db->query('SELECT * FROM users WHERE id_user = :id_user');//construimos la consulta
		//viculamos y validamos los valores
		$this->db->bind(':id_user', $id);
		$usuario = $this->db->register();//ejecutamos la consulta
		return $usuario;//lo retornamos


	}

	//Recivimos al usuario que queremos editar conn sus nuevos valores
	public function editUser($datos){
		//Preparamos la consulta
		$this->db->query('UPDATE users SET name=:name, email=:email, phone=:phone WHERE id_user=:id_user');

		//viculamos y validamos los  valores
		$this->db->bind(':id_user', $datos['id_user']);
		$this->db->bind(':name', $datos['name']);
		$this->db->bind(':email', $datos['email']);
		$this->db->bind(':phone', $datos['phone']);

		//ejecutamos y retornamos datos
		if ($this->db->execute()) {
			return true;
		}else{
			return false;
		}

	}

	//Recibimos el id del usuario que queremos eliminar
	public function deleteUser($datos){
		//Preparamos la consulta
		$this->db->query('DELETE FROM users WHERE id_user=:id_user');

		//viculamos y validamos los valores
		$this->db->bind(':id_user', $datos['id_user']);

		//ejecutamos y retornamos datos
		if ($this->db->execute()) {
			return true;
		}else{
			return false;
		}

	}
}
?>