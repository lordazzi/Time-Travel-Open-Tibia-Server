<?
if ($_POST) {
	echo(base64_encode($_POST["tobase64"])."<br />");
}
?>

<form method="POST">
	<input type="text" name="tobase64" />
	<input type="submit" value="Convert To base64" />
</form>