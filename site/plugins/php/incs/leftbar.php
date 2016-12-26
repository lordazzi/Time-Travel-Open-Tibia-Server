<?php
	$acc = new Account(@$_SESSION["account"]);
	if ($acc->isLogin()) {
		Page::unpathed("logout.js");
		$bigbottom = "Minha Conta";
		$smallbottom = "Sair";
	} else {
		Page::unpathed("createaccount.js");
		$bigbottom = "Fazer login";
		$smallbottom = "Criar Conta";
	}
?>
			<div id="leftbar">
				<img id="top-image-left" src="plugins/img/server-logo.png" />
				<div id="login-form">
					<img src="plugins/img/box-top.gif" />
					<div>
						<span>
							<button onClick="window.location.href = 'account-login-signup.php';" title="Clique aqui para fazer o login" src="plugins/img/button.gif" /><?php echo($bigbottom); ?></button>
							<a id="leftbar-mini-text" href="javascript:void(0)"><?php echo($smallbottom); ?></a>
						</span>
					</div>
					<img src="plugins/img/box-bottom.gif" />
				</div>
				
				<img class="mainmenu" src="plugins/img/box-top.gif" />
				<span id="mainmenu-group">
					
					
					<div id="mainmenu-1" class="left-hidden">
						<span>
							<img src="plugins/icon/32/news.gif" />
							<label>Notícias</table>
						</span>
						<ul>
							<li onClick="sendto('index.php', this);" title="Conheça as ultimas notícias do servidor!"><label>Notícias Recentes</label></li>
							<!--<li><label pt-br="Arquivo de Notícias" en-us="News Archive"></label></li>-->
						</ul>
					</div>
					
					<!-- <div id="mainmenu-2" class="left-hidden">
						<span>
							<img src="plugins/icon/32/about.gif" />
							<label pt-br="Sobre TT OTS" en-us="About TT OTS"></label>
						</span>
						<ul>
							<li pt-br-title="Saiba porque jogar Time Travel!" en-us-title="Know why you should play Time Travel"><label pt-br="Diferenciais" en-us="Differentials">Diferenciais!</label></li>
							<li><label pt-br="Imagens do Jogo" en-us="Screenshot"></label></li>
							<li><label pt-br="Vantagens VIP" en-us="VIP Features"></label></li>
							<li><label pt-br="Sobre Ovelhas" en-us="About Ovelhas"></label></li>
						</ul>
					</div> -->
					
					<div id="mainmenu-3" class="left-hidden">
						<span>
							<img src="plugins/icon/32/gameguides.gif" />
							<label>Guia do Jogo</label>
						</span>
						<ul>
							<!-- <li><label pt-br="Básico" en-us="Basic"></label></li>
							<li><label pt-br="Manual" en-us="Manual"></label></li>
							<li><label pt-br="Dicas de Segurança" en-us="Security Hints"></label></li> -->
							<li onClick="sendto('gameguide-rules.php', this);" title="Entenda como evitar transtornos."><label>Regras do Servidor</label></li>
						</ul>
					</div>

					<div id="mainmenu-4" class="left-hidden">
						<span>
							<img src="plugins/icon/32/library.gif" />
							<label>Biblioteca</label>
						</span>
						<ul>
							<!-- <li><label pt-br="História" en-us="History"></label></li>
							<li><label pt-br="Criaturas" en-us="Creatures"></label></li>
							<li><label pt-br="Quests!" en-us="Quests!"></label></li> -->
							<li onClick="sendto('library-spells.php', this)"><label>Magias</label></li>
							<li onClick="sendto('library-vocations.php', this);"><label>Vocações</label></li>
							<!-- <li><label pt-br="Mapa" en-us="Map"></label></li> -->
						</ul>
					</div> 
					
					<div id="mainmenu-5" class="left-hidden">
						<span>
							<img src="plugins/icon/32/community.gif" />
							<label>Comunidade</label>
						</span>
						<ul>
							<!-- <li><label pt-br="Quem está Online?" en-us="Who is Online?"></label></li>
							<li><label pt-br="Jogadores" en-us="Players"></label></li>
							<li><label pt-br="Os Melhores" en-us="The Bests"></label></li>
							<li><label pt-br="Guildas" en-us="Guilds"></label></li> -->
							<li onClick="sendto('community-pools.php', this)"><label>Enquetes</label></li>
							<li onClick="sendto('community-ombuds.php', this)"><label>Ouvidoria</label></li>
							<li onClick="sendto('community-shop.php', this)"><label>Loja</label></li>
							<?php
								if ($acc->haveAccess(5)) {
									echo("<li onClick=\"sendto('community-ombuds-man.php', this)\"><label>Ouvidor</label></li>");
								}
							?>
							<!-- <li><label pt-br="Forúm" en-us="Forums"></label></li> -->
						</ul>
					</div>

					<!-- <div id="mainmenu-6" class="left-hidden">
						<span>
							<img src="plugins/icon/32/forum.gif" />
							<label pt-br="Forum" en-us="Forum"></label>
						</span>
						<ul>
							<li><label pt-br="Forum" en-us="Forum"></label></li>
						</ul>
					</div> -->

					<div id="mainmenu-7" class="left-hidden">
						<span>
							<img src="plugins/icon/32/account.gif" />
							<label>Conta</label>
						</span>
						<ul>
							<li onClick="sendto('account-login-signup.php', this);"><label>Minha Conta</label></li>
							<li onClick="sendto('account-download-client.php', this);"><label>Baixar o Client</label></li>
							<li title="Perdeu sua conta? Esqueceu sua senha?"><label>Perdeu sua Conta?</label></li>
							<!-- <li><label pt-br="Lista de banidos" en-us="Banned's List"></label></li> -->
						</ul>
					</div>
				</span>
				<img class="mainmenu" src="plugins/img/box-bottom.gif" />
			</div>
			<div id="content">
				<div class="content">