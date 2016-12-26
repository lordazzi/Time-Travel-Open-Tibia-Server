<?php
# AUTHOR: RICARDO AZZI #
#  CREATED: 29/12/12   #

require_once($_SERVER["DOCUMENT_ROOT"]."/plugins/config.php");
$page = new Page(array(
	"js" => TRUE,
	"css" => TRUE
));
?>

<div class="box">
	<img src="plugins/img/corner-tl.gif" />
	<img src="plugins/img/corner-tr.gif" />
	<span class="content">
		<h1>Download do Client</h1>
		<span class="content">
			<h2><strong>Escolha onde você deseja fazer o download do Client:</strong></h2>
			<a class="downloader" target="_BLANK" href="http://www.2shared.com/file/rBk7uSIe/Time_Travel_OTC_001.html"><img  title="Baixar client pelo 2shared" src="plugins/img/2shared.png" /></a>
			<a class="downloader" target="_BLANK" href="http://www.4shared.com/rar/jd1ZC3mg/Time_Travel_OTC_001.html?redirectAfterSignout=true"><img title="Baixar client pelo 4shared" src="plugins/img/4shared.png" /></a>
			<a class="downloader" href="http://www.timetravel.net.br/arquivo/clients/Time Travel OTC 0.0.1.rar"><img title="Baixar client pelo site do servidor" src="plugins/img/client-download.png" /></a>
		</span>
	</span>
	<img src="plugins/img/corner-bl.gif" />
	<img src="plugins/img/corner-br.gif" />
</div>