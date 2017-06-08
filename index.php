<?php
	require(__DIR__.'/Controllers/LoginController.php');
	if(!isset($_POST['newuser'])){
		if(isset($_POST['username'])) {
	    	(new loginController) -> login();
	    }else{
			(new LoginView()) -> output();
		}
	}else{
		(new loginController) -> register();
	}
	

?>