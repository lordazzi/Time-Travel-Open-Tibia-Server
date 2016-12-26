/*
	# AUTHOR: RICARDO AZZI #
	# CREATED: 01/12/12 #
*/
var Comments = (function(callback){
	if (callback == null) { callback = function(){}; }
	if ($(".comments").length != 0) {
		var time_from_txt = $(".set-time-on-me").eq(0).text().split(" ");
		var date = time_from_txt[0].split("/");
		var hour = time_from_txt[1].split(":");
		
		var server_time = new Date();
		server_time.setDate(date[0]);
		server_time.setMonth(date[1]-1);
		server_time.setFullYear(date[2]);
		server_time.setHours(hour[0]);
		server_time.setMinutes(hour[1]);
		
		server_time = server_time.getTime();
		var initial_time = new Date().getTime(); 
		var adjustTime = (function(){
			setTimeout(function(){
				var time = new Date(new Date().getTime() - initial_time + server_time);
				
				var dia = rightZero(time.getDate());
				var mes = rightZero(time.getMonth()+1);
				var ano = rightZero(time.getFullYear());
				var horas = rightZero(time.getHours());
				var mins = rightZero(time.getMinutes());
				
				
				time = dia+"/"+mes+"/"+ano+" "+horas+":"+mins;
				$(".set-time-on-me").text(time);
				adjustTime();
			}, 750);
		});
		adjustTime();
		
		$(".do-comment[idparent][idtipo]").on("click", function(){
			var identificator = "[idparent='"+$(this).attr("idparent")+"'][idtipo='"+$(this).attr("idtipo")+"']";
			var clicaram_em_mim = $(this);
			$.ajax({
				type: "POST",
				url: "post/do-comment.php",
				data: {
					txtcomentario: $(".comment-text textarea"+identificator).val(),
					idparent: $(this).attr("idparent"),
					tipo: $(this).attr("idtipo")
				},
				success: function(retorno){
					eval("retorno = "+retorno);
					if (retorno.success == true) {
						$("<div style='opacity: 0' class='comment-container'>" + 
							"<span class='comment-avatar'></span>" + 
							"<span class='comment-content'>" + 
								"<strong class='comment-master-name'>"+retorno.master+"</strong>" + 
								"<span class='comment-text'>"+retorno.txtcomentario+"</span>" + 
								"<span class='comment-footer'>" + 
									"<span class='comment-time'>"+retorno.time+"</span>" + 
								"</span>" + 
							"</span>" + 
						"</div>").prependTo(".grouping-comments"+identificator);
						$("div.comment-container[style='opacity: 0']").animate({
							opacity: 1
						}, 1000);
						$(".comment-text textarea"+identificator).val("");
						$(".comment-text textarea"+identificator).focus();
						
					}
					callback(retorno);
				}
			});
		});
	}
});