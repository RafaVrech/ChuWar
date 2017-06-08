<?php
	require(__DIR__.'/Controllers/LoginController.php');
	require(__DIR__.'/Controllers/ChuWarController.php');
	session_start();

	if(!isset($_SESSION['username'])){
		if(!isset($_POST['newuser'])){
			if(isset($_POST['username'])) {
		    	(new loginController) -> login();
		    	header("Refresh:0");
		    }else{
				(new LoginView) -> output();
			}
		}else{
			(new loginController) -> register();
		}
	}else{
		if(isset($_POST['logoff'])){
			echo"Saindo do jogo...";
			unset($_SESSION['username']);
			unset($_POST['username']);	
			unset($_POST['logoff']);
			header("Refresh:0");
		}else{
			(new ChuWarController) -> game();
			(new ChuWarView) -> output();
		}
	}

?>