<?php
# AUTHOR: RICARDO AZZI #
#  CREATED: 27/11/12   #

require_once($_SERVER["DOCUMENT_ROOT"]."/plugins/config.php");
$page = new Page();

$p = (int) get("p");
$sql = new MySql("ttotsite");
$enquetes = $sql->Query("
	SELECT a.idenquete, a.txtptbrpergunta, a.txtenuspergunta, a.dtinicio, a.dtfim, COUNT(c.idaccount) as nrrespostas
	FROM enquetes a
	INNER JOIN enquete_opicoes b ON a.idenquete = b.idenquete
	LEFT JOIN enquete_respostas c ON b.idopicao = c.idopicao
	WHERE a.isactive = 1 AND NOW() > a.dtinicio
	GROUP BY a.idenquete, a.txtptbrpergunta, a.txtenuspergunta, a.dtinicio, a.dtfim
	ORDER BY NOW() BETWEEN a.dtinicio AND a.dtfim DESC, a.dtcadastro
	LIMIT $p , 30");
?>

<div class="box">
	<img src="plugins/img/corner-tl.gif" />
	<img src="plugins/img/corner-tr.gif" />
	<span class="content">
		<h1>Enquete</h1>
		<span class="content">
			<table class="common" cellspacing="0">
				<thead>
					<tr>
						<th>Perguntas</th>
						<th>Vencimento</th>
						<th></th>
						<th></th>
					</tr>
				</thead>
				<tbody>
					<?php
						foreach($enquetes as $enquete) {
							$span = "";
							$link = "";
							if ($enquete["dtfim"] == 0) {
								$span = "<span class='date accept'>Eterno</span>";
							} else if ($enquete["dtfim"] <= time()) {
								$span = "<span class='date error'>".date("d/m/Y", $enquete["dtfim"])."</span>";
							} else if ($enquete["dtfim"] > time()) {
								$span = "<span class='bold'>".date("d/m/Y", $enquete["dtfim"])."</span>";
							}
							
							if ($page->account->isLogin() == FALSE) {
								$link = "account-login-signup.php?".base64_encode("community-pool.php?e=$enquete[idenquete]");
								$link = "<a href='$link' title='Você precisa estar logado para acessar as enquetes'>Visualizar</a>";
							} else if ($enquete["dtfim"] <= time()) {
								$link = "<a href='community-pool.php?e=$enquete[idenquete]'>Visualizar</a>";
							} else if (($enquete["dtfim"] > time() OR $enquete["dtfim"] == 0)) {
								$link = "<a href='community-pool.php?e=$enquete[idenquete]'>Responder</a>";
							}
							
							$respostas = "";
							if ($enquete["nrrespostas"] == 1) {
								$respostas = "uma resposta";
							} else {
								$respostas = $enquete["nrrespostas"]." respostas";
							}
							
							echo("
								<tr>
									<td maxlength='75' pt-br='$enquete[txtptbrpergunta]' en-us='$enquete[txtenuspergunta]'></td>
									<td>$span</td>
									<td>$respostas</td>
									<td><a href='community-pool.php?e=$enquete[idenquete]'>$link</a></td>
								</tr>
							");
						}
					?>
				</tbody>
			</table>
		</span>
	</span>
	<img src="plugins/img/corner-bl.gif" />
	<img src="plugins/img/corner-br.gif" />
</div>