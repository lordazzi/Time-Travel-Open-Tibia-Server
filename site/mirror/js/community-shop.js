$(function(){
	$(".shop span.bag:not(.disabled)").on("click", function(){
		$("#in-bag-buy").attr("itemid", $(this).parents("tr").attr("id"));
		$("#in-bag-buy").css("display", "block");
		$("#in-bag-buy div.modal").animate({
			opacity: 1
		}, 500);
	});
	
	$(".shop span.backpack:not(.disabled)").on("click", function(){
		$("#in-backpack-buy").attr("itemid", $(this).parents("tr").attr("id"));
		$("#in-backpack-buy").css("display", "block");
		$("#in-backpack-buy div.modal").animate({
			opacity: 1
		}, 500);
	});
	
	$(".alone").on("click", function(){
		//	selecionando
		var $selected = $(this).parents("tr");
		
		//	removendo as imagens e colocando o botão alone como checado
		$(this).addClass("ico16_action_check");
		$selected.find("span.bag").css("background-image", "");
		$selected.find("span.backpack").css("background-image", "");
		
		//	mudando a informação no botão
		$selected.find(".comprar").removeAttr("select");
		
		//	mudando o preço que é exibido
		$selected.find("[preco]").text(number_format($selected.find("[preco]").attr("preco"), 2, ",", ".")+" pts");
	});
	
	//	trabalhando com o modal de mochila e bag
	$("#bag-cancel, #backpack-cancel").on("click", function(){
		var me = this;
		
		//	Mochila/Sacola de fundo
		$(this).parents("div.modal").animate({
			opacity: 0
		}, 500);
		setTimeout(function(){
			$(me).parents(".background-blocker").css("display", "none");
			$(me).parents(".background-blocker").removeAttr("itemid");
		}, 500);
		$(".selected").removeClass("selected");
	});
	
	//	trabalhando com o modal de mochila e bag
	$("#bag-select, #backpack-select").on("click", function(){
		var me = this;
		//	qual mochila/secola foi escolhida?
		var idcontainer = $(this).parents("div.modal").find(".selected").attr("id");
		
		if (idcontainer != null) {
			//	é uma mochila ou sacola?
			var idtype = $(this).attr("id");
			idtype = idtype.replace("-select", "");
			
			//	A qual item selecionado esta sacola/mochila é destinado?
			var selected = $("#in-"+idtype+"-buy").attr("itemid");
			
			//	Mochila/Sacola de fundo
			$("#"+selected+" .alone").removeClass("ico16_action_check");
			$("#"+selected+" .container-selector").css("background-image", "");
			$("#"+selected+" .container-selector."+idtype).css("background-image", "url('"+$(".selected img").attr("src")+"')");
			
			//	Habilitando botão de compra
			$("#"+selected+" .comprar[disabled='disabled']").removeAttr("disabled");
			$("#"+selected+" .comprar").attr("select", idcontainer);
			
			//	Alterando valor do produto
			$me = $("#"+selected+" td[preco]");
			$promocao = $me.attr("promocao");
			if (idtype == "bag") {
				if ($promocao == null) {
					$me.text(number_format(($me.attr("preco") * 8), 2, ",", ".")+" pts");
				} else {
					var normal = number_format(($me.attr("preco") * 8), 2, ",", ".")+" pts";
					var promocao = number_format(($me.attr("promocao") * 8), 2, ",", ".")+" pts";
					$me.html("<span class='promotion'>de "+normal+"</span><br /><em class='promotion'>por "+promocao+"</em>");
				}
			} else if (idtype == "backpack") {
				if ($promocao == null) {
					$me.text(number_format(($me.attr("preco") * 20), 2, ",", ".")+" pts");
				} else {
					var normal = number_format(($me.attr("preco") * 20), 2, ",", ".")+" pts";
					var promocao = number_format(($me.attr("promocao") * 20), 2, ",", ".")+" pts";
					$me.html("<span class='promotion'>de "+normal+"</span><br /><em class='promotion'>por "+promocao+"</em>");
				}
			} else {
				if ($promocao == null) {
					$me.text($me.attr("preco")+" pts");
				} else {
					var normal = number_format($me.attr("preco"), 2, ",", ".")+" pts";
					var promocao = number_format($me.attr("promocao"), 2, ",", ".")+" pts";
					$me.html("<span class='promotion'>de "+normal+"</span><br /><em class='promotion'>por "+promocao+"</em>");
				}
			}
			
			//	Fechando a modal
			$(this).parents("div.modal").animate({
				opacity: 0
			}, 500);
			setTimeout(function(){
				$(me).parents(".background-blocker").css("display", "none");
				$(me).parents(".background-blocker").removeAttr("itemid");
			}, 500);
			$(".selected").removeClass("selected");
		}
	});
	
	$(".chooser span").on("click", function(){
		//	Exercendo a seleção
		$(".chooser span").removeClass("selected");
		$(this).addClass("selected");
	});
	
	//	trabalhando com o modal de seleção de jogador
	//	Botão de compra
	$("button.comprar").on("click", function(){
		//	que item está sendo comprado e como?
		var item = $(this).attr("item");
		var select = $(this).attr("select");
		
		$("#choose-character").attr("item", item);
		$("#choose-character").attr("select", select);
		$("#choose-character").css("display", "block");
		$("#choose-character div.modal").animate({
			opacity: 1
		}, 500);
	});
	
	$("#player-cancel").on("click", function(){
		var me = this;
		
		$(this).parents("div.modal").animate({
			opacity: 0
		}, 500);
		setTimeout(function(){
			$(me).parents(".background-blocker").css("display", "none");
			$(me).parents("#choose-character").removeAttr("select");
			$(me).parents("#choose-character").removeAttr("item");
		}, 500);
	});
	
	$("#player-select").on("click", function(){
		var me = this;
		$("#player-select").attr("disabled", "disabled");
		$("#player-cancel").attr("disabled", "disabled");
		$("#character-selected").after("<img class='progressbar' src='plugins/img/progress.gif' style='width: 230px;' />");
		$(me).parents("div.modal").css("height", "90px");
		
		$.ajax({
			url: "post/do-buy-item.php",
			type: "post",
			data: {
				item: $("#choose-character").attr("item"),
				select: $("#choose-character").attr("select"),
				player: $("#character-selected").val()
			},
			success: function(retorno) {
				eval("var retorno = "+retorno);
				$("#player-select").removeAttr("disabled");
				$("#player-cancel").removeAttr("disabled");
				$(".progressbar").remove();
				$(me).parents("div.modal").css("height", "80px");
				if (retorno.success == true) {
					$("#quantidade-de-pontos").text(retorno.valor+" pts");
					
					$("#choose-character").children("div.modal").animate({
						opacity: 0
					}, 500);
					setTimeout(function(){
						$("#choose-character").css("display", "none");
						alert(retorno.msg);
					}, 500);
				} else {
					alert(retorno.msg);
				}
				
			}
		});
	});
});