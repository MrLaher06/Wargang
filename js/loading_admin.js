$(function() {
	
		$("#boutonDebug").click( function() {
				debug( );
		});
		
		$("#validation").click( function() {
				envois_form('valid');
		});
		
		$("#sauvegarde").click( function() {
				envois_form('sauve');
		});
		
		$("#annuler").click( function() {
				envois_form('annul');
		});
		
		$("#trash").click( function() {
				if( confirm('Etes vous sur ?') ) envois_form('trash');
		});
		
		if( $('#colorpicker').length ) $('#colorpicker').farbtastic('#couleur_gang');

});

function debug( )
{
		$("#boutonDebug").fadeOut(800, function () {
				$("#divDebug").fadeIn(800);
		});
}

function change_image( valeur, id_image, dossier )
{
		$('#'+id_image).attr('src','/images/'+dossier+'/'+valeur);
}

function envois_form( type )
{
		var url_Action = $('form').attr('action'); 
		var id = $('#id').val(); 
	
		$('form').attr('action', url+url_Action+'/'+type+'/'+id+'.html' )
	
		$('form').submit(); 
}