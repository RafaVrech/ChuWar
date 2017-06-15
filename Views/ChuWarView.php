<?php
	class ChuWarView{
		public function output($playerDomain,$botDomain,$paises){

			# Tabela de países do jogador
			echo'
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
				<form method="post" >

					<select name="attack" id="attackingDL" required>
					</select>


			 		<button type="submit" >Atacar!</button>
					<p id="message"></p>
				</form>


				<form method="post">
			 		<button type="submit" name="logoff" value="" >Voltar ao login.</button>
				</form>
			</center>
			';

			# Script
			echo'
			<script type="text/javascript">
				attacking = document.getElementById(\'attackingDL\');
				';

				foreach($playerDomain as $key => $value){
					foreach($paises as $key2 => $value2){
						if(utf8_encode($value2['pais']) == $key){ # Só vai rodar com os países que estão no dominio do player:
							foreach($botDomain as $key3 => $value3){
								foreach(explode(",",utf8_encode($value2['fronteira'])) as $value4){
									if($key3 == $value4){	# Adiciona aos DropdownList os países que estejam no domínio do BOT e tenham fronteira com algum país
										echo'
										var opt = document.createElement("option");
							      opt.value = "'.$key.','.$value4.'";
							      opt.text = "'.$key.' => '.$value4.'";
										attacking.appendChild(opt);
										';
									}
								}
							}
						}
					}
				}
				echo'

			</script>
			';

		}
	}
?>
