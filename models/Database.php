<?php
	class Database
	{
		private $database;
		private $host;
		private $username;
		private $password;
		public $mysqli;
		function __construct()
		{
			$this->host       =		"localhost";
			$this->username   =		"root";
			$this->password   =		'crazy124';
			$this->database 	=		"pizzeria";
			$this->mysqli     =		null;
		}

		public function connect()
		{
			$this->mysqli = new mysqli($this->host, $this->username, $this->password, $this->database);
			if ($this->mysqli->connect_errno) {
				$errorMsg ="Error with MySQL connection. \n";
				$errorMsg .= "Errno: " . $this->mysqli->connect_errno . "\n";
				exit(json_encode(array('err' => $errorMsg)));
			}
			$this->mysqli->set_charset("utf8");

			return true;

		}
		
		function query($sql) 
		{
			$this->connect();
			if (!$query =$this->mysqli->query($sql)) {
				$errorMsg ="Error with MySQL connection. \n";
				$errorMsg .= "Errno: " . $this->mysqli->error . "\n";
			  return false;
			} else {
				if ($query===true) {
					return true;
				} else {
					$rows = array();
					while($row = $query->fetch_assoc()) {
						$rows[] = $row;
					}
					return $rows;
				}
			}
		}


		function queryE($sql) 
		{
			$this->connect();
			if (!$query =$this->mysqli->queryE($sql)) 
			{
				$errorMsg ="Error with MySQL connection. \n";
				$errorMsg .= "Errno: " . $this->mysqli->error . "\n";
			  return false;
			}
			else 
			{
			   $this->mysqli->queryE($sql);
			   console.log( "Datos borrados ");
			}
		}

		public function close() 
		{
			if ($this->mysqli) {
				$this->mysqli->close();
			}
		}
	}
