<?php
	class LoginModel{
		private $usernameForm;

		public function authenticate($username){
			
			if($this -> getFromDB($username)['username'] == $username){
				return true;
			}else{
				return false;
			}
		}

		public function register($username){
			if($this -> insertDB($username)){
				return true;
			}else{
				return false;
			}

		}

		public function getFromDB($user){
			$pdo = new PDO('mysql:host=localhost;dbname=ChuWar', DBuser, DBpassword);
 
		    $query = 'SELECT * FROM users WHERE username=:username';
		 
		    $statement = $pdo -> prepare($query);
		    $statement -> bindValue(":username",$user);
		    $statement -> execute();
		 
		    $userArr = $statement->fetch(PDO::FETCH_ASSOC);

		 	if(isset($userArr['username'])){
				return $userArr;
		 	}else{
		 		return null;
		 	}
	 	}

	 	private function insertDB($user){
 			$pdo = new PDO('mysql:host=localhost;dbname=ChuWar', DBuser, DBpassword);
 
		    $query = 'INSERT INTO users (username) VALUES (:username)';
		 
		    $statement = $pdo -> prepare($query);

		    $statement -> bindValue(":username",$user);
		    return $statement -> execute();
	 	}

	 	public function loginSuccess($username){ 
	 		$arr = $this -> getFromDB($username);	
	 		$_SESSION['username'] = $username;	
	 		$_SESSION['domain'] = utf8_encode($arr['domain']);	
	 		$_SESSION['botDomain'] = utf8_encode($arr['botDomain']);	
	 		$_SESSION['botName'] = utf8_encode($arr['botName']);
	 		?> <pre><?php echo var_dump($_SESSION['botDomain']) ?></pre> <?php	
			header("Refresh:0.25");
			exit;
		}

		public function loginFailed(){
			
			echo '
					<form action="" method="post">
				 		<button type="submit" name="newuser" value="'.$_POST['username'].'" >Iniciar novo jogo como "'.$_POST['username'].'"</button>
					</form>
			';
			exit;
		}
	}
?>