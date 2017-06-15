<?php
	require(__DIR__.'/Controllers/LoginController.php');
	require(__DIR__.'/Controllers/ChuWarController.php');
	define("DBuser", "root");
	define("DBpassword", "");
	session_start();

	if(!isset($_SESSION['username'])){
		if(!isset($_POST['newuser'])){
			if(isset($_POST['username']) && $_POST['username'] != '') {
		    	(new loginController) -> login();
		    	header("Refresh:0");
		    }else{
				(new LoginView) -> output();
				if(isset($_POST['username']) && $_POST['username'] == ''){
					echo "Falha no login";
				}
			}
		}else{
			(new loginController) -> register();
		}
	}else{
		if(isset($_POST['logoff'])){
			echo"Saindo do jogo...";
			unset($_SESSION['username']);
			unset($_SESSION['domain']);
			unset($_SESSION['botDomain']);
			unset($_SESSION['botName']);
			unset($_POST['username']);
			unset($_POST['logoff']);
			unset($_POST['attacking']);
			unset($_POST['receiving']);
			header("Refresh:0");
		}else{
			(new ChuWarController) -> game();
		}
	}

?>
