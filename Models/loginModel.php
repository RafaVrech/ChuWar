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

		private function getFromDB($user){
			$pdo = new PDO('mysql:host=localhost;dbname=ChuWar', 'root', '');
 
		    $query = 'SELECT * FROM users WHERE username=:username';
		 
		    $statement = $pdo -> prepare($query);
		    $statement -> bindValue(":username",$user);
		    $statement -> execute();
		 
		    $userArr = $statement->fetch(PDO::FETCH_ASSOC);

		    $pdo = null;

		 	if(isset($userArr['username'])){
				return $userArr;
		 	}else{
		 		return null;
		 	}
	 	}

	 	private function insertDB($user){
 			$pdo = new PDO('mysql:host=localhost;dbname=ChuWar', 'root', '');
 
		    $query = 'INSERT INTO users (username) VALUES (:username)';
		 
		    $statement = $pdo -> prepare($query);
		    $pdo = null;
		    $statement -> bindValue(":username",$user);
		    return $statement -> execute();
	 	}

	 	public function loginSuccess(){
			header("Location:ChuWar.php");
			exit;
		}

		public function loginFailed(){
			
			echo 'Usuário não encontrado. 
					<form action="" method="post">
				 		<button type="submit" name="newuser" value="'.$_POST['username'].'" >Iniciar novo jogo como "'.$_POST['username'].'"?</button>
					</form>
			';
			exit;
		}
	}
?>