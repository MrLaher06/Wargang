$(function(){

		$("ul.subnav").parent().append("<span></span>");
	
		$("ul.topnav li a").click(function() {
				$(this).parent().find("ul.subnav").slideDown('fast').show();
				$(this).parent().hover(function() { }, function(){
						$(this).parent().find("ul.subnav").slideUp('slow');
				});
		});

});
