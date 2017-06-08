<?php
	require(__DIR__.'/../Models/ChuWarModel.php');
	require(__DIR__.'/../Views/ChuWarView.php');

	class ChuWarController{

		public function game(){

			$bot = new botModel();
			$player = new playerModel($_SESSION['username']);	

			echo " game <br>";
			echo "<br>";
			var_dump($bot);
			echo "<br>";
			var_dump($player);
		}
	}
?>