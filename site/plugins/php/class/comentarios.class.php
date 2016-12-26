<?php# AUTHOR: RICARDO AZZI ##  CREATED: 01/12/12   #class Comentarios {	//objetos internos	private $sql;	private $account;		//informações obrigatórias do config	private $idtipo;	private $idparent;	private $placeholder;		//informações opcionais do config	private $addClass;	private $addAttr;		//comentarios que vieram do banco de dados	private $cs;		public function __construct($configs) {		$this->sql = new MySql("ttotsite");		$this->account = new Account($_SESSION["account"]);				$this->idtipo = $configs["idtipo"];		$this->idparent = $configs["idparent"];		$this->placeholder = $configs["placeholder"];				if (count(@$configs["addClass"]) != 0) {			$this->addClass = implode(" ", $configs["addClass"]);		} else {			$this->addClass = "";		}				$this->addAttr = "";		if (count(@$configs["addAttr"]) != 0) {			foreach (@$configs["addAttr"] as $key => $attr) {				$this->addAttr .= " $key='$attr' ";			}		}				if ($this->idparent == "individual") {			$this->cs = $this->sql->Query("				SELECT a.idaccount, a.txtcomentario, a.dtcadastro, b.txtcodename					FROM comentarios a					INNER JOIN accounts b ON a.idaccount = b.idaccount					WHERE a.idtipo=".$this->idtipo." AND idparent=".$this->account->getAccountId()."					ORDER BY dtcadastro DESC			");		} else {			$this->cs = $this->sql->Query("				SELECT a.idaccount, a.txtcomentario, a.dtcadastro, b.txtcodename					FROM comentarios a					INNER JOIN accounts b ON a.idaccount = b.idaccount					WHERE a.idtipo=".$this->idtipo." AND a.idparent=".$this->idparent."					ORDER BY dtcadastro DESC			");		}	}		public function generate() {		$comments = "";		foreach($this->cs AS $c) {			$like = "";			// LIKE E UNLIKE			// if ($this->idparent != "individual" AND $configs["like"] == TRUE) {				// $like .= "					// <span idparent='$this->idparent' idtipo='$this->idtipo' gostei='gostei' class='ico16 ico_curtir left'></span>					// <span idparent='$this->idparent' idtipo='$this->idtipo' naogostei='naogostei' class='ico16 ico_naocurtir left'></span>				// ";			// }			$comments .= "				<div class='comment-container'>					<span class='comment-avatar'></span>					<span class='comment-content'>						<strong class='comment-master-name'>$c[txtcodename]</strong>						<span class='comment-text'>$c[txtcomentario]</span>						<span class='comment-footer'>							$like							<span class='comment-time'>".date("d/m/Y H:i", $c["dtcadastro"])."</span>						<span>					</span>				</div>			";		}				echo("<div class='comments $this->addClass' $this->addAttr>				<div class='comment-container'>					<span class='comment-avatar'></span>					<span class='comment-content'>						<strong class='comment-master-name'>".$this->account->getCodeName()."</strong>						<span class='comment-text'>							<textarea idparent='$this->idparent' idtipo='$this->idtipo' maxlength='3072' placeholder='$this->placeholder'></textarea>							<button class='do-comment' idparent='$this->idparent' idtipo='$this->idtipo'>Comentar</button>						</span>						<span class='comment-footer'>							<span class='comment-time set-time-on-me' class='comment-time'>".date("d/m/Y H:i")."</span>						</span>					</span>				</div>								<span idparent='$this->idparent' idtipo='$this->idtipo' class='grouping-comments'>					$comments				</span>			</div>");	}		public function getPostsCount() {		return count($this->cs);	}}?>