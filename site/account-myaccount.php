<?php
# AUTHOR: RICARDO AZZI #
# CREATED: 17/01/13 #
require_once($_SERVER["DOCUMENT_ROOT"]."/plugins/config.php");
$page = new Page(array(
	"js" => TRUE,
	"css" => TRUE,
	"logado" => TRUE
));
$page->jsClass("form"); 
$sql = new MySql("ttotserver");
?>

<div class="box">
	<img src="plugins/img/corner-tl.gif" />
	<img src="plugins/img/corner-tr.gif" />
	<span class="content">
		<h1>Meus Personagens</h1>
		<span class="content">
			<fieldset>
				<legend>Minha Conta</legend>
				<h3>Administrar seus personagens:</h3>
				<?php
				$players = $sql->Query("SELECT name, vocation, level, online FROM players WHERE account_id=".$_SESSION["id"]);
				if ($players != FALSE) {
				?>
				<table cellspacing="0" class="common">
					<thead>
						<tr>
							<th>Nome</th>
							<th>Vocação</th>
							<th>Nível</th>
							<th>Status</th>
							<th class='little'></th>
							<th class='little'></th>
						</tr>
					</thead>
					<tbody>
						<?php
							
							foreach($players as $player) {
								if ($player["online"] == 1) {
									$status = "online";
								} else if ($player["online"] == 0) {
									$status = "offline";
								}
								
								$vocation = getVocation($player["vocation"]);
								
								echo("
									<tr>
										<td>".$player["name"]."</td>
										<td>$vocation</td>
										<td>".$player["level"]."</td>
										<td><span class='$status'>".ucfirst($status)."</span></td>
										<td><img class='icon-button' title='Visualizar Personagem' src='plugins/icon/16/search.png'></td>
										<td><img class='icon-button' title='Deletar' src='plugins/icon/16/cross.png'></td>
									</tr>
								");
							}
						?>
					</tbody>
				</table>
				<? } ?>
				<button id="account-character-create-modal" class="large">Criar novo personagem</button>
			</fieldset>
		</span>
	</span>
	<img src="plugins/img/corner-bl.gif" />
	<img src="plugins/img/corner-br.gif" />
</div>

<div id="account-comprar-pontos-vip" class="box">
	<img src="plugins/img/corner-tl.gif" />
	<img src="plugins/img/corner-tr.gif" />
	<span class="content">
		<h1>Comprar pontos VIP</h1>
		<span class="content">
			<div class="form-item vip">
				<label><strong>Meus pontos VIP: </strong></label><input type="uint" disabled="disabled" value="<?php echo $page->account->getVipPoints(); ?>" /><br />
			</div>
			<div class="form-item vip">
				<label><strong>Dias de conta VIP: </strong></label><input type="uint" disabled="disabled" value="<?php echo $page->account->getVipDays(); ?>" /><br />
			</div>
			<div class="form-item vip">
				<label>Quantidade de pontos VIP que desejo comprar</label><input id="pontos-vip-quantidade" type="uint" value="10" />
			</div>
			
			<span id="account-agora-voce-pode-comprar-pontos-vip" class="msg accept">
				Com suas informações atualizadas agora você pode comprar pontos VIP!<br />
				As informações de endereço são enviadas para o PagSeguro.
			</span>
			
			<a id="please-change-my-value" target="_BLANK" href="account-buy-vip-points.php?10"><button>Comprar pontos</button></a>
			<a href="community-shop.php"><button>Ir para loja</button></a><br />
			<br />
			<strong>Se o botão de compra não estiver funcionando, utilize um desses botões alternativos:</strong><br />
			<!-- INICIO FORMULARIO BOTAO PAGSEGURO -->
			<form class="pagseguro-buttom" target="pagseguro" action="https://pagseguro.uol.com.br/checkout/v2/cart.html?action=add" method="post">
				<input type="hidden" name="itemCode" value="E4AB06471616635FF4567F817FDB87C1" />
				<input type="image" src="https://p.simg.uol.com.br/out/pagseguro/i/botoes/pagamentos/84x35-pagar-preto.gif" name="submit" alt="Pague com PagSeguro - é rápido, grátis e seguro!" />
				<em>Comprar cada 1 ponto por 1 R$</em>
			</form>

			<form class="pagseguro-buttom" target="pagseguro" action="https://pagseguro.uol.com.br/checkout/v2/cart.html?action=add" method="post">
				<input type="hidden" name="itemCode" value="5940056CEFEF300884A65F8FF361DA2A" />
				<input type="image" src="https://p.simg.uol.com.br/out/pagseguro/i/botoes/pagamentos/84x35-pagar-preto.gif" name="submit" alt="Pague com PagSeguro - é rápido, grátis e seguro!" />
				<em>Comprar 50 pontos por 45 R$</em>
			</form>
			
			<form class="pagseguro-buttom" target="pagseguro" action="https://pagseguro.uol.com.br/checkout/v2/cart.html?action=add" method="post">
				<input type="hidden" name="itemCode" value="2C68619D585852E00448EFBDABFC4E74" />
				<input type="image" src="https://p.simg.uol.com.br/out/pagseguro/i/botoes/pagamentos/84x35-pagar-preto.gif" name="submit" alt="Pague com PagSeguro - é rápido, grátis e seguro!" />
				<em>Comprar 100 pontos por 85 $R$</em>
			</form>
			<!-- FINAL FORMULARIO BOTAO PAGSEGURO -->
		</span>
	</span>
	<img src="plugins/img/corner-bl.gif" />
	<img src="plugins/img/corner-br.gif" />
</div>

<div class="box">
	<img src="plugins/img/corner-tl.gif" />
	<img src="plugins/img/corner-tr.gif" />
	<span class="content">
		<h1>Editar informações cadastrais</h1>
		<span class="content">
			<fieldset>
				<legend>Editando conta</legend>
				<label>Nome completo: </label>
				<input maxlength="64" id="account-edit-username" type="text" value="<?php echo $page->account->getUserName(); ?>" />
				<span id="account-edit-username-logtip" class="logtip">
					<span></span>
					<div></div>
				</span>
				<br />
				
				<label title="Esse nome irá ser usado para se apresentar para a comunidade.">Nome Ficticio: </label>
				<input maxlength="64" id="account-edit-codename" type="text" value="<?php echo($page->account->getCodeName()); ?>" />
				<span id="account-edit-codename-logtip" class="logtip">
					<span></span>
					<div></div>
				</span>
				<br />
				
				<label>Gênero: </label>
				<select id="account-edit-gender">
					<option value="1">Masculino</option>
					<option value="0">Feminino</option>
				</select>
				<span id="account-edit-gender-logtip" class="logtip">
					<span></span>
					<div></div>
				</span>
				<br />
				
				<script type="text/javascript">
					$(function(){
						$("#account-edit-gender").val("<?php echo($page->account->getGender()); ?>");
					});
				</script>
				
				<label>E-Mail: </label>
				<input id="account-edit-mail" type="text" placeholder="Exemplo: exemplo@exemplo.com.br" value="<?php echo($page->account->getEmail()); ?>" />
				<span id="account-edit-mail-logtip" class="logtip">
					<span></span>
					<div></div>
				</span>
				<br />
				
				<hr />
				<label>País: </label>
				<select id="account-edit-country">
					<option value="Brasil">Brasil</option>
					<option value="México">México</option>
					<option value="Polônia">Polska</option>
					<option value="Estados Unidos">Unite States</option>
					<option value="Venezuela">Venezuela</option>
					<option value="Canadá">Canada</option>
					<option value="Chile">Chile</option>
					<option value="Austrália">Australia</option>
					<option value="Egito">Egipt</option>
					<option value="Espanha">España</option>
					<option value="Suécia">Sverige</option>
					<option value="Holanda">Netherland</option>
					<option value="Outro">Outro</option>
				</select>
				<span id="account-edit-country-logtip" class="logtip">
					<span></span>
					<div></div>
				</span>
				<br />
				
				<script type="text/javascript">
					$(function(){
						$("#account-edit-country").val("<?php echo($page->account->getPais()); ?>");
					});
				</script>
				
				<label>Linguagem: </label>
				<select id="account-edit-lang">
					<option value="pt-br">Português do Brasil</option>
					<option value="en-us">American English</option>
				</select>
				<span id="account-edit-lang-logtip" class="logtip">
					<span></span>
					<div></div>
				</span>
				<br />
				
				<script type="text/javascript">
					$(function(){
						$("#account-edit-lang").val("<?php echo($page->account->getLang()); ?>");
					});
				</script>
				
				<button id="account-edit-submit" class="large">Cadastrar Õ/</button>
			</fieldset>
		</span>
		<span id="account-edit-login-error-msg" class="msg error"></span>
		<span id="account-edit-pass-error-msg" class="msg error"></span>
		<span id="account-edit-name-error-msg" class="msg error"></span>
		<span id="account-edit-gender-error-msg" class="msg error"></span>
		<span id="account-edit-mail-error-msg" class="msg error"></span>
	</span>
	<img src="plugins/img/corner-bl.gif" />
	<img src="plugins/img/corner-br.gif" />
</div>

<div class="box">
	<img src="plugins/img/corner-tl.gif" />
	<img src="plugins/img/corner-tr.gif" />
	<span class="content">
		<h1>Informações necessarias para ser VIP</h1>
		<span class="content">
			<fieldset>
				<legend>Informações pessoais</legend>
				<i> * Essas informações são vitais apenas se você deseja comprar pontos VIP (elas serão repassadas para o PagSeguro)</i><br />
				<i> * Suas informações pessoais <u>NUNCA</u> serão apresentadas para outros jogadores</i><br />
				<div class="form-item">
					<label>Telefone</label>
					<input type="uint" maxlength="2" id="account-telefone-prefix" value="<?php echo $page->account->getTelPrefixo(); ?>">
					<input type="uint" maxlength="13" id="account-telefone" value="<?php echo $page->account->getTelefone(); ?>" />
				</div>
				<hr />
				<div class="form-item">
					<label>Cep</label><input type="text" maxlength="16" id="account-cep" value="<?php echo $page->account->getCep(); ?>" />
				</div>
				<div class="form-item">
					<label>Rua</label><input type="text" maxlength="64" id="account-rua" value="<?php echo $page->account->getLogr(); ?>" />
				</div>
				<div class="form-item">
					<label>Número</label><input type="text" maxlength="16" id="account-numero" value="<?php echo $page->account->getNumero(); ?>" />
				</div>
				<div class="form-item">
					<label>Complemento</label><input type="text" maxlength="32" id="account-complemento" value="<?php echo $page->account->getCompl(); ?>" />
				</div>
				<div class="form-item">
					<label>Bairro</label><input type="text" maxlength="64" id="account-bairro" value="<?php echo $page->account->getBairro(); ?>" />
				</div>
				<div class="form-item">
					<label>Cidade</label><input type="text" maxlength="64" id="account-cidade" value="<?php echo $page->account->getCidade(); ?>" />
				</div>
				<div class="form-item">
					<label>Estado</label><input type="text" maxlength="2" id="account-estado" value="<?php echo $page->account->getEstado(); ?>" />
				</div>
				<input id="account-premmy-info-save" type="button" class="large" pt-br-value="Atualizar" en-us-value="Update" />
			</fieldset>
		</span>
	</span>
	<img src="plugins/img/corner-bl.gif" />
	<img src="plugins/img/corner-br.gif" />
</div>

<!-- :: MODAL :: responsável por criar um novo personagem -->
<div id="account-create-character" class="background-blocker">
	<div class="modal">
		<div class="form-item">
			<label>Nome</label><input id="account-character-name" type="text" maxlength="25" />
			<span id="account-character-name-logtip" class="logtip">
				<span></span>
				<div id="account-character-name-sublog"></div>
			</span>
		</div>

		<div class="form-item">
			<label></label><a href="#" id="account-character-suggest-name" class="common" pt-br="[Sugerir nome]" en-us="[Suggest name]"></a>
		</div>
		
		<div class="form-item">
			<label>Sexo: </label>
			<select id="account-character-gender">
				<option value='1'>Masculino</option>
				<option value='0'>Feminino</option>
			<select>
			<span id="account-character-gender-logtip" class="logtip">
				<span></span>
				<div></div>
			</span>
		</div>
		
		<div class="form-item">
			<label>Vocação:</label>
			<select id="account-character-vocation">
				<option value='1'>Mage</option>
				<option value='2'>Tribal</option>
				<option value='3'>Elfian</option>
				<option value='4'>Wild</option>
				<option value='5'>Ninja</option>
				<option id="vocations-amazon" value='6'>Amazon</option>
				<option id="vocations-dwarfian" value='7'>Dwarfian</option>
				<!--<option value='8'>Monk</option>-->
			<select>
			<span id="account-character-vocation-logtip" class="logtip">
				<span></span>
				<div></div>
			</span>
		</div>
		<script type="text/javascript">
			$(function(){
				$("#account-character-gender").val("<?php echo $page->account->getGender(); ?>");
				$("#account-character-gender").change();
			});
		</script>
		
		<div class="form-item">
			<label>Cidade</label>
			<select id="account-character-city">
				<option value='1'>Philadelphia (grande)</option>
				<option value='2'>Egito (pequena)</option>
			<select>
			<span id="account-character-city-logtip" class="logtip">
				<span></span>
				<div></div>
			</span>
		</div>
		<br />
		<button id="account-character-create-done" class="large right">Criar</button>
		<button id="account-character-create-cancel" class="large right">Cancelar</button>
	</div>
</div>