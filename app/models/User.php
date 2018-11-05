<?php 
/**
 * 
 */
class User{

	private $db;
	
	public function __construct()
	{
		$this->db = new DB_Base;
	}

	public function getUsers(){
		$this->db->query('SELECT * FROM users');
		$resultados = $this->db->registers();
		return $resultados;
	}

	public function createUser($datos){
		$this->db->query('INSERT INTO users (name, email, phone) VALUES (:name, :email, :phone)');

		//vicular valores
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

	public function getUser($id){
		$this->db->query('SELECT * FROM users WHERE id_user = :id_user');
		//vicular valores
		$this->db->bind(':id_user', $id);
		$fila = $this->db->register();
		return $fila;


	}

	public function editUser($datos){
		$this->db->query('UPDATE users SET name=:name, email=:email, phone=:phone WHERE id_user=:id_user');

		//vicular valores
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

	public function deleteUser($datos){
		$this->db->query('DELETE FROM users WHERE id_user=:id_user');

		//vicular valores
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