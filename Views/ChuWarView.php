<?php
	class ChuWarView{
		public function output($playerDomain,$botDomain,$paises){

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

			<center>
				<form action="" method="post" >
					<select name="attacking" id="attackingDL" onchange="populateReceiving()">';
						foreach($playerDomain as $key => $value){
					  		echo'<option value="'.$key.'">'.$key.'</option>';
						}
		  			echo'
					</select>
					<p id="message"></p>
					<select name="receiving" id="receivingDL">

					</select>
			 		<button type="submit" >Atacar!</button>
				</form>

			</center>

			<form action="" method="post">
		 		<button type="submit" name="logoff" value="" >Voltar ao login.</button>
			</form>

			<script type="text/javascript">

				var botDomain = [];
				';
				foreach($botDomain as $key => $value){
					echo'botDomain.push("'.$key.'");
					';
				}
				echo 'var attackers = [];';
				foreach($paises as $key => $value){
					$pais = utf8_encode($value['pais']);
					echo'attackers.push("'.$pais.'");
					';
					echo'var '.str_replace(' ','_',$pais).' = [];
					';
					foreach(explode(",",utf8_encode($value['fronteira'])) as $value2){
						echo str_replace(' ','_',$pais).'.push("'.$value2.'");
						';
					}
					echo '
					';
				}
				echo'
				attacking = document.getElementById(\'attackingDL\');
				receiving = document.getElementById(\'receivingDL\');
				var canAttack = 0;
				function populateReceiving() {
					receiving.options.length = 0;
					canAttack = 0;
					switch (attacking.value) {
						';
						foreach($paises as $value){
							$pais = utf8_encode($value['pais']);
							echo '
							case \''.$pais.'\':
							for (i = 0; i < '.str_replace(' ','_',$pais).'.length; i++) {
								botDomain.forEach(foreachBotDomain.bind(null, '.str_replace(' ','_',$pais).'[i]));
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
			</script>
			';
			?> <pre><?php echo var_dump($_POST) ?></pre> <?php
		}
	}
?>
