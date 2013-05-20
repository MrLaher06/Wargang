$(function() {
													 
		$("#lancer_invitation").live("click", function(){
				lancer_invitation();
		});
	
		$(".supprimer_invite").live("click", function(){
				annul_invitation( $(this).attr('name') );
		});
	
		$(".valider_invite").live("click", function(){
				valider_invite( $(this).attr('name') );
		});
	
		$(".update_boss_invite").live("click", function(){
				update_boss_invite( $(this).attr('name') );
		});
	
});

function lancer_invitation ()
{
		if(confirm('Etes vous sur de vouloir envoyer cette invitation ?\nVous ne pourrez plus le virer par la suite.'))
		{
				$('#gang').load(url+'gang/envois_invitation/'+$('#user_invit').val()+'.html', function(){
						histo_txt ( 'invitation envoyé' );
				});
		}
}

function annul_invitation ( id )
{
		if(confirm('Etes vous sur de vouloir annuler cette invitation ?'))
		{
				$('#gang').load(url+'gang/annul_invitation/'+id+'.html', function(){
						histo_txt ( 'invitation annulé' );
				});
		}
}

function valider_invite ( id )
{
		if(confirm('Etes vous sur de vouloir valider cette invitation ?'))
		{
				$('#gang').load(url+'gang/valider_invitation/'+id+'.html', function(){
						histo_txt ( 'invitation validé' );
				});
		}
}

function update_boss_invite ( id )
{
		if(confirm('Etes vous sur de vouloir donner vos pleins pouvoir ?'))
		{
				$('#gang').load(url+'gang/update_boss/'+id+'.html', function(){
						histo_txt ( 'Vous n\'êtes plus le chef' );
				});
		}
}