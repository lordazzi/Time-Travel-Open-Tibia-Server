<?php
# AUTHOR: RICARDO AZZI #
# CREATED: 27/12/12 #

require_once($_SERVER["DOCUMENT_ROOT"]."/plugins/config.php");
$page = new Page(array(
	"logado" => TRUE,
	"access" => array(5),
	"js" => TRUE
));
$page->jsClass("tabs");
$page->jsClass("comments");

$bugs = new Comentarios(array(
	"idtipo" => 3,
	"idparent" => get("?"),
	"placeholder" => "Responda aqui para o player.",
	"like" => FALSE,
	"addClass" => array( "tab" ),
	"addAttr" => array(
		"selected" => "selected",
		"id" => "community-bugs"
	)
));

$reclamacoes = new Comentarios(array(
	"idtipo" => 4,
	"idparent" => get("?"),
	"placeholder" => "Responda aqui para o player.",
	"like" => FALSE,
	"addClass" => array( "tab" ),
	"addAttr" => array(
		"id" => "community-reclamacoes"
	)
));

$elogios = new Comentarios(array(
	"idtipo" => 5,
	"idparent" => get("?"),
	"placeholder" => "Responda aqui para o player.",
	"like" => FALSE,
	"addClass" => array( "tab" ),
	"addAttr" => array(
		"id" => "community-elogios"
	)
));

$sugestoes = new Comentarios(array(
	"idtipo" => 6,
	"idparent" => get("?"),
	"placeholder" => "Responda aqui para o player.",
	"like" => FALSE,
	"addClass" => array( "tab" ),
	"addAttr" => array(
		"id" => "community-sugestoes"
	)
));

$observacoes = new Comentarios(array(
	"idtipo" => 7,
	"idparent" => get("?"),
	"placeholder" => "Responda aqui para o player.",
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
				<li to="community-reclamacoes">Reclamações (<span id="community-ombuds-reclamacoes"><?=$reclamacoes->getPostsCount()?></span>)</li>
				<li to="community-elogios">Elogios (<span id="community-ombuds-elogios"><?=$elogios->getPostsCount()?></span>)</li>
				<li to="community-sugestoes">Sugestões (<span id="community-ombuds-sugestoes"><?=$sugestoes->getPostsCount()?></span>)</li>
				<li to="community-observacoes">Observações (<span id="community-ombuds-observations"><?=$observacoes->getPostsCount()?></span>)</li>
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
			<br />
			<a href="community-ombuds-man.php">Voltar para a ouvidoria</a><br />
			<br />
		</span>
	</span>
	<img src="plugins/img/corner-bl.gif" />
	<img src="plugins/img/corner-br.gif" />
</div>