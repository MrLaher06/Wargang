$(function() {
													 
		$(".prepare_combat_bot").live("click", function(){
				$(this).attr('disabled', true);
				prepare_combat_bot( $(this).attr('name') );
		});

		$(".lancer_combat_bot").live("click", function(){
				$(this).attr('disabled', true);
				lancer_combat_bot( $(this).attr('name') );
		}); 

		$(".participer_combat_bot").live("click", function(){
				$(this).attr('disabled', true);
				participer_combat_bot( $(this).attr('name') );
		}); 
													 
		$(".prepare_combat_user").live("click", function(){
				prepare_combat_user( $(this).attr('name') );
		});

		$(".lancer_combat_user").live("click", function(){
				$(this).attr('disabled', true);
				lancer_combat_user( $(this).attr('name') );
		}); 

		$(".participer_combat_user").live("click", function(){
				$(this).attr('disabled', true);
				participer_combat_user( $(this).attr('name') );
		});
													 
		$(".prepare_combat_batiment").live("click", function(){
				$(this).attr('disabled', true);
				prepare_combat_batiment( $(this).attr('name') );
		});

		$(".lancer_combat_batiment").live("click", function(){
				$(this).attr('disabled', true);
				lancer_combat_batiment( $(this).attr('name') );
		}); 

		$(".participer_combat_batiment").live("click", function(){
				$(this).attr('disabled', true);
				participer_combat_batiment( $(this).attr('name') );
		}); 

		$(".annuler_combat").live("click", function(){
				$(this).attr('disabled', true);
				annuler_combat( $(this).attr('name') );
		}); 

		$(".prison_user").live("click", function(){
				$(this).attr('disabled', true);
				prison_user( $(this).attr('name') );
		});

		$(".control_user").live("click", function(){
				$(this).attr('disabled', true);
				control_user( $(this).attr('name') );
		});

		$(".denoncer_user").live("click", function(){
				$(this).attr('disabled', true);
				denoncer_user( $(this).attr('name') );
		});
													 
});

function prepare_combat_bot ( id )
{	
		$('#contenu').load(url+'combat/prepare_attaque_bot/'+id+'.html', function(){  
				$('#gang').load(url+'gang.html', function(){
						histo_txt ( 'Préparation combat' );
				}); 
		});
}

function lancer_combat_bot ( id )
{
		combat_en_cours('lancement');
	
		$('#contenu').load(url+'combat/lancer_attaque_bot/'+id+'.html', function(){ 
				$('#msg_alerte').html('');																																	 
				$('#gang').load(url+'gang.html', function(){ 
						histo_txt ( 'Lancement combat' ); 
				}); 
		});
}

function participer_combat_bot ( id )
{	
		$('#contenu').load(url+'combat/participer_attaque_bot/'+id+'.html', function(){ 
				$('#gang').load(url+'gang.html', function(){
						histo_txt ( 'Participation combat' );
				}); 
		});
}

function prepare_combat_user( id )
{
		var seconde = ( ( ( new Date().getTime() ) / 1000 ) - 10 );
		var login_time = $('#last_login').val();
	
		var seconde_attaque = ( ( ( new Date().getTime() ) / 1000 ) - 5 );
		var login_time_attaque = $('#last_login_'+id).val();
	
		if( seconde < login_time )
		{
				histo_txt ( 'Vous ne pouvez pas encore attaquer' );
				alert('Il est trop tôt pour pouvoir attaquer ('+Math.round( login_time - seconde )+'s)');
				return false;
		}
		else if( seconde_attaque < login_time_attaque )
		{
				histo_txt ( 'Vous ne pouvez pas encore attaquer' );
				alert('Il vient de sortir de planque, attaque possible dans : '+Math.round( login_time_attaque - seconde_attaque )+'s');
				return false;
		}
		else
		{
				$(this).attr('disabled', true);
				$('#contenu').load(url+'combat/prepare_attaque_user/'+id+'.html', function(){ 
						$('#gang').load(url+'gang.html', function(){
								histo_txt ( 'Preparer combat' );
						}); 
				});
		}
}

function lancer_combat_user( id )
{
		combat_en_cours('lancement');
	
		$('#contenu').load(url+'combat/lancer_attaque_user/'+id+'.html', function(){ 
				$('#msg_alerte').html('');
				$('#gang').load(url+'gang.html', function(){ 
						histo_txt ( 'Lancement combat' ); 
				}); 
		});
}

function participer_combat_user( id )
{
		$('#contenu').load(url+'combat/participer_attaque_user/'+id+'.html', function(){ 
				$('#gang').load(url+'gang.html', function(){
						histo_txt ( 'Participation combat' );
				}); 
		});
}

function prepare_combat_batiment( id )
{
		$('#contenu').load(url+'combat/prepare_attaque_batiment/'+id+'.html', function(){ 
				$('#gang').load(url+'gang.html', function(){
						histo_txt ( 'Preparation combat' );
				}); 
		});
}

function lancer_combat_batiment( id )
{	
		combat_en_cours('braquage');
	
		$('#contenu').load(url+'combat/lancer_attaque_batiment/'+id+'.html', function(){ 
				$('#msg_alerte').html('');
				$('#gang').load(url+'gang.html', function(){
						histo_txt ( 'Lancement braquage' );
				}); 
		});
}

function participer_combat_batiment( id )
{
		$('#contenu').load(url+'combat/participer_attaque_batiment/'+id+'.html', function(){ 
				$('#gang').load(url+'gang.html', function(){ 
						histo_txt ( 'Participation braquage' ); 
				}); 
		});
}

function annuler_combat ( id )
{
		$('#contenu').load(url+'combat/annuler_attaque/'+id+'.html', function(){ 
				$('#gang').load(url+'gang.html', function(){
						histo_txt ( 'Annulation de l\'action' );
				});
		});
}


function combat_en_cours( type )
{
		paneSplitter.showContent("contenu");
		$('#msg_alerte').html('<div class="msg_alert"><img src="/images/combat/'+type+'.png"/></div>');
		$('#contenu .button').fadeOut(200, function() {
				$(this).parent().html('<b class="vert">L\'action est en cours...</b>');
		});
		$('#gang .button').fadeOut(200, function() {
				$(this).parent().html('<b class="vert">L\'action est en cours...</b>');
		});
}

function prison_user ( id )
{
		combat_en_cours('flic');
		$('#contenu').load(url+'flic/prison/'+id+'.html', function(){ 
				$('#msg_alerte').html('');
				histo_txt ( 'Prison' );
		});
}

function control_user ( id )
{
		combat_en_cours('flic');
		$('#contenu').load(url+'flic/control/'+id+'.html', function(){ 
				$('#msg_alerte').html('');
				histo_txt ( 'Control' );
		});
}

function denoncer_user ( id )
{
		combat_en_cours('flic');
		$('#contenu').load(url+'flic/denoncer/'+id+'.html', function(){ 
				$('#msg_alerte').html('');
				histo_txt ( 'Dénoncer' );
		});
}
