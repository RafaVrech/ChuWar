<?php
	require(__DIR__.'/../Models/loginModel.php');
	require(__DIR__.'/../Views/loginView.php');

	class LoginController{

		public function login(){
			$loginModel = new loginModel();
			if($loginModel -> authenticate($_POST['username'])){
				$loginModel -> loginSuccess();
			}else{
				(new LoginView()) -> output();
				$loginModel -> loginFailed();
			}
		}

		public function register(){
			$loginModel = new loginModel();
			if($loginModel -> register($_POST['newuser'])){
				$loginModel -> loginSuccess();
			}
		}
	}
?>