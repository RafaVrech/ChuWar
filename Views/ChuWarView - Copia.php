<?php
	class ChuWarView{
		public function output($playerDomain,$botDomain,$paises){

			# Tabela de países do jogador
			echo'<body onload="populateReceiving()">
			<div style="display: inline-block;">
				<table>
					<caption>"'.$_SESSION['username'].'"</caption>
					<tr>
						<th>Países</th>
						<th>Exércitos</th>
					</tr>';
					foreach($playerDomain as $key => $value){
						echo'<tr>
							<td>'.$key.'</td>
							<td>'.$value.'</td>
						</tr>';
					}

			# Tabela de países do computador
			echo'
				</table>
			</div>

			<div style="float:right">
				<table>
					<caption>"'.$_SESSION['botName'].'"</caption>
					<tr>
						<th>Países</th>
						<th>Exércitos</th>
					</tr>';
					foreach($botDomain as $key => $value){
						echo'<tr>
							<td>'.$key.'</td>
							<td>'.$value.'</td>
						</tr>';
					}
			echo'
				</table>
			</div>
			';

			# Menu de seleção de ataque
			echo'
			<center style="margin-top:10%">
				<form action="" method="post" >

					<select name="attacking" id="attackingDL" onchange="populateReceiving()" required>';
						foreach($playerDomain as $key => $value){
					  		echo'<option value="'.$key.'">'.$key.'</option>';
						}
		  			echo'
					</select>

					=> Ataca =>
					<select name="receiving" id="receivingDL" required>

					</select>

			 		<button type="submit" >Atacar!</button>
					<p id="message"></p>
				</form>


				<form action="" method="post">
			 		<button type="submit" name="logoff" value="" >Voltar ao login.</button>
				</form>
			</center>
			';

			# Script
			echo'
			<script type="text/javascript">

				var botDomain = [];
				';
				# Cria uma array em javascript com o domínio do computador
				foreach($botDomain as $key => $value){
					echo'botDomain.push("'.$key.'");
					';
				}

				# Cria uma array em javascript para cada país, com os países que eles podem atacar
				foreach($paises as $key => $value){
					$pais = utf8_encode($value['pais']);
					echo'var '.str_replace(' ','_',$pais).' = [];
					';
					foreach(explode(",",utf8_encode($value['fronteira'])) as $value2){
						echo str_replace(' ','_',$pais).'.push("'.$value2.'");
						';
					}
					echo '
					';
				}

				# Pega o elemento das duas Dropdown Lists
				echo'
				attacking = document.getElementById(\'attackingDL\');
				receiving = document.getElementById(\'receivingDL\');
				var canAttack = 0;

				function populateReceiving() {
					receiving.options.length = 0;

					switch (attacking.value) {
						';
						foreach($paises as $value){
							$pais = utf8_encode($value['pais']);
							echo '
							case \''.$pais.'\':
							canAttack = 0;
							for (i = 0; i < '.str_replace(' ','_',$pais).'.length; i++) {
								botDomain.forEach(foreachBotDomain.bind(null, '.str_replace(' ','_',$pais).'[i]));
							}
							if(canAttack == 0){
								removeOption(\''.$pais.'\');
							}
							break;
							';
						}
						echo'
					}
				}


				function createOption(dropdown, text, value) {

					var opt = document.createElement(\'option\');
					opt.value = value;
					opt.text = text;
					dropdown.options.add(opt);
				}

				function foreachBotDomain(param, item, index){
					if(item == param){
						createOption(receiving, item, item);
						canAttack += 1;
					}
					message.innerHTML = "Esse país pode atacar " + canAttack + " país(es) inimigos";
				}

				function removeOption(pais){
					attacking.remove(attacking.selectedIndex);
					populateReceiving();
				}
			</script>
			';

		}
	}
?>
