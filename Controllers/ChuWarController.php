<?php
	require(__DIR__.'/../Models/ChuWarModel.php');
	require(__DIR__.'/../Views/ChuWarView.php');

	class ChuWarController{
		static $ChuWarModel;
		public function game(){

	 		$ChuWarView = new ChuWarView();
			$ChuWarModel = new ChuWarModel();
			$paises = $ChuWarModel -> gerarPaises();

			if($_SESSION['domain'] != '' || $_SESSION['botDomain'] != ''){ //SE tiver um jogo aberto para o usuario

				$player = new playerModel($_SESSION['username'], $ChuWarModel -> domainToArray($_SESSION['domain']));
				$bot = new playerModel($_SESSION['botName'], $ChuWarModel -> domainToArray($_SESSION['botDomain']));

				if(isset($_POST['attacking']) && isset($_POST['receiving'])){

					$playerDomain = $player -> getDomain();
					$botDomain = $bot -> getDomain();
					
					$playerArmy = $playerDomain[$_POST['attacking']];
					$botArmy = $botDomain[$_POST['receiving']];

					for($i = 0;$i < $playerArmy;$i++){

					}


				}

			}else{


				//INICIALIZA OBJETOS PLAYER E BOT COM SEUS NOMES
				$player = new playerModel($_SESSION['username'], '');
				$botName = $ChuWarModel -> randName();
				$bot = new botModel($botName);
				$bot -> nameSave(utf8_decode($_SESSION['username']),$botName);
				$_SESSION['botName'] = utf8_encode($botName);

				//SEPARA OS PAISES INICIAIS
				$playerDomain = $player -> assignDomain($paises);
				$botDomain = $bot -> assignDomain($paises);

				$playerDomainString = $ChuWarModel -> domainToString($playerDomain);
				$botDomainString = $ChuWarModel -> domainToString($botDomain);

				//COLOCA NA SESSÂO OS PAISES
				$_SESSION['domain'] = utf8_encode($playerDomainString);
				$_SESSION['botDomain'] = utf8_encode($botDomainString);

	 			//SALVA NO BANCO OS PAISES
				$player -> domainSave(utf8_decode($_SESSION['username']),$playerDomainString);
				$bot -> domainSave(utf8_decode($_SESSION['username']),$botDomainString);

				//COLOCA NOS OBJETOS OS PAISES INICIAIS

				$player -> setDomain($ChuWarModel -> domainToArray($playerDomainString));
				$bot -> setDomain($ChuWarModel -> domainToArray($botDomainString));
				header("Refresh:0");
			}

			$ChuWarView -> output($player -> getDomain(),$bot -> getDomain(),$paises);

			/*echo "PLAYER: ";
			?> <pre><?php echo var_dump($player) ?></pre> <?php
			echo "SESSAO DOMAIN: ";
			?> <pre><?php echo var_dump($_SESSION['domain']) ?></pre> <?php

			echo "<br>";

			echo "BOT: ";
			?> <pre><?php echo var_dump($bot) ?></pre> <?php
			echo "SESSAO BOTDOMAIN: ";
			?> <pre><?php echo var_dump($_SESSION['botDomain']) ?></pre> <?php*/


		}
	}
?>
