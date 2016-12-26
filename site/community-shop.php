<?php
# AUTHOR: RICARDO AZZI #
#  CREATED: 20/01/13   #

require_once($_SERVER["DOCUMENT_ROOT"]."/plugins/config.php");
$page = new Page(array(
	"css" => TRUE,
	"js" => TRUE,
	"logado" => TRUE
));

$acc = new Account(@$_SESSION["account"]);
$site = new MySql("ttotsite");
$server = new MySql("ttotserver");
$pontos = $site->Query("SELECT nrvippoints FROM accounts_vipinformacao WHERE idaccount = '".$acc->getAccountId()."'");
$pontos = $pontos[0]["nrvippoints"];
?>

<div class="box">
	<img src="plugins/img/corner-tl.gif" />
	<img src="plugins/img/corner-tr.gif" />
	<span class="content">
		<h1>Compre pontos vip!</h1>
		<span class="content">
			<h2><strong>Compre pontos VIP!</strong></h2>
			<strong>Ajude-nos a manter o servidor no ar! :D</strong>
		</span>
	</span>
	<img src="plugins/img/corner-bl.gif" />
	<img src="plugins/img/corner-br.gif" />
</div>

<div class="box">
	<img src="plugins/img/corner-tl.gif" />
	<img src="plugins/img/corner-tr.gif" />
	<span class="content">
		<h1><strong>Loja de items</strong></h1>
		<span class="content">
			<?php
				
				//	bloco de processamento
				function getPlural($value) {
					if ($value == 1) {
						return "";
					} else {
						return "s";
					}
				}
				
				//ORGANIZANDO AS CATEGORIAS
				$categorias = $site->Query("SELECT idcategoria, txtnome FROM market_categorias WHERE isactive=1 ORDER BY nrposicao");
				foreach($categorias as $categoria) {
					echo("<h2><strong>$categoria[txtnome]</strong></h2>");
					//selecionando os itens vendiveis
					$items = $site->Query("
						SELECT
							idmarketitem, vlpreco, vlnovopreco,
							dtpromotion, txtnome, txtdescricao, txtimg, nriditem,
							nramountperspace, isonlyone, isbag, isbackpack
						FROM
							market_items
						WHERE
							idcategoria = $categoria[idcategoria] AND isactive = 1
					");
					
					echo("
						<div class='body'>
							<table class='common' cellspacing='0'>
								<thead>
									<tr>
										<th>Item</th>
										<th style='width: 90px;'>Valor</th>
										<th>Opções</th>
										<th>Descrição</th>
										<th></th>
									</tr>
								</thead>
								<tbody>");
					
					//	ORGANIZANDO OS ITENS DENTRO DAS CATEGORIAS
					foreach ($items as $item) {
						$classes = array();
						//	colocando as opções dos itens em ordem
						if ($item["isonlyone"] == FALSE) {
							$classes["isonlyone"] = "disabled";
							if ($item["idmarketitem"] <> 1 AND $item["idmarketitem"] <> 18) { //premmy account
								$classes["comprar"] = " disabled='disabled'";
							}
						} else {
							$classes["isonlyone"] = "ico16_action_check";
							$classes["comprar"] = "";
						}
						
						if ($item["isbag"] == FALSE) {
							$classes["isbag"] = "disabled";
						} else {
							$classes["isbag"] = "";
						}
						
						if ($item["isbackpack"] == FALSE) {
							$classes["isbackpack"] = "disabled";
						} else {
							$classes["isbackpack"] = "";
						}
						
						//	formando o preço
						$preco = "";
						$title = "";
						
						//	atributos de preço, para manipulação via javascript
						$price_attr = " preco='$item[vlpreco]' ";
						
						//	verificando se é ou não uma profissão
						$item["vlpreco"] = number_format($item["vlpreco"], 2, ",", ".");
						$item["vlnovopreco"] = number_format($item["vlnovopreco"], 2, ",", ".");
						$promotion_expired = (time() <= $item["dtpromotion"]);
						
						if ($item["vlnovopreco"] <> FALSE AND $item["dtpromotion"] <> FALSE AND $promotion_expired <> FALSE) {
							$preco = "$item[vlpreco] pt".getPlural($item["vlpreco"]);
							$preco = "
								<span class='promotion'>de $preco</span><br />
								<em class='promotion'>por $item[vlnovopreco] pt".getPlural($item["vlnovopreco"])."</em>
							";
							$title = " title='A promoção será encerrada em ".date("d/m/Y", $item["dtpromotion"])."' ";
							$price_attr .= "promocao='".str_replace(",", ".", $item["vlnovopreco"])."' ";
						} else {
							//	preço sendo apresentado da forma normal
							$preco = "$item[vlpreco] pt".getPlural($item["vlpreco"]);
						}
						
						//	o kit de itens já vem em uma sacola, por isso o preço não pode ser alterado quando uma sacola for selecionada
						$block_change_price = "";
						if ($item["idmarketitem"] == 17) {
							$block_change_price = " changeprice='false' ";
						}
						
						echo("
							<tr id='item-$item[idmarketitem]' class='shop'>
								<td style='text-align: center;'><img src='arquivo/shop_items/$item[txtimg]' alt='$item[txtnome]' title='$item[txtnome]' /></td>
								<td $title $block_change_price $price_attr style='text-align: center;'>$preco</td>
								<td>
									<span class='container-container-selector'>
										<span title='Uma unidade deste item' class='container-selector alone $classes[isonlyone]'></span>
										<span title='Com essa opção você compra 8 unidades deste item, dentro de uma bag da sua escolha' class='container-selector bag $classes[isbag]'></span>
										<span title='Com essa opção você compra 20 unidade deste item, dentro de uma backpack da sua escolha' class='container-selector backpack $classes[isbackpack]'></span>
									</span><br />
								</td>
								<td $title><strong>$item[txtnome]:</strong> $item[txtdescricao]</td>
								<td><button ".@$classes["comprar"]." item='$item[idmarketitem]' class='comprar'>Comprar</button></td>
							</tr>
						");
					}
						echo("</tbody>
						</table>
					</div>");
				}
			?>
		</span>
	</span>
	<img src="plugins/img/corner-bl.gif" />
	<img src="plugins/img/corner-br.gif" />
</div>

<!-- :: MODAL :: escolher a mochila / bag em que seu item será comprado -->
<div id="in-bag-buy" class="background-blocker">
	<div class="modal chooser">
		<em>Este item tem a opção de ser comprado em oito unidades, comprando oito unidades deste item você pode escolher em qual bag ele será entregue.</em>
		<div class="chooser">
			<span id="bag-0">
				<img src='arquivo/shop_items/bags/bag.gif' title='Bag' />
			</span>
			
			<span id="bag-1">
				<img src='arquivo/shop_items/bags/blue bag.gif' title='Blue Bag' />
			</span>
			
			<span id="bag-2">
				<img src='arquivo/shop_items/bags/golden bag.gif' title='Golden Bag' />
			</span>
			
			<span id="bag-3">
				<img src='arquivo/shop_items/bags/gray bag.gif' title='Gray Bag' />
			</span>
			
			<span id="bag-4">
				<img src='arquivo/shop_items/bags/green bag.gif' title='Green Bag' />
			</span>
			
			<span id="bag-5">
				<img src='arquivo/shop_items/bags/orange bag.gif' title='Orange Bag' />
			</span>
			
			<span id="bag-6">
				<img src='arquivo/shop_items/bags/purple bag.gif' title='Purple Bag' />
			</span>
			
			<span id="bag-7">
				<img src='arquivo/shop_items/bags/red bag.gif' title='Red Bag' />
			</span>
			
			<span id="bag-8">
				<img src='arquivo/shop_items/bags/yellow bag.gif' title='Yellow Bag' />
			</span>
			
			<span id="bag-9">
				<img src='arquivo/shop_items/bags/pirate bag.gif' title='Pirate Bag' />
			</span>
			
			<span id="bag-10">
				<img src='arquivo/shop_items/bags/camouflage bag.gif' title='Camouflage Bag' />
			</span>
			
			<span id="bag-11">
				<img src='arquivo/shop_items/bags/beach bag.gif' title='Beach Bag' />
			</span>
			
			<span id="bag-12">
				<img src='arquivo/shop_items/bags/fur bag.gif' title='Fur Bag' />
			</span>
			
			<span id="bag-13">
				<img src='arquivo/shop_items/bags/expedition bag.gif' title='Expedition Bag' />
			</span>
			
			<span id="bag-14">
				<img src='arquivo/shop_items/bags/brocade bag.gif' title='Brocade Bag' />
			</span>
		</div>
		<br />
		<button id="bag-select" class="large right">Escolher</button>
		<button id="bag-cancel" class="large right">Cancelar</button>
	</div>
</div>

<div id="in-backpack-buy" class="background-blocker">
	<div class="modal chooser">
		<em>Este item tem a opção de ser comprado em vinte unidades, comprando vinte unidades deste item você pode escolher em qual backpack ele será entregue.</em>
		<div class="chooser">
			<span id="bps-0">
				<img src='arquivo/shop_items/bps/backpack.gif' title='Backpack' />
			</span>
			
			<span id="bps-1">
				<img src='arquivo/shop_items/bps/blue backpack.gif' title='Blue Backpack' />
			</span>
			
			<span id="bps-2">
				<img src='arquivo/shop_items/bps/golden backpack.gif' title='Golden Backpack' />
			</span>
			
			<span id="bps-3">
				<img src='arquivo/shop_items/bps/gray backpack.gif' title='Gray Backpack' />
			</span>
			
			<span id="bps-4">
				<img src='arquivo/shop_items/bps/green backpack.gif' title='Green Backpack' />
			</span>
			
			<span id="bps-5">
				<img src='arquivo/shop_items/bps/orange backpack.gif' title='Orange Backpack' />
			</span>
			
			<span id="bps-6">
				<img src='arquivo/shop_items/bps/purple backpack.gif' title='Purple Backpack' />
			</span>
			
			<span id="bps-7">
				<img src='arquivo/shop_items/bps/red backpack.gif' title='Red Backpack' />
			</span>
			
			<span id="bps-8">
				<img src='arquivo/shop_items/bps/yellow backpack.gif' title='Yellow Backpack' />
			</span>
			
			<span id="bps-9">
				<img src='arquivo/shop_items/bps/pirate backpack.gif' title='Pirate Backpack' />
			</span>
			
			<span id="bps-10">
				<img src='arquivo/shop_items/bps/santa backpack.gif' title='Santa Backpack' />
			</span>
			
			<span id="bps-11">
				<img src='arquivo/shop_items/bps/anniversary backpack.gif' title='Anniversary Backpack' />
			</span>
			
			<span id="bps-12">
				<img src='arquivo/shop_items/bps/backpack of holding.gif' title='Backpack of Holding' />
			</span>
			
			<span id="bps-13">
				<img src='arquivo/shop_items/bps/camouflage backpack.gif' title='Camouflage Backpack' />
			</span>
			
			<span id="bps-14">
				<img src='arquivo/shop_items/bps/beach backpack.gif' title='Beach Backpack' />
			</span>
			
			<span id="bps-15">
				<img src='arquivo/shop_items/bps/expedition backpack.gif' title='Expedition Backpack' />
			</span>
			
			<span id="bps-16">
				<img src='arquivo/shop_items/bps/buggy backpack.gif' title='Buggy Backpack' />
			</span>
			
			<span id="bps-17">
				<img src='arquivo/shop_items/bps/brocade backpack.gif' title='Brocade Backpack' />
			</span>
			
			<span id="bps-18">
				<img src='arquivo/shop_items/bps/bull backpack.gif' title='Bull Backpack' />
			</span>
			
			<span id="bps-19">
				<img src='arquivo/shop_items/bps/black face ox backpack.gif' title='Black Face Ox Backpack' />
			</span>
			
			<span id="bps-20">
				<img src='arquivo/shop_items/bps/chinese backpack.gif' title='Chinese Backpack' />
			</span>
			
			<span id="bps-21">
				<img src='arquivo/shop_items/bps/crown backpack.gif' title='Crown Backpack' />
			</span>
			
			<span id="bps-22">
				<img src='arquivo/shop_items/bps/crystal backpack.gif' title='Crystal Backpack' />
			</span>
			
			<span id="bps-23">
				<img src='arquivo/shop_items/bps/deepling backpack.gif' title='Deepling Backpack' />
			</span>
			
			<span id="bps-24">
				<img src='arquivo/shop_items/bps/fur backpack.gif' title='Fur Backpack' />
			</span>
			
			<span id="bps-25">
				<img src='arquivo/shop_items/bps/heart backpack.gif' title='Amazon Backpack' />
			</span>
			
			<span id="bps-26">
				<img src='arquivo/shop_items/bps/jewelled backpack.gif' title='Jewelled Backpack' />
			</span>
			
			<span id="bps-27">
				<img src='arquivo/shop_items/bps/moon backpack.gif' title='Moon Backpack' />
			</span>
			
			<span id="bps-28">
				<img src='arquivo/shop_items/bps/mushroom backpack.gif' title='Mushroom Backpack' />
			</span>
		</div>
		<br />
		<button id="backpack-select" class="large right">Escolher</button>
		<button id="backpack-cancel" class="large right">Cancelar</button>
	</div>
</div>

<div id="choose-character" class="background-blocker">
	<div class="modal" style="width: 235px; height: 80px;">
		<em style="font-size: 11px">Selecione o personagem:</em>
		<div>
			<select id="character-selected">
				<?php
					$players = $server->Query("SELECT id, name FROM players WHERE account_id=".$acc->getAccountId());
					foreach ($players as $player) {
						echo("<option id='$player[name]'>$player[name]</option>");
					}
				?>
			</select>
			<br />
			<button id="player-select" class="large right">Concluir</button>
			<button id="player-cancel" class="large right">Cancelar</button>
		</div>
	</div>
</div>

<div id="quantidade-de-pontos"><?php echo($pontos); ?> pts</div>