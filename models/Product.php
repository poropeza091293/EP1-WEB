<?php
require_once 'Database.php';
class Product 
{
	public $name;
	public $price;
	public $category;
	public $description;

	public function __construct($name, $price, $category, $description) {
      $this->name = $name;
			$this->price = $price;
	    $this->category = $category;
	    $this->description = $description;
  }

	// return rows
	public function save() {
		$db = new Database();
		$sql = "INSERT INTO
						 	producto(nombre, precio, categoria_id, descripcion)
					VALUES(
									'".$this->name."',
									'".$this->price."',
									'".$this->category."',
									'".$this->description."'
								)
					";
		$db->query($sql);
		$lastId = (int)$db->mysqli->insert_id;
		echo $lastId;
		$db->close();
		return true;
	}
	static public function update($nam,$prod) {

		$sql = "UPDATE producto SET nombre='".$prod->name."', precio='".$prod->price."', categoria_id='".$prod->category."', descripcion='".$prod->description."' WHERE nombre='".$nam."'
					";

		$db = new Database();
		
		$db->query($sql);
		//$lastId = (int)$db->mysqli->insert_id;
		//echo $lastId;
		$db->close();
		
	}
	static function get() {
		$sql = " SELECT
		 						*
							FROM
								producto
						";
		$db = new Database();
		if($rows = $db->query($sql)) {
			return $rows;
		}
		return false;
	}

	static function eliminarP($nombret) {
		$sql = " DELETE FROM producto WHERE nombre = '$nombret' ";
		$db = new Database();

		$db->query($sql);
		$db->close();

		
	}

	static function getPizza() {
		$sql = " SELECT
		 						*
							FROM
								producto WHERE categoria_id=1
						";
		$db = new Database();
		if($rows = $db->query($sql)) {
			return $rows;
		}
		return false;
	}

	static function getPostre() {
		$sql = " SELECT
		 						*
							FROM
								producto WHERE categoria_id=2
						";
		$db = new Database();
		if($rows = $db->query($sql)) {
			return $rows;
		}
		return false;
	}

	static function getBebida() {
		$sql = " SELECT
		 						*
							FROM
								producto WHERE categoria_id=3
						";
		$db = new Database();
		if($rows = $db->query($sql)) {
			return $rows;
		}
		return false;
	}

}
