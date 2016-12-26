var Tabs = (function(){
	$("ul.tabs li[to]").on("click", function(){
		$(this).parent().children().removeAttr("selected");
		$(this).attr("selected", "selected");
		var to = $(this).attr("to");
		$("div.tabs div.tab").removeAttr("selected");
		$("div.tabs div.tab#"+to).attr("selected", "selected");
	});
});