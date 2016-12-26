<?php
# AUTHOR: RICARDO AZZI #
# CREATED: 27/12/12 #

require_once($_SERVER["DOCUMENT_ROOT"]."/plugins/config.php");
$page = new Page(array(
	"js" => TRUE,
	"logado" => TRUE,
	"access" => array(5)
));

$sql = new MySql("ttotsite");
$reclms = $sql->Query("
	SELECT
		a.idcomentario, b.idtipo, b.txttipo, a.idaccount, a.dtcadastro, c.txtcodename, COUNT(d.dtcadastro) as issanado
	FROM comentarios a
	INNER JOIN comentario_tipos b ON a.idtipo = b.idtipo
	INNER JOIN accounts c ON a.idaccount = c.idaccount 
	LEFT JOIN ouvidoria_sanados d ON a.idcomentario = d.idcomentario
	WHERE (a.idtipo = 3 OR a.idtipo = 4 OR a.idtipo = 5 OR a.idtipo = 6) AND a.idparent = a.idaccount
	GROUP BY
		a.idcomentario, b.idtipo, b.txttipo, a.idaccount, a.dtcadastro, c.txtcodename
	ORDER BY d.dtcadastro, a.dtcadastro DESC
");
?>

<div class="box">
	<img src="plugins/img/corner-tl.gif" />
	<img src="plugins/img/corner-tr.gif" />
	<span class="content">
		<h1 pt-br="Ouvidor" en-us="Ombuds Man"></h1>
		<span class="content">
			<table class="common" cellspacing="0">
				<thead>
					<tr>
						<th>Nome:</th>
						<th>Tipo:</th>
						<th>Data:</th>
						<th>Sanado?</th>
					</tr>
				</thead>
				<tbody>
					<?
						if ($reclms <> FALSE) {
							foreach ($reclms AS $reclm) {
								echo("
									<tr>
										<td><a href='community-player-ombuds.php?$reclm[idaccount]'>$reclm[txtcodename]</a></td>
										<td>".$reclm["txttipo"]."</td>
										<td>".date("d/m/Y H:i:s", $reclm["dtcadastro"])."</td>
									");
									if ((bool) $reclm["issanado"] == TRUE) {
										echo("<td><span class='date accept'>Sanado</span></td>");
									} else {
										echo("<td><button class='sanar' idcomentario='$reclm[idcomentario]' title='$reclm[txtcodename]'>Sanar</button></td>");
									}
								echo("</tr>");
							}
						}
					?>
				</tbody>
			</table>
		</span>
	</span>
	<img src="plugins/img/corner-bl.gif" />
	<img src="plugins/img/corner-br.gif" />
</div>