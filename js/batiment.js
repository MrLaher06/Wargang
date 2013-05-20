$(function() {
		$('#acheter_batiment').live('click', function(){
				$(this).attr('disabled', true);
				achat_batiment();
		});
	
		$('#visite_batiment').live('click', function(){
				$(this).attr('disabled', true);
				visite_batiment();
		});
	
		$('.acheter_vehicule').live('click', function(){
				$(this).attr('disabled', true);
				element_batiment( $(this).attr('name'), 'vehicule' );
		});
	
		$('.acheter_arme').live('click', function(){
				$(this).attr('disabled', true);
				element_batiment( $(this).attr('name'), 'arme' );
		});
	
		$('.acheter_protection').live('click', function(){
				$(this).attr('disabled', true);
				element_batiment( $(this).attr('name'), 'protection' );
		});
	
		$('.sortir_batiment').live('click', function(){
				$(this).attr('disabled', true);
				sortir_batiment();
		});
	
		$('#banque_transaction').live('click', function(){
				banque_transaction( $(this).attr('name') );
		});
	
		$('#recharge_arme').live('click', function(){
				$(this).attr('disabled', true);
				recharge('munition');
		});
	
		$('#recharge_vehicule').live('click', function(){
				$(this).attr('disabled', true);
				recharge('essence');
		});
	
		$('#note_hospital').live('click', function(){
				$(this).attr('disabled', true);
				hospital( $(this).attr('name') );
		});
	
		$('#prendre_autoroute').live('click', function(){
				$(this).attr('disabled', true);
				autoroute( $(this).attr('name') );
		});

		$('#commissariat').live('click', function(){
				$(this).attr('disabled', true);
				commissariat( $(this).attr('name') );
		});

		$('#valide_partie').live('click', function(){
				$(this).attr('disabled', true);
				valide_partie( $(this).attr('name') );
		});

		$('#demissionner_commissariat').live('click', function(){
				$(this).attr('disabled', true);
				demissionner_commissariat( $(this).attr('name') );
		});

		$('#mission_use_demander').live('click', function(){
				$(this).attr('disabled', true);
				mission_use( $(this).attr('name'), 'demande' );
		});

		$('#mission_user_valide').live('click', function(){
				$(this).attr('disabled', true);
				mission_use( $(this).attr('name'), 'valide' );
		});

		$('.equipe_foot').live('click', function(){
				equipe_foot( $(this).attr('id') );
		});
	
		$('#voir_equipe_monde').live('click', function(){
				affichage_foot();
		});
	
		$('#voir_archive_match').live('click', function(){
				voir_archive_match();
		});
	
		$('#lancer_paris').live('click', function(){
				lancer_paris();
		});
	
		$('#depot_parking').live('click', function(){
				parking( $(this).attr('name') );
		});
	
		$('.recuperer_vehicule').live('click', function(){
				recuperer_vehicule( $(this).attr('name') );
		});
	
		$('.description_detail').live('click', function(){
				description_divers( $(this).attr('id') );
		});
});

function achat_batiment()
{
		if(confirm('Etes vous sur de vouloir acheter ce bâtiment ?'))
		{
				var argent_depart = $('#argent_user').html();
		
				$('#contenu').load(url+'batiments/achat.html', 
						function(){  
								$('#user').load(url+'joueur.html',function(){ 
				
										var argent_arrive = $('#argent_user').html();
				
										if(argent_arrive == argent_depart)
												histo_txt ( 'achat de bâtiment impossible' );
										else
												histo_txt ( 'achat de bâtiment effectué' );
								}); 
						});
		}
}

function element_batiment( id, element )
{
		if(confirm('Etes vous sur de vouloir faire cet achat ?'))
		{
				var argent_depart = $('#argent_user').html();
		
				$('#contenu').load(url+'batiments/element/'+element+'/'+id+'.html', 
						function(){  
								$('#user').load(url+'joueur.html',function(){
					 
										var argent_arrive = $('#argent_user').html();
					
										if(argent_arrive == argent_depart)
												histo_txt ( 'achat impossible' );
										else
												histo_txt ( 'achat effectué' );
								}); 
						});
		}
}

function visite_batiment()
{	
		$('#contenu').load(url+'batiments/visite.html',function(){
				histo_txt ( 'visite d\'un bâtiment' );
		});
}

function sortir_batiment()
{	
		$('#contenu').load(url+'actions.html',function(){ 
				$('#user').load(url+'joueur.html',function(){
						histo_txt ( 'sortir d\'un bâtiment' ); 
				});  
		});
}

function banque_transaction( id )
{	
		var argent_virement = $('#virement_banque').val();
		var argent_retrait = $('#retrait_banque').val();
		var argent_user = $('#virement_user').val();
	
		if( ( verif_numeric( argent_virement ) && argent_virement > 0 ) || ( verif_numeric( argent_retrait ) && argent_retrait > 0 ) ) 
		{
				$('#banque_transaction').attr('disabled', true); 
		
				var argent_depart = $('#argent_user').html();
			
				$('#contenu').load(url+'batiments/element/banque/'+id+'.html?argent_virement='+argent_virement+'&argent_retrait='+argent_retrait+'&argent_user='+argent_user, 
						function(){  
								$('#user').load(url+'joueur.html',function(){
					 
										var argent_arrive = $('#argent_user').html();
					
										if(argent_arrive == argent_depart)
												histo_txt ( 'transaction impossible' );
										else
												histo_txt ( 'transaction effectué' );
								}); 
						});
		}
		else
				alert('Veuillez indiquer une somme');
}

