<?php
	require(__DIR__.'/../Models/ChuWarModel.php');
	require(__DIR__.'/../Views/ChuWarView.php');

	class ChuWarController{


		public function game(){

	 		$ChuWarView = new ChuWarView();
			$ChuWarModel = new ChuWarModel();
			$paises = $ChuWarModel -> gerarPaises();

			#SE já tiver um jogo aberto para o usuario
			if($_SESSION['domain'] != '' && $_SESSION['botDomain'] != ''){

				# Instancia os objetos com os dominios passados para a sessão no login
				$player = new playerModel($_SESSION['username'], $ChuWarModel -> domainToArray($_SESSION['domain']));
				$bot = new botModel($_SESSION['botName'], $ChuWarModel -> domainToArray($_SESSION['botDomain']));

				# Se tiver uma jogada para ser processada
				if(isset($_POST['attack'])){

					$attack = explode(",",$_POST['attack']);

					# Processa o ataque do player e desaloca os paises do POST
					$ChuWarModel -> playerAttack($bot, $player, $attack[0], $attack[1]);
					unset($_POST['attack']);

					# Decide onde o computador vai atacar
					$maior = 0;
					$menor = 9999;
					foreach($player -> getDomain() as $key => $value){
						foreach($paises as $key2 => $value2){
							if(utf8_encode($value2['pais']) == $key){ # Só vai rodar com os países que estão no dominio do player:
								foreach($bot -> getDomain() as $key3 => $value3){
									foreach(explode(",",utf8_encode($value2['fronteira'])) as $value4){
										if($key3 == $value4){	# Adiciona aos DropdownList os países que estejam no domínio do BOT e tenham fronteira com algum país
											if($maior < $value3){
												$maior = $value3;
												$maiorPais = $key3;
											}
											if($menor > $value){
												$menor = $value;
												$menorPais = $key;
											}
										}
									}
								}
							}
						}
					}
					# Processa a jogada do computador
					$ChuWarModel -> botAttack($bot, $player, $maiorPais, $menorPais);

					$ChuWarModel -> afterRound($bot, $player, $bot -> getDomain(), $player -> getDomain());
					header("Refresh:5");
				}
				$ChuWarView -> output($player -> getDomain(),$bot -> getDomain(),$paises);

			}else{ # Ou o jogo não comeõu ainda ou alguem perdeu

				if($_SESSION['domain'] == '' && $_SESSION['botDomain'] != ''){

					echo $_SESSION['botName']." GANHOU!";
					unset($_SESSION['username']);
					unset($_SESSION['domain']);
					unset($_SESSION['botDomain']);
					unset($_SESSION['botName']);
					unset($_POST['username']);
					unset($_POST['logoff']);
					unset($_POST['attack']);
					header("Refresh:5");

				}else if($_SESSION['domain'] != '' && $_SESSION['botDomain'] == ''){
					echo $_SESSION['username']." GANHOU!";
					unset($_SESSION['username']);
					unset($_SESSION['domain']);
					unset($_SESSION['botDomain']);
					unset($_SESSION['botName']);
					unset($_POST['username']);
					unset($_POST['logoff']);
					unset($_POST['attack']);
					header("Refresh:5");
				}else{ # Inicianto partida
					//INICIALIZA OBJETOS PLAYER E BOT COM SEUS NOMES
					$player = new playerModel($_SESSION['username'], '');
					$botName = $ChuWarModel -> randName();
					$bot = new botModel($botName);
					$bot -> nameSave($_SESSION['username'],$botName);
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
					$player -> domainSave($_SESSION['username'],$playerDomainString);
					$bot -> domainSave($_SESSION['username'],$botDomainString);

					//COLOCA NOS OBJETOS OS PAISES INICIAIS
					$player -> setDomain($ChuWarModel -> domainToArray($playerDomainString));
					$bot -> setDomain($ChuWarModel -> domainToArray($botDomainString));
					header("Refresh:0");
					$ChuWarView -> output($player -> getDomain(),$bot -> getDomain(),$paises);
				}
			}
		}
	}
?>
