$(function() {
													 
		$(".achat").live("click", function(){ 
				clearInterval(drogue_general);
				$(this).val('');  
		});
	
		$(".achat_valider").live("click", function(){ 
																						 
				var id = $(this).attr('name');
				var valeur_quantite = $('#drogue_'+id).val();
				var argent_depart = $('#argent_user').html();

				if( verif_numeric(valeur_quantite) )
				{
						if( valeur_quantite > 0)
						{
								$.post(url+"drogues.html", {
										id_drogue: id, 
										quantite: valeur_quantite
								},
								function(data){
										$('#drogues').html(data);
										var argent_arrive = $('#argent_user').html();
						
										if(argent_arrive == argent_depart)
												histo_txt ( 'achat de produit impossible' );
										else
												histo_txt ( 'achat de produit effectué' );
								});
						}
						else
								alert('Veuillez indiquer une valeur supérieur à 0.');
				}
				else
						alert('Veuillez indiquer une valeur numérique.');
		}); 
	
});

