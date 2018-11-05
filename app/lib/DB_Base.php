<?php 

//Clase para conectarse a la base de datos y ejecutar consultas con PDO
class DB_Base{
	private $host 		= DB_HOST;
	private $user 		= DB_USER;
	private $password 	= DB_PASSWORD;
	private $nameDb 	= DB_NAME;
	//data base handler as $dbh
	private $dbh;
	private $stmt;
	private $error;

	public function __construct(){
		//configuramos la coneccion
		$dsn = 'mysql:host='.$this->host.';dbname='.$this->nameDb;

		$options = array(
			PDO::ATTR_PERSISTENT => true,
			PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION
		);

		//creamos una instancia PDO
		try {
			$this->dbh = new PDO($dsn, $this->user, $this->password, $options);
			//para ver bien los caracteres especiales
			$this->dbh->exec('set names utf8');

			
		} catch (PDOException $e) {
			// De existirtomamos e imprimimos el error
			$this->error = $e->getMessage();
			echo $this->error;
		}
	}

	//preparamos la consulta
	public function query($sql){
		$this->stmt = $this->dbh->prepare($sql);
	}

	//Vinculamos la consulta con el metodo Bind
	public function bind($param, $value, $type = null){
		if (is_null($type)) {

			switch (true) {
				case is_int($value):
					$type = PDO::PARAM_INT;
					break;

				case is_bool($value):
					$type = PDO::PARAM_BOOL;
					break;

				case is_null($value):
					$type = PDO::PARAM_NULL;
					break;
				default:
					$type = PDO::PARAM_STR;
					break;				
			}
		}

		$this->stmt->bindValue($param, $value, $type);

	}

	//Ejecutamos la consulta 
	public function execute(){		
		return $this->stmt->execute();
	}

	//Obtenemos los registros de la consulta dada
	public function registers(){
		$this->execute();
		return $this->stmt->fetchAll(PDO::FETCH_OBJ);
	}

	//Obtenemos el registro de la consulta dada
	public function register(){
		$this->execute();
		return $this->stmt->fetch(PDO::FETCH_OBJ);
	}

	//Obtener la cantidad de filas con el metodo rowCount
	public function rowCount(){		
		return $this->stmt->rowCount();
	}


}

?>