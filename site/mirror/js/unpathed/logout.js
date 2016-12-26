$(function(){
	$("#leftbar-mini-text").on("click", function(){
		$.ajax({
			url: "post/logout.php",
			success: function() {
				window.location.href = "index.php";
			}
		});
	});
});