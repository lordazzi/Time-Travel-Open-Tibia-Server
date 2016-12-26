<?php
$sql = new MySql("ttotsite");
$enquetes = $sql->Query("
	SELECT idenquete, txtptbrpergunta, txtenuspergunta
	FROM enquetes
	WHERE (dtfim IS NULL OR NOW()
	BETWEEN dtinicio AND dtfim) AND isactive=1
	ORDER BY RAND() LIMIT 0 , 1
");

$onlines = $sql->Query("SELECT COUNT(id) AS onlines FROM ttotserver.players WHERE online=1");
?>
				</div>
			</div>
			<div id="rightbar">
				<span class="pedestal">
					<img src="plugins/img/pedestal-and-online.gif" />
					<label> <?php echo($onlines[0]["onlines"]); ?> / 300</label>
				</span>
				<img class="getpremmy" src="plugins/img/premium.gif" />
				<div class="currentpoll" onclick="sendto('community-pool.php?e=<?php echo($enquetes[0]["idenquete"]); ?>');">
					<span class="poll-header">Enquete Atual</span>
					<span class="poll-content" pt-br="<?php echo $enquetes[0]["txtptbrpergunta"]; ?>" en-us="<?php echo($enquetes[0]["txtenuspergunta"]); ?>"></span>
				</div>
				<div class="currentpoll" onclick="sendto('community-ombuds.php');">
					<span class="poll-header">Ouvidoria</span>
					<span class="poll-content">Idéias? Problemas? Reclamações? Fale conosco através de nossa ouvidoria.</span>
				</div>
			</div>
		</div>
	</body>
</html>


<?
$sql = new MySql("otlist");
$sql->Query("SELECT * FROM teste");
?>