function hospital( id )
{	
		var argent_depart = $('#argent_user').html();
		
		$('#contenu').load(url+'batiments/element/hospital/'+id+'.html', 
				function(){  
						$('#user').load(url+'joueur.html',function(){
				 
								var argent_arrive = $('#argent_user').html();
				
								if(argent_arrive == argent_depart)
										histo_txt ( 'hospitalisation impossible' );
								else
										histo_txt ( 'hospitalisation effectué' );
						}); 
				});
}

function autoroute( id )
{	
		var argent_depart = $('#argent_user').html();
	
		$('#contenu').load(url+'batiments/element/autoroute/'+id+'.html?autoroute='+$('#autoroute').val(), 
				function(){  
						$('#user').load(url+'joueur.html',function(){
				 
								var argent_arrive = $('#argent_user').html();
				
								if(argent_arrive == argent_depart)
										histo_txt ( 'autoroute impossible' );
								else
										histo_txt ( 'autoroute effectué' );
						}); 
				});
}

function commissariat( id )
{	
		$('#contenu').load(url+'batiments/element/commissariat/'+id+'.html', 
				function(){  
						$('#user').load(url+'joueur.html'); 
				});
}

function demissionner_commissariat( id )
{	
		$('#contenu').load(url+'batiments/element/demissionner_commissariat/'+id+'.html', 
				function(){  
						$('#user').load(url+'joueur.html'); 
				});
}


function recharge( type )
{	
		if(confirm('Etes vous sur de vouloir faire cet achat ?'))
		{
				var argent_depart = $('#argent_user').html();
		
				$('#contenu').load(url+'batiments/'+type+'.html', 
						function(){  
								$('#user').load(url+'joueur.html',function(){
					 
										var argent_arrive = $('#argent_user').html();
					
										if(argent_arrive == argent_depart)
												histo_txt ( 'achat impossible' );
										else
												histo_txt ( 'achat effectué' );
								}); 
						});
		}
}

function valide_partie( id )
{	
		$('#contenu').load(url+'batiments/element/victoire/'+id+'.html');
}

function mission_use( id, type )
{	
		$('#contenu').load(url+'batiments/element/mafia/'+id+'.html?type='+type);
}

function equipe_foot( id )
{	
		$('#contenu').load(url+'sport/equipe/'+id+'.html');
}

function voir_archive_match( id )
{	
		$('#contenu').load(url+'sport/archive_jour.html');
}

function affichage_foot(  )
{	
		if( $('#match_en_cours:visible').length)
		{
				$('#liste_equipe_monde').fadeIn();
				$('#match_en_cours').slideUp();
		}
		else
		{
				$('#match_en_cours').slideDown();
				$('#liste_equipe_monde').fadeOut();
		}
}

function lancer_paris()
{	
		var argent_domicile = $('#paris_equipe_domicile').val();
		var argent_visiteur = $('#paris_equipe_visiteur').val();
	
		if( ( argent_domicile == '' && argent_visiteur == '' ) 
				|| ( argent_domicile == 0 && argent_visiteur == 0 ) 
				|| ( argent_domicile != '' && !verif_numeric(argent_domicile) ) 
				|| ( argent_visiteur != '' && !verif_numeric(argent_visiteur) ) )
				alert('Veuillez indiquer un prix correct de dépot.');
		else
		{
				var argent_depart = $('#argent_user').html();
		
				$('#contenu').load(url+'batiments/element/sport.html?argent_domicile='+argent_domicile+'&argent_visiteur='+argent_visiteur, 
						function(){  
								$('#user').load(url+'joueur.html',function(){
					 
										var argent_arrive = $('#argent_user').html();
					
										if(argent_arrive == argent_depart)
												histo_txt ( 'paris impossible' );
										else
												histo_txt ( 'paris effectué' );
								}); 
						});
		}
}

function parking( id )
{
		var prix = Math.round($('#prixvente').val());
		var prix_max = Math.round($('#prix_max').val());
		var prix_min = Math.round($('#prix_min').val());
		
		if( prix == '' || prix == 0 || !verif_numeric(prix) )
				alert('Veuillez indiquer un prix correct de dépot.');
		
		else if(prix > prix_max )
				alert('Veuillez ne pas vendre votre véhicule plus de '+prix_max+' $.');
		
		else if (prix < prix_min)
				alert('Veuillez ne pas vendre votre véhicule moins de '+prix_min+' $.');
		
		else
				$('#contenu').load(url+'batiments/element/depot_parking/'+id+'.html?prix_depot='+prix, 
						function(){  
								$('#user').load(url+'joueur.html');
								histo_txt ( 'dépot du véhicule' );
						});
}

function recuperer_vehicule( id )
{
		var argent_depart = $('#argent_user').html();
	
		$('#contenu').load(url+'batiments/element/recuperer_parking/'+id+'.html', 
				function(){  
						$('#user').load(url+'joueur.html',function(){
					 
								var argent_arrive = $('#argent_user').html();
					
								if(argent_arrive == argent_depart)
										histo_txt ( 'récupération impossible' );
								else
										histo_txt ( 'récupération effectué' );
						}); 
				});
}

function description_divers( id )
{	
		if( $('#bloc_'+id+':visible').length)
		{
				$('#bloc_'+id).slideUp();
				$('#'+id).html('Afficher la description');
		}
		else
		{
				$('#bloc_'+id).slideDown();
				$('#'+id).html('Masquer la description');
		}
}

