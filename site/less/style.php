<?php
require_once("lessphp-0.3.8/lessphp/lessc.inc.php");
header("Content-type: text/css");
if ($_SERVER["QUERY_STRING"]) {
	$less = new lessc;
	$file = base64_decode($_SERVER["QUERY_STRING"]);
	$ext = explode(".", $file);
	if ($ext[count($ext) - 1] == "css" OR $ext[count($ext) - 1] == "less" OR substr($file, "ricardoazzi") !== FALSE) {
		echo $less->compile(file_get_contents($file));
	} else {
		exit();
	}
} else {
	exit();
}
?>