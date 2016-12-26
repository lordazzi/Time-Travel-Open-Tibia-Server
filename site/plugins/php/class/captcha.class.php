<?php
# AUTHOR: RICARDO AZZI #
# CREATED: 03/11/12 #

class Captcha {
	private $captcha;
	
	public function __construct($id = "", $show = FALSE) {
		$myid = $id;
		$idrefresh = "id='$id-refresh'";
		$txt = "id='$id-text' name='$id-text'";
		if ($id != "") { $id = "id='$id'"; }
		echo("
			<span $id class='captcha'>
				<img src='/plugins/php/captcha.php' />
				<input $txt type='text' />
				<div>
					<img $idrefresh src='plugins/icon/16/refresh.png' />
				</div>
			</span>
		");
		
		if ($show == TRUE) {
			echo("
				<script type='text/javascript'>
					$(function(){
						setTimeout(function(){
							$('#$myid').css('display', 'block');
						}, 2000);
					});
				</script>
			");
		}
		
		$this->captcha = @$_SESSION["palavra"];
	}
	
	public function getCaptcha() { //	deprecated
		return @$_SESSION["palavra"];
	}
	
	public function Match($captcha) {
		if ($captcha == @$_SESSION["palavra"]) {
			return TRUE;
		} else {
			$_SESSION["captcha_tries"] = Captcha::getTries() + 1;
		}
	}
	
	public function getTries() {
		if (isSet($_SESSION["captcha_tries"])) {
			return $_SESSION["captcha_tries"];
		} else {
			return 0;
		}
	}
	
	public function addTry() {
		$_SESSION["captcha_tries"] = Captcha::getTries() + 1;
	}
}

?>