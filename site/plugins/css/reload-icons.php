<?php
# AUTHOR: RICARDO AZZI #
# CREATED: 31/12/12 #
require_once($_SERVER["DOCUMENT_ROOT"]."/plugins/config.php");

$io = new IO();
$arr16 = $io->readDir("../icon/16");
$arr32 = $io->readDir("../icon/32");
$css = ".ico16 {
	display: inline-block;
	width: 16px;
	height: 16px;
}

.ico32 {
	display: inline-block;
	width: 32px;
	height: 32px;
}
";

foreach ($arr16 as $ar) {
	$css .= "
.ico16_".get_file_noext($ar)." {
	.ico16;
	background-image: url('../icon/16/$ar');
}
";
}

foreach ($arr32 as $ar) {
	$css .= "
.ico32_".get_file_noext($ar)." {
	.ico32;
	background-image: url('../icon/32/$ar');
}
";
}

$io->save($css, "icons.css");
echo("ICONES RECARREGADOS");
?>