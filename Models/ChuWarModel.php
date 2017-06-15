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

		public function botAttack(&$bot, &$player, $attacking, $receiving){
			echo "
			<center>
				<b>Ataque do BOT</b> <br>
				".$attacking."(".$bot -> getDomain()[$attacking].") atacando ".$receiving."(".$player -> getDomain()[$receiving]."):
			</center>";
			$this -> attack($bot, $player, $receiving, $attacking);
		}

		public function playerAttack(&$bot, &$player, $attacking, $receiving){
			echo "
			<center>
				<b>Ataque do JOGADOR</b> <br>
				".$attacking."(".$player -> getDomain()[$attacking].") atacando ".$receiving."(".$bot -> getDomain()[$receiving]."):
			</center>";
			$this -> attack($bot, $player, $attacking, $receiving);
		}

		public function attack(&$bot, &$player, $attacking, $receiving){

			# Pega o domain dos objetos
			$playerDomain = $player -> getDomain();
			$botDomain = $bot -> getDomain();
			# Pega o número de exercitos do pais atacante e do que recebe o ataque
			$playerArmy = $playerDomain[$attacking];
			$botArmy = $botDomain[$receiving];
			# Enquanto um país não perder todos os exercitos
			while($playerArmy != 0 && $botArmy !=0){
				# Se número de 0 a 10 maior que 5
				if(rand(0,10) > 5){
					--$botArmy;
				}else{
					--$playerArmy;
				}
			}

			# Vê qual dos dois exercitos chegou a zero, indicando quem ganhou/perdeu
			if($playerArmy == 0){
				$botDomain[$receiving] = $botArmy;
				$botDomain[$attacking] = 1;
				$key = array_search($attacking,array_keys($playerDomain));
				echo '<center><a>"'.$_SESSION['botName'].'" ganhou a batalha e apoderou-se de "'.array_keys($playerDomain)[$key].'"!</a></center>';
				unset($playerDomain[$attacking]);
			}else{
				$playerDomain[$attacking] = $playerArmy;
				$playerDomain[$receiving] = 1;
				$key = array_search($receiving,array_keys($botDomain));
				echo '<center><a>"'.$_SESSION['username'].'" ganhou a batalha e apoderou-se de "'.array_keys($botDomain)[$key].'"!</a></center>';
				unset($botDomain[$receiving]);
			}

			# Salva os novos dominios
			$botDomainString = $this -> domainToString($botDomain);
			$playerDomainString = $this -> domainToString($playerDomain);

			$bot -> domainSave($_SESSION['username'],utf8_decode($botDomainString));
			$player -> domainSave($_SESSION['username'],utf8_decode($playerDomainString));

			$_SESSION['domain'] = $playerDomainString;
			$_SESSION['botDomain'] = $botDomainString;

			$bot -> setDomain($botDomain);
			$player -> setDomain($playerDomain);
		}

		public function afterRound(&$bot, &$player, $botDomain,$playerDomain){
			$keys = array_keys($botDomain);
			for($i = 0;$i< 6;$i++){
				$botDomain[$keys[rand(0,count($botDomain)-1)]]++;
			}

			$keys = array_keys($playerDomain);
			for($i = 0;$i< 6;$i++){
				$playerDomain[$keys[rand(0,count($playerDomain)-1)]]++;
			}

			$bot -> setDomain($botDomain);
			$player -> setDomain($playerDomain);

			$botDomainString = $this -> domainToString($botDomain);
			$playerDomainString = $this -> domainToString($playerDomain);

			$bot -> domainSave($_SESSION['username'],utf8_decode($botDomainString));
			$player -> domainSave($_SESSION['username'],utf8_decode($playerDomainString));

			$_SESSION['domain'] = $playerDomainString;
			$_SESSION['botDomain'] = $botDomainString;

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
