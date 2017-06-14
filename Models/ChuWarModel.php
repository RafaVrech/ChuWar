<?php
	

	class playerModel{
		private $name;
		private $domain = array();

		public function __construct($name,$domain){
			$this -> name = $name;
			$this -> domain = $domain;
		}
		
		public function setDomain($arr){
			$this -> domain = $arr;

		}

		public function getDomain(){
			return $this -> domain;
		}

		public function assignDomain($paises){

			$domain = array(); 
			foreach($paises as $key => $pais){
		    	if($key%2 == 0){
		    		$domain[$pais['pais']] = 3;
		    	}
			}
		    return $domain;
		}

		public function domainSave($user,$data){
			$pdo = new PDO('mysql:host=localhost;dbname=ChuWar', DBuser, DBpassword);
			$query = 'UPDATE users SET domain = :data WHERE username=:user';
	 		$statement = $pdo -> prepare($query);
	 		$statement -> bindValue(":data",$data);
	 		$statement -> bindValue(":user",$user);

		    return $statement -> execute();
		}
	}

	class botModel{
		private $name;
		public $domain = array();

		public function __construct($name){
			$this -> name = $name;
		}

		

		public function setDomain($arr){
			$this -> domain = $arr;

		}

		public function getDomain(){
			return $this -> domain;
		}

		public function assignDomain($paises){

			$domain = array(); 
			foreach($paises as $key => $pais){
		    	if($key%2 != 0){
		    		$domain[$pais['pais']] = 3;
		    	}   
			}
		    return $domain;
		}

		public function domainSave($user,$data){
			$pdo = new PDO('mysql:host=localhost;dbname=ChuWar', DBuser, DBpassword);
			$query = 'UPDATE users SET botDomain = :data WHERE username=:user';
	 		$statement = $pdo -> prepare($query);
	 		$statement -> bindValue(":data",$data);
	 		$statement -> bindValue(":user",$user);

		    return $statement -> execute();
		}
		public function nameSave($user,$data){
			$pdo = new PDO('mysql:host=localhost;dbname=ChuWar', DBuser, DBpassword);
			$query = 'UPDATE users SET botName = :data WHERE username=:user';
	 		$statement = $pdo -> prepare($query);
	 		$statement -> bindValue(":data",$data);
	 		$statement -> bindValue(":user",$user);

		    return $statement -> execute();
		}
	}

	class ChuWarModel{

		public function gerarPaises(){
			$pdo = new PDO('mysql:host=localhost;dbname=ChuWar', DBuser, DBpassword);

	 		$query = 'SELECT * FROM paises';
	 		$statement = $pdo -> prepare($query);
		    $statement -> execute();

			$paises = $statement -> fetchAll();

			shuffle($paises);

			return $paises;
		}


		

		public function domainToArray($string){
			$arrPaises = explode(",",$string);
			$arrReturn = array();
			foreach($arrPaises as $value){
				if(!empty(($value))){
					$arrValores = explode("=",$value);
					$arrReturn[$arrValores['0']] = $arrValores['1'];	
				}
			}
			return $arrReturn;
		}
		public function domainToString($array){
			$string ='';
			$i = 1;
			foreach($array as $key => $value){	
				if(!($i == count($array))){
					$string = $string."$key=$value,";
				}else{
					$string = $string."$key=$value";
				}
				$i++;
			}
			return $string;
		}

		public function randName() {
		    $pdo = new PDO('mysql:host=localhost;dbname=ChuWar', DBuser, DBpassword);
 
		    $query = 'SELECT * FROM randNames WHERE id=:id';
		 
		    $statement = $pdo -> prepare($query);
		    $statement -> bindValue(":id",rand ( 0 , 100));
		    $statement -> execute();		
		 
		    $names = $statement -> fetch(PDO::FETCH_ASSOC);

		    return utf8_encode($names['name']);
		}

	}

	

/*			?> <pre><?php echo var_dump($paises) ?></pre> <?php
INSERT INTO paises (pais,fronteira) VALUES ('Brasil','Argentina,Colômbia,Egito');
 INSERT INTO paises (pais,fronteira) VALUES ('Argentina','Brasil,Colômbia');
 INSERT INTO paises (pais,fronteira) VALUES ('Colômbia','Brasil,México');
 INSERT INTO paises (pais,fronteira) VALUES ('México','Colômbia,EUA');
 INSERT INTO paises (pais,fronteira) VALUES ('EUA','México,Rússia,Reino Unido');
 INSERT INTO paises (pais,fronteira) VALUES ('Reino Unido','EUA,França,Alemanha');
 INSERT INTO paises (pais,fronteira) VALUES ('França','Alemanha,Reino Unido,Egito');
 INSERT INTO paises (pais,fronteira) VALUES ('Alemanha','França,Reino Unido,Egito,Rússia');
 INSERT INTO paises (pais,fronteira) VALUES ('Egito','França,Alemanha,Brasil,África do Sul');
 INSERT INTO paises (pais,fronteira) VALUES ('África do Sul','Egito');
 INSERT INTO paises (pais,fronteira) VALUES ('Rússia','Alemanha,China,EUA');
 INSERT INTO paises (pais,fronteira) VALUES ('China','Rússia');
*/
?>
