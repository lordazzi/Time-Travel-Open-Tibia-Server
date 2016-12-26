<?php
# AUTHOR: RICARDO AZZI #
#  CREATED: 27/11/12   #

require_once($_SERVER["DOCUMENT_ROOT"]."/plugins/config.php");
$page = new Page(array(
	"logado" => TRUE,
	"js" => TRUE,
	"css" => TRUE
));
if ($page->account->getCodeName() == "") {
	redirect("community-codename.php?".urlCompile());
}
$page->jsClass("comments");
$sql = new MySql("ttotsite");

$e = get("e");
$enquete = $sql->Query("
	SELECT idenquete, txtptbrpergunta, txtenuspergunta, ismulti, dtinicio, dtfim
	FROM enquetes
	WHERE isactive=1 AND idenquete=$e
");

$opicoes = $sql->Query("
	SELECT a.idopicao, a.txtopicao, COUNT(b.idaccount) AS isrespondido
	FROM enquete_opicoes a 
	LEFT JOIN enquete_respostas b ON a.idopicao = b.idopicao AND b.idaccount = ".$page->account->getAccountId()."
	WHERE a.idenquete=$e
	GROUP BY a.idopicao, a.txtopicao
");


$jarespondeu = FALSE;
foreach($opicoes AS $opicao) {
	if ($opicao["isrespondido"] == TRUE) {
		$jarespondeu = TRUE;
	}
}

if (@$enquete["dtfim"] <= time() OR $page->account->isLogin() == FALSE) {
	$justsee = "Visualizar";
} else if (($enquete["dtfim"] > time() OR $enquete["dtfim"] == 0) AND $page->account->isLogin() == TRUE) {
	$justsee = "Responder";
}
?>

<div class="box">
	<img src="plugins/img/corner-tl.gif" />
	<img src="plugins/img/corner-tr.gif" />
	<span class="content">
		<h1 pt-br="Enquete" en-us="Pool"></h1>
		<span class="content">
			<span class="pool">
				<?php
					$enquete = $enquete[0];
					if (!($enquete["dtinicio"] < time() AND time() < $enquete["dtfim"]) AND $enquete["dtfim"] <> FALSE) {
						$jarespondeu = TRUE;
					}

					if (count($enquete) == 0) {
						echo("<span style='display:block;' class='msg error'>A enquete foi desativada ou nunca existiu. <a href='".System::getComeFrom()."'>Voltar</a></span>");
					} else {
						echo("<strong pt-br='$enquete[txtptbrpergunta]' en-us='$enquete[txtenuspergunta]'></strong>
						<ol>");
						foreach($opicoes as $opicao) {
							if ($jarespondeu == TRUE) {
								if ($opicao["isrespondido"] == TRUE) {
									echo("<li><span class='ico16 ico16_action_check'></span>$opicao[txtopicao]</li>");
								} else {
									echo("<li><span class='ico16'></span>$opicao[txtopicao]</li>");
								}
							} else {
								if ($enquete["ismulti"] == FALSE) {
									echo("<li><input type='radio' name='enquete$e' value='$opicao[idopicao]' />$opicao[txtopicao]</li>");
								} else {
									echo("<li><input type='checkbox' name='enquete".$e.$opicao["idopicao"]."' value='$opicao[idopicao]' />$opicao[txtopicao]</li>");
								}
							}
						}
						
						echo("</ol><br />
						<button id='community-pool-submit' pt-br='Responder' en-us='Reply'></button>");
					}
				?>
			</span>
			<?
				if ($jarespondeu == TRUE) {
					$c = new Comentarios(array(
						"idtipo" => 2,
						"idparent" => $e,
						"like" => TRUE,
						"placeholder" => "Complemente sua resposta."
					));
					$c->generate();
				}
			?>
		</span>
	</span>
	<img src="plugins/img/corner-bl.gif" />
	<img src="plugins/img/corner-br.gif" />
</div>