<?php
# AUTHOR: RICARDO AZZI #
# CREATED: 30/11/12 #

require_once($_SERVER["DOCUMENT_ROOT"]."/plugins/config.php");
$page = new Page(array(
	"logado" => TRUE,
	"js" => TRUE
));

if ($page->account->getCodeName() == "") {
	redirect("community-codename.php?".urlCompile());
}

$page->jsClass("tabs");
$page->jsClass("comments");

$bugs = new Comentarios(array(
	"idtipo" => 3,
	"idparent" => "individual",
	"placeholder" => "Um bug � um defeito do jogo/site, incluindo erros de portugu�s, erros pequenos do mapa e coisas que deixam os layers perturbados (no caso de errors no site, avise em qual navegador o erro ocorreu).",
	"like" => FALSE,
	"addClass" => array( "tab" ),
	"addAttr" => array(
		"selected" => "selected",
		"id" => "community-bugs"
	)
));

$reclamacoes = new Comentarios(array(
	"idtipo" => 4,
	"idparent" => "individual",
	"placeholder" => "Uma reclama��o � quando voc� est� doido de raiva por que alguma incompet�ncia do nosso grupo te atingiu.",
	"like" => FALSE,
	"addClass" => array( "tab" ),
	"addAttr" => array(
		"id" => "community-reclamacoes"
	)
));

$elogios = new Comentarios(array(
	"idtipo" => 5,
	"idparent" => "individual",
	"placeholder" => "Um elogio � quando voc� encontra uma caracter�stica ou mais no servidor que considera muito boa e ent�o decide nos avisar onde foi que acertamos.",
	"like" => FALSE,
	"addClass" => array( "tab" ),
	"addAttr" => array(
		"id" => "community-elogios"
	)
));

$sugestoes = new Comentarios(array(
	"idtipo" => 6,
	"idparent" => "individual",
	"placeholder" => "Uma sugest�o � uma ideia que voc� tem que poderia fazer o servidor melhorar.",
	"like" => FALSE,
	"addClass" => array( "tab" ),
	"addAttr" => array(
		"id" => "community-sugestoes"
	)
));

$observacoes = new Comentarios(array(
	"idtipo" => 7,
	"idparent" => "individual",
	"placeholder" => "Um observa��o � quando o que voc� pretende escrever para n�s n�o se encaixa me nenhuma das categorias anteriores.",
	"like" => FALSE,
	"addClass" => array( "tab" ),
	"addAttr" => array(
		"id" => "community-observacoes"
	)
));
?>

<div class="box">
	<img src="plugins/img/corner-tl.gif" />
	<img src="plugins/img/corner-tr.gif" />
	<span class="content">
		<h1 pt-br="Ouvidoria" en-us="Ombuds"></h1>
		<span class="content">
			<ul class="tabs">
				<li selected="selected" to="community-bugs">Bug (<span id='community-ombuds-bugs'><?=$bugs->getPostsCount()?></span>)</li>
				<li to="community-reclamacoes" pt-br="Reclama��es (<span id='community-ombuds-reclamacoes'><?=$reclamacoes->getPostsCount()?></span>)" en-us="Complaint (<span id='community-ombuds-reclamacoes'><?=$reclamacoes->getPostsCount()?></span>)"></li>
				<li to="community-elogios" pt-br="Elogios (<span id='community-ombuds-elogios'><?=$elogios->getPostsCount()?></span>)" en-us="Compliment (<span id='community-ombuds-elogios'><?=$elogios->getPostsCount()?></span>)"></li>
				<li to="community-sugestoes" pt-br="Sugest�es (<span id='community-ombuds-sugestoes'><?=$sugestoes->getPostsCount()?></span>)" en-us="Suggestion (<span id='community-ombuds-sugestoes'><?=$sugestoes->getPostsCount()?></span>)"></li>
				<li to="community-observacoes" pt-br="Observa��es (<span id='community-ombuds-observations'><?=$sugestoes->getPostsCount()?></span>)" en-us="Observations (<span id='community-ombuds-observations'><?=$sugestoes->getPostsCount()?></span>)"></li>
			</ul>
			
			<div class="tabs">
				<?
					$bugs->generate();
					$reclamacoes->generate();
					$elogios->generate();
					$sugestoes->generate();
					$observacoes->generate();
				?>
			</div>
			
		</span>
	</span>
	<img src="plugins/img/corner-bl.gif" />
	<img src="plugins/img/corner-br.gif" />
</div>