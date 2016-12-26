$(function(){
	//fazendo a pesquisa
	$("#do-search").on("click", function(){
		var obj = {};
		$("#spells-form input:checked").each(function(){
			eval("obj."+$(this).attr("id")+" = true");
		});
		
		$.ajax({
			type: "POST",
			url: "post/search-spells.php",
			data: obj,
			success: function(retorno){
				eval("retorno = "+retorno);
				
				var results = "";
				var vocall = '<span class="ico16_tibia_sorcererhat" title="Sorcerer"></span>' + 
					'<span class="ico16_tribal" title="Tribal"></span>' + 
					'<span class="ico16_elvish" title="Elfian"></span>' + 
					'<span class="ico16_tibia_warrior_helmet" title="Wild"></span>' + 
					'<span class="ico16_shuriken" title="Ninja"></span>' + 
					'<span class="ico16_amazon" title="Amazon"></span>' + 
					'<span class="ico16_pick" title="Dwarfian"></span>' + 
					'<span class="ico16_tibia_book_3" title="Monk"></span>';
				
				for (i = 0; i < retorno.length; i++) {
					var $voc = "";
					for (j = 0;j < retorno[i].vocation.length; j++) {
						switch(retorno[i].vocation[j]) {
							case "21":
								$voc += '<span class="ico16_tibia_sorcererhat" title="Sorcerer"></span>';
							break;
							
							case "22":
								$voc += '<span class="ico16_tribal" title="Tribal"></span>';
							break;
								
							case "23":
								$voc += '<span class="ico16_elvish" title="Elfian"></span>';
							break;
								
							case "24":
								$voc += '<span class="ico16_tibia_warrior_helmet" title="Wild"></span>';
							break;
								
							case "25":
								$voc += '<span class="ico16_shuriken" title="Ninja"></span>';
							break;
								
							case "26":
								$voc += '<span class="ico16_amazon" title="Amazon"></span>';
							break;
								
							case "27":
								$voc += '<span class="ico16_pick" title="Dwarfian"></span>';
							break;
								
							case "28":
								$voc += '<span class="ico16_tibia_book_3" title="Monk"></span>';
							break;
						}
					}
					
					if (retorno[i].prem == 1) {
						$isvip = "<span class='online'>Sim</a>";
					} else {
						$isvip = "<span class='offline'>Não</a>";
					}
					
					results += "<tr>" + 
							"<td>"+retorno[i].name+"</td>" + 
							"<td>"+retorno[i].words+"</td>" + 
							"<td>"+retorno[i].lvl+"</td>" + 
							"<td> - // - </td>" + // "<td>"+retorno[i].maglv+"</td>" + 
							"<td>"+$voc+"</td>" + 
							"<td>"+$isvip+"</td>" + 
						"</tr>";
				}
				
				$("#search-results").html(results);
				$("#search-results").parents("div.ghost").removeClass("ghost");
			}
		});
	});
	
	// organizando a forma de pesquisa
	$("#voc_sorcerer, #voc_tribal, #voc_elfian, #voc_dwarfian, #voc_ninja, #voc_amazon, #voc_wild, #voc_monk, #voc_all").on("click", function(Event){
		var len = $("#voc_sorcerer:checked, #voc_tribal:checked, #voc_elfian:checked, #voc_dwarfian:checked, #voc_ninja:checked, #voc_amazon:checked, #voc_wild:checked, #voc_monk:checked").length;
		if (len == 0 || len == 8) {
			$("#voc_all").attr("checked", "checked");
			$("#voc_sorcerer, #voc_tribal, #voc_elfian, #voc_dwarfian, #voc_ninja, #voc_amazon, #voc_wild, #voc_monk").removeAttr("checked");
		} else if (Event.toElement.id != "voc_all") {
			$("#voc_all").removeAttr("checked");
		}
	});
});