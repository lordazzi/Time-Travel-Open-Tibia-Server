<?php
# AUTHOR: RICARDO AZZI #
# CREATED: 19/09/12 #

require_once($_SERVER["DOCUMENT_ROOT"]."/plugins/config.php");
$sql = new MySql("ttotsite");
$page = new Page();

$tickers = $sql->Query("SELECT a.dtinicio, b.txttitulo, b.txtconteudo, c.txtabrev FROM noticias a
	INNER JOIN noticias_conteudo b
	ON a.idnoticia = b.idnoticia
	INNER JOIN linguagem c
	ON b.idlang = c.idlang
	WHERE a.txttype='rapido' AND NOW() BETWEEN a.dtinicio AND a.dtexpira AND b.isvalido=1");

if ($tickers != FALSE OR $page->account->haveAccess(2)) {
?>
<div class="box">
	<img src="plugins/img/corner-tl.gif" />
	<img src="plugins/img/corner-tr.gif" />
	<span class="content">
		<h1 pt-br="Not�cias R�pidas" en-us="Tickers"></h1>
		<span class="content">
				<table class="tickers" cellspacing="0">
					<tbody>
						<?php
						if ($tickers != FALSE) {
							foreach ($tickers as $ticker) {
								echo('<tr>
										<td style="width: 88px;">'.date("d/m/Y", $ticker["dtinicio"]).' - </td>
										<td maxlength="76" openable="openable">'.$ticker["txtconteudo"].'</td>
									</tr>');
							}
						}
						
						if ($page->account->haveAccess(2)) {
							echo('<tr>
									<td style="width: 88px;">'.date("d/m/Y").' - </td>
									<td><button>Add</button></td>
									<td class="plus-minus"></td>
								</tr>');
						} ?>
						
					</tbody>
				</table>
		</span>
	</span>
	<img src="plugins/img/corner-bl.gif" />
	<img src="plugins/img/corner-br.gif" />
</div>
<?php } ?>

<div class="box">
	<img src="plugins/img/corner-tl.gif" />
	<img src="plugins/img/corner-tr.gif" />
	<span class="content">
		<h1 pt-br="Diferenciais" en-us="Differentials"></h1>
		<span class="content">
			<h2 pt-br="07/12/2012 - <strong>Porque jogar Time Travel?</strong>" en-us="07/12/2012 - <strong>Why should I play Time Travel?</strong>"></h2>
			<div class="body">
				<img src="plugins/fonts/upper-martel/H.gif" />mmmmm... Eu estava procurando um servidor para jogar, ser� que esse tal de <em>Time Travel</em>
				� um bom servidor?<br />
				Que tal darmos uma olhada nos diferencias que o Time Travel pode oferecer?<br />
				<img alt="Buga! Turututu..." title="Buga! Turututu..." class="margin right" src="arquivo/arquivo_clipart/akuaku.gif" />
				<br />
				<h3>Uka uka e Aku Aku</h3>
				Voc� lembra daquelas mascaras flutuantes do Crash? Time Travel � um servidor t�o maneiro que at� eles resolveram dar uma olhada!
				Uka Uka e Aku Aku n�o s�o monstros de respaw, eles s�o itens de mascara, que quando obtidos, com o clicar da mascara voc� consegue conjura-los
				para que eles te sirvam.<br />
				<br />
				<br />
				<h3>Novas voca��es</h3>
				As voca��es do Time Travel s�o diferentes das do Tibia convencional, voc� pode analisar as voca��es com a �ltima not�cia que foi postada,
				assim voc� ter� uma ideia do que escolher para o seu primeiro personagem.<br />
				<br />
				<br />
				<h3>Monstros �nicos - feitos com uma criatividade deliciosa</h3>
				<strong> - Lendas</strong><br />
				Contamos com a excepcional presen�a de <em>El Chupacabra</em>, <em>The Death, Werewolves com seus Half Werewolves</em>.<br />
				<br />
				<strong> - Zumbis</strong><br />
				Depois de alguns estudos na <em>Faculdade de Magia e Tecnologia</em>, uma acidente de um projeto acabou transformando as pessoas envolvidas em
				zumbis. Viajando 1000 anos para o futuro <em>(Porque no nosso servidor voc� pode viajar no tempo)</em> os zumbis dominam o mundo, gerando um �timo
				respaw para voc�!<br />
				<br />
				<img alt="A imagem desse dinossauro faz at� o jogo parecer legal." title="A imagem desse dinossauro faz at� o jogo parecer legal." class="margin left" src="arquivo/arquivo_clipart/velociraptor.png" />
				<strong> - Dinossauros</strong><br />
				Entrando no vortex do ultimo andar da faculdade, voc� se encontrar� na fenda espacial, um local que te da liberdade de atravessar o tempo e o espa�o,
				indo para o passado podemos encontrar uma variedade de Tiranossauros, Velociraptors e outros dinossauros.<br />
				<br />
				<strong> - Animais</strong><br />
				Contamos com o Black Bull, que � o Water Bull do tibia 9.8, mas adaptado ao ambiente de nosso servidor.<br />
				Contamos agora tamb�m com nossa amiga Cow, dropando leite! E tamb�m nosso amigo Pig e Polar Bear.<br />
				 - U�, mas o Polar Bear e Pig j� s�o normais do Tibia.... e____�<br />
				 - Sim! Mas os porcos dropam bacon e os ursos polares dropam Coca-Cola!<br />
				<br />
				 - <strong>BACON</strong> e <strong>COCA-COLA</strong>?! S�o �timos motivos para jogar o seu servidor! Vou <a href="account-create.php">clicar aqui</a>
				 e criar minha conta agora!
				<br /> <br />
				<br /> <br />
				<br />
				<h3>Voc� sabe o que � um Dat Editor?</h3>
				Voc� j� ouviu falar do lend�rio Dat Editor? Um programa antigo que era capaz de alterar as configura��es dos itens, outfits, efeitos do Tibia.<br />
				Infelizmente o rapaz que o desenvolvia resolveu parar e isso fez com que os servidores de Tibia parassem de ter as Sprites / Dat editados na
				vers�o 8.6 (agora entende por que existe milhares de milhares de servidores nessa vers�o?)<br />
				<br />
				<strong>Ok, o que isso tem haver?</strong> - O l�der da nossa equipe (Lord Azzi), ele entende os bytes do DAT e os edita na unha (por isso nosso
				servidor tem sprites editadas e outras coisinhas pequenas maneiras), sem usar programa, em breve vamos desenvolver um DAT Editor, mas pra isso se
				precisa se dinheiro e tempo. (:
			</div>
		</span>
	</span>
	<img src="plugins/img/corner-bl.gif" />
	<img src="plugins/img/corner-br.gif" />
</div>

<div class="box">
	<img src="plugins/img/corner-tl.gif" />
	<img src="plugins/img/corner-tr.gif" />
	<span class="content">
		<h1 pt-br="Ouvidoria" en-us="Ombuds"></h1>
		<span class="content">
			<h2 pt-br="26/11/2012 - <strong>Que tal melhorar nosso servidor?</strong>" en-us="26/11/2012 - <strong>What about make our server the best?</strong>"></h2>
			<div class="body">
				<img src="plugins/fonts/upper-martel/B.gif" />oa Tarde caro jogador!<br />
				Uma ouvidoria � o lugar onde voc� reclama, d� ideias, fala de bugs, enfim, <strong>todo</strong> o contato que voc� desejar fazer
				conosco pode ser feito atrav�s da ouvidoria.<br />
				Uma das coisas que nosso servidor d� prioridade � as ideias e reclama��es dos jogadores.<br />
				Esses itens abaixo s�o as divis�es que nossa ouvidoria foi feita, para facilitar nosso trabalho.<br />
				<br />
				<strong> - Bug:</strong><br />
				<blockquote>
					Um bug � um defeito, seja ele no site ou no servidor, algumas ideias do que pode ser considerado um bug:<br />
					 - Erro de portugu�s no site (no caso voc� deve enviar o link da p�gina com erro de portugu�s e indicar o erro);<br />
					 - Erro no mapa que faz com que ele fique feio, desde uma bordazinha fora do lugar at� um local n�o preenchido,
					 ou uma abertura que te permita entrar num lugar que n�o deveria;<br />
					 - Uma grande area sem respaw;<br />
					 - NPC comprando/vendendo item por um valor sem absurdo (seja para mais ou para menos);<br />
					 - Mal funcionamento de alguma magia, a��o, npc, runa, item etc;<br />
					 - Erro de programa��o no site;<br />
					 - Erro de segura�a no site.<br />
				</blockquote>
				<br />
				<strong> - Reclama��es</strong><br />
				<blockquote>
					Uma reclama��o � quando alguma situa��o fez com que voc� ficasse constrangido, enfurecido ou desanimado com nosso servidor,
					seja isso por consequ�ncia de um bug, m� administra��o de um dos GMs ou de uma outra coisa qualquer.
				</blockquote>
				<br />
				<strong> - Elogios</strong><br />
				<blockquote>
					Os elogios s�o informa��es importantes por que nos avisam em qual parte estamos indo bem e sabemos que estamos atingindo
					nosso objetivo: satisfazer os jogadores com o nosso servidor.
				</blockquote>
				<br />
				<strong> - Sugest�es</strong><br />
				<blockquote>
					Sugest�es s�o ideias que voc� teve, ou ideias que voc� viu em algum servidor e gostaria que existisse isso neste servidor,
					ou coisas que n�s poderiamos mudar em nosso servidor porque ficaria melhor, alguns exemplos de sugest�es:
					 - Um monstro que voc� criou e gostaria que usassemos;<br />
					 - Uma magia que voc� criou e gostaria que usassemos;<br />
					 - Uma coisa que poderia haver no site e n�o tem;<br />
					 - Uma ideia de quest;<br />
					 - Um NPC que voc� criou e gostaria que usassemos ou uma ideia de um NPC;<br />
					 - Sprites que voc� criou e gostaria que dessemos uma olhada para adicionar no servidor;<br />
					 - Respaw sem sentido (monstros em excesso ou monstros em falta);<br />
					 - Mudan�as na hist�ria que contextualiza o servidor.<br />
				</blockquote>
				<br />
				<strong> - Observa��es</strong><br />
				<blockquote>
					Se voc� tem alguma coisa para nos dizer e n�o sabe em qual das categorias acima essa informa��o se encaixa, ent�o
					ela � uma observa��o.
				</blockquote>
				Para ter acesso a ouvidoria <a href="community-ombuds.php">clique aqui</a>
			</div>
		</span>
	</span>
	<img src="plugins/img/corner-bl.gif" />
	<img src="plugins/img/corner-br.gif" />
</div>

<div class="box">
	<img src="plugins/img/corner-tl.gif" />
	<img src="plugins/img/corner-tr.gif" />
	<span class="content">
		<h1 pt-br="Voca��es" en-us="Vocations"></h1>
		<span class="content">
			<h2 pt-br="26/11/2012 - <strong>Nossas voca��es</strong>" en-us="26/11/2012 - <strong>Our vocations</strong>"></h2>
			<div class="body">
				<img src="plugins/fonts/upper-martel/A.gif" />looha, meus preciosos players! Que tal conhecermos um pouco sobre as diferentes voca��es
				de nosso servidor?<br />
				<em>- Sim, n�s queremos!</em><br />
				- Perfeito!<br />
				<br />
				<strong>Mage</strong><br />
				Voc� deve estar pensando: <em>"eu sei o que � um sorcercer"</em>. Mas n�o, n�o, aqui no Time Travel � diferente! O mage � um manipuladores
				de magias relacionadas com a temperatura: Fogo e Gelo, tamb�m com magias relacionadas a ausencia de luz (o que seria o Mort). S�o usuarios de Wand.
				Essa voca��o � baseada no Mage do Tibia e tem pitadas de Druid. As promo��es s�o <em>Master Mage</em> e depois <em>Ancient Mage</em>.<br />
				<br />
				<strong>Tribal</strong><br />
				O Tribal � a voca��o mais antiga da hist�ria do servidor, s�o indios usu�rios de magias relacionadas a natureza: Eletricidade e manipula��o de
				Plantas, usam tamb�m alguns magias de luz, mas este n�o � o foco da voca��o. S�o usu�rios de Rod. Os Tribais s�o a mistura de Druids do Tibia
				original com uma pitada de Mage. As promo��es s�o <em>Shaman</em> e depois <em>Forester</em>.<br />
				<br />
				<strong>Elfian</strong><br />
				Esse carinha � muito maneiro, ele � o Paladin do Tibia. Suas promo��es s�o <em>Elder Elfian</em> e depois <em>Golden Arrow</em>.<br />
				<br />
				<strong>Wild</strong><br />
				Wild � o Knight do Tibia. Suas promo��es s�o <em>Viking</em> e depois <em>Gross Viking</em>.<br />
				<br />
				<strong>Ninja</strong><br />
				O ninja � a voca��o mais escolhida sempre! Todos adoram ser ninjas, � uma voca��o deliciosa. O Ninja basicamente � basicamente um Knight que perde
				um pouco o foco em skills ganhando alguns habilidades magicas que o Knight n�o tem e mais facilidade em ML. O foco do Ninja � o uso de espada e 
				dist�ncia, o uso de outra skill nessa voca��o � burrice. Suas promo��es s�o <em>Sword Master</em> e depois <em>Shadow</em><br />
				<br />
				<strong>Amazon</strong><br />
				Amazon � uma voca��o exclusivamente feminina, � uma classe que sofre metamorfismo. Amazon uma mistura de pitadas de Knight com pitadas de Paladin.
				Suas promo��es s�o <em>Valkyrie</em> e <em>Witch</em>. Quando uma Amazon se torna Valkyrie, ela se torna uma voca��o forte, mas neutra,
				voc� pode treinar skills, defesa e tem habilidades magicas. Quando uma Valkyrie se torna Witch o foco dela se torna o uso da magia.<br />
				<br />
				<strong>Dwarfian</strong><br />
				O Dwarfian � uma voca��o exclusivamente masculina, � baseado no knight do tibia, s� que mais bruto: mais capacidade, mais vida, mais defesa
				e sem nenhum uso de magia. Ele s� usa machado. Suas promo��es s�o <em>Dwarfian Soldier</em> e depois <em>Dwarfian Warrior</em><br />
				<br />
				<strong>Monk</strong> <em>(Voca��o em an�lise, ela ainda n�o foi lan�ada de fato.)</em><br />
				� a voca��o mais inutil. Ningu�m quer ser ele, coitado. A voca��o � focada em magias de cura e magias de auxilio para a batalha. Tem poucas magias
				de ataque. � o �nico conjurador de Mana Rune. � usu�rio de Wand. Tem mais mana que as demais classes. Suas promo��es s�o <em>Cleric</em> e
				depois <em>Illuminated</em>.
			</div>
		</span>
	</span>
	<img src="plugins/img/corner-bl.gif" />
	<img src="plugins/img/corner-br.gif" />
</div>

<div class="box">
	<img src="plugins/img/corner-tl.gif" />
	<img src="plugins/img/corner-tr.gif" />
	<span class="content">
		<h1 pt-br="Novidades" en-us="News"></h1>
		<span class="content">
			<h2 pt-br="17/10/2012 - <strong>Time Travel Open Tibia Server</strong>" en-us="17/10/2012 - <strong>Time Travel Open Tibia Server</strong>"></h2>
			<div class="body">
				<img src="plugins/fonts/upper-martel/O.gif" />k, som... som... 1, 2, 3... som? Testando...<br />
				Perfeito!<br />
				<strong title="'TTOTS' para os �ntimos">Time Travel - Open Tibia Server</strong> est� no ar!<br />
				<br />
				Ol� meus jogadores lindos! Depois de alguns meses trabalhando nesse servidor finalmente nossa equipe conseguiu coloc�-lo no ar! - uhu<br />
				<br />
				<h3>Time Travel?</h3>
				<p>Ok, calma! O nome do servidor chegou dessa forma: primeiro nossa equipe, sem muita criatividade para nomes se reuniu para definir um nome,
				no inicio o projeto foi batizado de Animal Open Tibia Server (por que o servidor seria muito animal! D:).<br />
				Como 'Animal' � um nome horr�vel e sem nexo, foi alterado para Seal Open Tibia Server, depois Panda Open Tibia Server e  ent�o Ovelhas
				Open Tibia Server.... Pffff... Mas no meio das trevas surge uma luz e, um nome foi criado: <em>Time Travel - Open Tibia Server</em>, que significa
				<strong>Viagem no Tempo - Servidor Livre de Tibia</strong>.</p> 
				
				<p>Viagem no Tempo? Seria um servidor 7.9 onde nossos programadores tentam trazer � nostalgia das pessoas que jogaram nessa vers�o? - N�o � isso!
				O servidor tem um forte foco em RPG, consequentemente, o servidor n�o � s� um servidor de Tibia, mas um novo mundo com uma hist�ria e baseado nessa
				hist�ria surgiu esse nome, segue um trecho da hist�ria:</p>
				
				<blockquote><p>"Depois de um longo per�odo de guerra alguns intelectuais se juntam na <em>Universidade de Tecnologia e Magia</em> que fica ao norte
				do continente, o objetivo da uni�o desses g�nios foi o desenvolvimento de um computador que fosse capaz de dividir por zero. Depois de muito tempo
				de estudos foi desenvolvido a maquina e no dia de sua inaugura��o, quando o computador foi ligado e a divis�o por zero foi executada, o computador
				explodiu (porque dividir por zero � imposs�vel!) e abriu uma fenda no universo que cruza o tempo e o espa�o, te levando para era jurassica ou para
				um apocalipse zumbi.</p>
				<p>Depois de um tempo a Universidade precisou ser abandonada por causa de um outro incidente. Ningu�m nunca mais foi l�. - Mentira."</p></blockquote>
				
				<p>Pir�? Time Travel! Seu servidor muito maneiro! <a href="account-create.php">Clique aqui</a> para criar uma nova conta, <a href="account-login-signup.php">clique aqui</a>
				para fazer o login.</p>
			</div>
		</span>
	</span>
	<img src="plugins/img/corner-bl.gif" />
	<img src="plugins/img/corner-br.gif" />
</div>