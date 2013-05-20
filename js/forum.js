$(function() {
	
		$(".effacer_tchat").live("click", function(){
																						 
				bodyContent = $.ajax({
						url: url+"script.php",
						global: false,
						type: "POST",
						data: ({
								id : this.getAttribute('id')
								}),
						dataType: "html",
						success: function(msg){
								alert(msg);
						}
				}).responseText; 
		
				$.ajax({
						url: url+'tchat.html',
						timeout: 1000,
						success: function(data) {
								$('#tchatTxtr').html(data);
						}
				});
		
		});
	
});



