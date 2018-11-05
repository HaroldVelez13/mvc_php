<?php 

class Article{
	private $db;

	public function __construct(){
		//Llamamos e instanciamos nuestra clase BD_Base
		$this->db = new DB_Base;
	}

	public function getArticles(){
		$this->db->query('SELECT * FROM articles');
		return $this->db->registers();
	}




}

?>