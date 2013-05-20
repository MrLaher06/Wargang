var refresh_carte;

function move ( id )
{
		var temps_restant = parseInt($('#delai').html());
	
		if(temps_restant < 10)
		{
				$('#Ccarte').load(url+'deplacement.html', {
						direction : id
				},function(){ 
						fermer_carte();
						histo_txt ( 'déplacement sur la carte' );
						paneSplitter.showContent("contenu");
				});
		}
}

function fermer_carte()
{
		clearInterval(refresh_carte);
		clearTimeout(compte_actif);
		$('#contenu').load(url+'actions.html', function() {
				reload_partie_auto ();
		});
		histo_txt ( 'fermeture de la carte' );
		closeMessage();
}