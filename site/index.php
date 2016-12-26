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
		<h1 pt-br="Notícias Rápidas" en-us="Tickers"></h1>
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
				<img src="plugins/fonts/upper-martel/H.gif" />mmmmm... Eu estava procurando um servidor para jogar, será que esse tal de <em>Time Travel</em>
				é um bom servidor?<br />
				Que tal darmos uma olhada nos diferencias que o Time Travel pode oferecer?<br />
				<img alt="Buga! Turututu..." title="Buga! Turututu..." class="margin right" src="arquivo/arquivo_clipart/akuaku.gif" />
				<br />
				<h3>Uka uka e Aku Aku</h3>
				Você lembra daquelas mascaras flutuantes do Crash? Time Travel é um servidor tão maneiro que até eles resolveram dar uma olhada!
				Uka Uka e Aku Aku não são monstros de respaw, eles são itens de mascara, que quando obtidos, com o clicar da mascara você consegue conjura-los
				para que eles te sirvam.<br />
				<br />
				<br />
				<h3>Novas vocações</h3>
				As vocações do Time Travel são diferentes das do Tibia convencional, você pode analisar as vocações com a última notícia que foi postada,
				assim você terá uma ideia do que escolher para o seu primeiro personagem.<br />
				<br />
				<br />
				<h3>Monstros únicos - feitos com uma criatividade deliciosa</h3>
				<strong> - Lendas</strong><br />
				Contamos com a excepcional presença de <em>El Chupacabra</em>, <em>The Death, Werewolves com seus Half Werewolves</em>.<br />
				<br />
				<strong> - Zumbis</strong><br />
				Depois de alguns estudos na <em>Faculdade de Magia e Tecnologia</em>, uma acidente de um projeto acabou transformando as pessoas envolvidas em
				zumbis. Viajando 1000 anos para o futuro <em>(Porque no nosso servidor você pode viajar no tempo)</em> os zumbis dominam o mundo, gerando um ótimo
				respaw para você!<br />
				<br />
				<img alt="A imagem desse dinossauro faz até o jogo parecer legal." title="A imagem desse dinossauro faz até o jogo parecer legal." class="margin left" src="arquivo/arquivo_clipart/velociraptor.png" />
				<strong> - Dinossauros</strong><br />
				Entrando no vortex do ultimo andar da faculdade, você se encontrará na fenda espacial, um local que te da liberdade de atravessar o tempo e o espaço,
				indo para o passado podemos encontrar uma variedade de Tiranossauros, Velociraptors e outros dinossauros.<br />
				<br />
				<strong> - Animais</strong><br />
				Contamos com o Black Bull, que é o Water Bull do tibia 9.8, mas adaptado ao ambiente de nosso servidor.<br />
				Contamos agora também com nossa amiga Cow, dropando leite! E também nosso amigo Pig e Polar Bear.<br />
				 - Ué, mas o Polar Bear e Pig já são normais do Tibia.... e____é<br />
				 - Sim! Mas os porcos dropam bacon e os ursos polares dropam Coca-Cola!<br />
				<br />
				 - <strong>BACON</strong> e <strong>COCA-COLA</strong>?! São ótimos motivos para jogar o seu servidor! Vou <a href="account-create.php">clicar aqui</a>
				 e criar minha conta agora!
				<br /> <br />
				<br /> <br />
				<br />
				<h3>Você sabe o que é um Dat Editor?</h3>
				Você já ouviu falar do lendário Dat Editor? Um programa antigo que era capaz de alterar as configurações dos itens, outfits, efeitos do Tibia.<br />
				Infelizmente o rapaz que o desenvolvia resolveu parar e isso fez com que os servidores de Tibia parassem de ter as Sprites / Dat editados na
				versão 8.6 (agora entende por que existe milhares de milhares de servidores nessa versão?)<br />
				<br />
				<strong>Ok, o que isso tem haver?</strong> - O líder da nossa equipe (Lord Azzi), ele entende os bytes do DAT e os edita na unha (por isso nosso
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
				Uma ouvidoria é o lugar onde você reclama, dá ideias, fala de bugs, enfim, <strong>todo</strong> o contato que você desejar fazer
				conosco pode ser feito através da ouvidoria.<br />
				Uma das coisas que nosso servidor dá prioridade é as ideias e reclamações dos jogadores.<br />
				Esses itens abaixo são as divisões que nossa ouvidoria foi feita, para facilitar nosso trabalho.<br />
				<br />
				<strong> - Bug:</strong><br />
				<blockquote>
					Um bug é um defeito, seja ele no site ou no servidor, algumas ideias do que pode ser considerado um bug:<br />
					 - Erro de português no site (no caso você deve enviar o link da página com erro de português e indicar o erro);<br />
					 - Erro no mapa que faz com que ele fique feio, desde uma bordazinha fora do lugar até um local não preenchido,
					 ou uma abertura que te permita entrar num lugar que não deveria;<br />
					 - Uma grande area sem respaw;<br />
					 - NPC comprando/vendendo item por um valor sem absurdo (seja para mais ou para menos);<br />
					 - Mal funcionamento de alguma magia, ação, npc, runa, item etc;<br />
					 - Erro de programação no site;<br />
					 - Erro de seguraça no site.<br />
				</blockquote>
				<br />
				<strong> - Reclamações</strong><br />
				<blockquote>
					Uma reclamação é quando alguma situação fez com que você ficasse constrangido, enfurecido ou desanimado com nosso servidor,
					seja isso por consequência de um bug, má administração de um dos GMs ou de uma outra coisa qualquer.
				</blockquote>
				<br />
				<strong> - Elogios</strong><br />
				<blockquote>
					Os elogios são informações importantes por que nos avisam em qual parte estamos indo bem e sabemos que estamos atingindo
					nosso objetivo: satisfazer os jogadores com o nosso servidor.
				</blockquote>
				<br />
				<strong> - Sugestões</strong><br />
				<blockquote>
					Sugestões são ideias que você teve, ou ideias que você viu em algum servidor e gostaria que existisse isso neste servidor,
					ou coisas que nós poderiamos mudar em nosso servidor porque ficaria melhor, alguns exemplos de sugestões:
					 - Um monstro que você criou e gostaria que usassemos;<br />
					 - Uma magia que você criou e gostaria que usassemos;<br />
					 - Uma coisa que poderia haver no site e não tem;<br />
					 - Uma ideia de quest;<br />
					 - Um NPC que você criou e gostaria que usassemos ou uma ideia de um NPC;<br />
					 - Sprites que você criou e gostaria que dessemos uma olhada para adicionar no servidor;<br />
					 - Respaw sem sentido (monstros em excesso ou monstros em falta);<br />
					 - Mudanças na história que contextualiza o servidor.<br />
				</blockquote>
				<br />
				<strong> - Observações</strong><br />
				<blockquote>
					Se você tem alguma coisa para nos dizer e não sabe em qual das categorias acima essa informação se encaixa, então
					ela é uma observação.
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
		<h1 pt-br="Vocações" en-us="Vocations"></h1>
		<span class="content">
			<h2 pt-br="26/11/2012 - <strong>Nossas vocações</strong>" en-us="26/11/2012 - <strong>Our vocations</strong>"></h2>
			<div class="body">
				<img src="plugins/fonts/upper-martel/A.gif" />looha, meus preciosos players! Que tal conhecermos um pouco sobre as diferentes vocações
				de nosso servidor?<br />
				<em>- Sim, nós queremos!</em><br />
				- Perfeito!<br />
				<br />
				<strong>Mage</strong><br />
				Você deve estar pensando: <em>"eu sei o que é um sorcercer"</em>. Mas não, não, aqui no Time Travel é diferente! O mage é um manipuladores
				de magias relacionadas com a temperatura: Fogo e Gelo, também com magias relacionadas a ausencia de luz (o que seria o Mort). São usuarios de Wand.
				Essa vocação é baseada no Mage do Tibia e tem pitadas de Druid. As promoções são <em>Master Mage</em> e depois <em>Ancient Mage</em>.<br />
				<br />
				<strong>Tribal</strong><br />
				O Tribal é a vocação mais antiga da história do servidor, são indios usuários de magias relacionadas a natureza: Eletricidade e manipulação de
				Plantas, usam também alguns magias de luz, mas este não é o foco da vocação. São usuários de Rod. Os Tribais são a mistura de Druids do Tibia
				original com uma pitada de Mage. As promoções são <em>Shaman</em> e depois <em>Forester</em>.<br />
				<br />
				<strong>Elfian</strong><br />
				Esse carinha é muito maneiro, ele é o Paladin do Tibia. Suas promoções são <em>Elder Elfian</em> e depois <em>Golden Arrow</em>.<br />
				<br />
				<strong>Wild</strong><br />
				Wild é o Knight do Tibia. Suas promoções são <em>Viking</em> e depois <em>Gross Viking</em>.<br />
				<br />
				<strong>Ninja</strong><br />
				O ninja é a vocação mais escolhida sempre! Todos adoram ser ninjas, é uma vocação deliciosa. O Ninja basicamente é basicamente um Knight que perde
				um pouco o foco em skills ganhando alguns habilidades magicas que o Knight não tem e mais facilidade em ML. O foco do Ninja é o uso de espada e 
				distância, o uso de outra skill nessa vocação é burrice. Suas promoções são <em>Sword Master</em> e depois <em>Shadow</em><br />
				<br />
				<strong>Amazon</strong><br />
				Amazon é uma vocação exclusivamente feminina, é uma classe que sofre metamorfismo. Amazon uma mistura de pitadas de Knight com pitadas de Paladin.
				Suas promoções são <em>Valkyrie</em> e <em>Witch</em>. Quando uma Amazon se torna Valkyrie, ela se torna uma vocação forte, mas neutra,
				você pode treinar skills, defesa e tem habilidades magicas. Quando uma Valkyrie se torna Witch o foco dela se torna o uso da magia.<br />
				<br />
				<strong>Dwarfian</strong><br />
				O Dwarfian é uma vocação exclusivamente masculina, é baseado no knight do tibia, só que mais bruto: mais capacidade, mais vida, mais defesa
				e sem nenhum uso de magia. Ele só usa machado. Suas promoções são <em>Dwarfian Soldier</em> e depois <em>Dwarfian Warrior</em><br />
				<br />
				<strong>Monk</strong> <em>(Vocação em análise, ela ainda não foi lançada de fato.)</em><br />
				É a vocação mais inutil. Ninguém quer ser ele, coitado. A vocação é focada em magias de cura e magias de auxilio para a batalha. Tem poucas magias
				de ataque. É o único conjurador de Mana Rune. É usuário de Wand. Tem mais mana que as demais classes. Suas promoções são <em>Cleric</em> e
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
				<strong title="'TTOTS' para os íntimos">Time Travel - Open Tibia Server</strong> está no ar!<br />
				<br />
				Olá meus jogadores lindos! Depois de alguns meses trabalhando nesse servidor finalmente nossa equipe conseguiu colocá-lo no ar! - uhu<br />
				<br />
				<h3>Time Travel?</h3>
				<p>Ok, calma! O nome do servidor chegou dessa forma: primeiro nossa equipe, sem muita criatividade para nomes se reuniu para definir um nome,
				no inicio o projeto foi batizado de Animal Open Tibia Server (por que o servidor seria muito animal! D:).<br />
				Como 'Animal' é um nome horrível e sem nexo, foi alterado para Seal Open Tibia Server, depois Panda Open Tibia Server e  então Ovelhas
				Open Tibia Server.... Pffff... Mas no meio das trevas surge uma luz e, um nome foi criado: <em>Time Travel - Open Tibia Server</em>, que significa
				<strong>Viagem no Tempo - Servidor Livre de Tibia</strong>.</p> 
				
				<p>Viagem no Tempo? Seria um servidor 7.9 onde nossos programadores tentam trazer à nostalgia das pessoas que jogaram nessa versão? - Não é isso!
				O servidor tem um forte foco em RPG, consequentemente, o servidor não é só um servidor de Tibia, mas um novo mundo com uma história e baseado nessa
				história surgiu esse nome, segue um trecho da história:</p>
				
				<blockquote><p>"Depois de um longo período de guerra alguns intelectuais se juntam na <em>Universidade de Tecnologia e Magia</em> que fica ao norte
				do continente, o objetivo da união desses gênios foi o desenvolvimento de um computador que fosse capaz de dividir por zero. Depois de muito tempo
				de estudos foi desenvolvido a maquina e no dia de sua inauguração, quando o computador foi ligado e a divisão por zero foi executada, o computador
				explodiu (porque dividir por zero é impossível!) e abriu uma fenda no universo que cruza o tempo e o espaço, te levando para era jurassica ou para
				um apocalipse zumbi.</p>
				<p>Depois de um tempo a Universidade precisou ser abandonada por causa de um outro incidente. Ninguém nunca mais foi lá. - Mentira."</p></blockquote>
				
				<p>Pirô? Time Travel! Seu servidor muito maneiro! <a href="account-create.php">Clique aqui</a> para criar uma nova conta, <a href="account-login-signup.php">clique aqui</a>
				para fazer o login.</p>
			</div>
		</span>
	</span>
	<img src="plugins/img/corner-bl.gif" />
	<img src="plugins/img/corner-br.gif" />
</div>