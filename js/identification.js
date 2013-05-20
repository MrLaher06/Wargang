$(function() {
	
		$('#optionChoix').show();
													 
		$("#inscription").click(function () {
				$('#optionLogin').load(url+'inscription.html');
				return false;
		});
												
		$("#motDePasse").click(function () {
				$('#optionLogin').load(url+'mot_de_passe.html');
				return false;
		});
});

function inscription () 
{
		var error = 0,
		msg = '',
		usernameInscript = $('#usernameInscript').val(),
		passwordInscript = $('#passwordInscript').val(),
		password2Inscript = $('#password2Inscript').val(),
		emailInscript = $('#emailInscript').val(),
		captcha_response = $('#captcha_response').val();

		initFormulaire ( 'usernameInscript' );
		initFormulaire ( 'passwordInscript' );
		initFormulaire ( 'password2Inscript' );
		initFormulaire ( 'emailInscript' );
		initFormulaire ( 'captcha_response' );
	
		createCookie('usernameInscript', usernameInscript, null);
		createCookie('emailInscript', emailInscript, null);
	
		if( usernameInscript == '' )
		{
				error++;
				msg += 'Veuillez indiquer un login.\n';
				erreurFormulaire ( 'usernameInscript' );
		}
	
		if( emailInscript == '' || !VerificationEmail(emailInscript) )
		{
				error++;
				msg += 'Veuillez indiquer un e-mail valide.\n';
				erreurFormulaire ( 'emailInscript' );
		}
	
		if( passwordInscript == '' )
		{
				error++;
				msg += 'Veuillez indiquer un mot de passe.\n';
				erreurFormulaire ( 'passwordInscript' );
		}
	
		if( password2Inscript == '' || password2Inscript != passwordInscript )
		{
				error++;
				msg += 'Veuillez réécrire le mot de passe de sécurité.\n';
				erreurFormulaire ( 'password2Inscript' );
		}
	
		if( captcha_response == '' )
		{
				error++;
				msg += 'Veuillez indiquer correctement le code de validation.\n';
				erreurFormulaire ( 'captcha_response' );
		}
	
		if( error > 0 )
		{
				alert(msg);
				return false;
		}
		return true;
}

function mot_de_passe () 
{
		var error = 0,
		msg = '',
		emailMDP = $('#emailMDP').val(),
		captcha_response = $('#captcha_response').val();

		initFormulaire ( 'emailMDP' );
		initFormulaire ( 'captcha_response' );
	
		if( emailMDP == '' || !VerificationEmail(emailMDP) )
		{
				error++;
				msg += 'Veuillez indiquer un e-mail valide.\n';
				erreurFormulaire ( 'emailMDP' );
		}
	
		if( captcha_response == '' )
		{
				error++;
				msg += 'Veuillez indiquer correctement le code de validation.\n';
				erreurFormulaire ( 'captcha_response' );
		}
	
		if( error > 0 )
		{
				alert(msg);
				return false;
		}
		return true;
}



