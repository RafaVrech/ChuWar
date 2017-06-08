<?php
	class playerModel{
		private $name;

		public function __construct($name){
			$this -> name = $name;
		}


	}

	class botModel{

		public function __construct(){
			$this -> name = $this -> randName();
		}

		public function randName() {
		    $pdo = new PDO('mysql:host=localhost;dbname=ChuWar', 'root', '');
 
		    $query = 'SELECT * FROM randNames WHERE id=:id';
		 
		    $statement = $pdo -> prepare($query);
		    $statement -> bindValue(":id",rand ( 0 , 100));
		    $statement -> execute();		
		 
		    $names = $statement -> fetch(PDO::FETCH_ASSOC);

	    	
		    $pdo = null;

		    return $names['name'];
		}


	}

?>