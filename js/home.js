$(function() {
													 
		$('#inscription').click(function () {
				$('#optionLogin').load(url+'inscription.html');
		});

		$('#submit').click(function () {
				$(this).val('Connexion en cours...');
		});

		$('#motDePasse').click(function () {
				$('#optionLogin').load(url+'mot_de_passe.html');
		});
	
		$('#annul').live('click', function(){
				$('#optionLogin').html('');
		});

		$('#optionChoix').show();
													 
		$('.Cmsg').delay(3000).fadeOut(2000);
	
		$('.iframe').fancybox({
				'frameWidth': 690, 
				'frameHeight': 345, 
				'overlayShow': false,
				'centerOnScroll': false,
				'callbackOnStart' : function() {
						$('#contener_home').fadeOut(500);
				},
				'callbackOnClose' : function() {
						$('#contener_home').fadeIn(200);
				},
				'enableEscapeButton' : true
		}); 
	
});

function VerificationEmail(elm)
{
		if( elm.indexOf("@") != "-1" && elm.indexOf(".") != "-1")
				return true;
	
		return false;
}

function erreurFormulaire ( nom )
{
		$('#'+nom).css("border-color","#900");
		$('#'+nom).css("background-color","#FCC");
}

function initFormulaire ( nom )
{
		$('#'+nom).css("border-color","#CCC");
		$('#'+nom).css("background-color","#FFF");
}

function verif_numeric(variable)
{
		var exp = new RegExp("^[0-9]+$","g");
		return exp.test(variable);
}

function inscription () 
{	
		var error = 0;
		var msg = '';
	
		var usernameInscript = $('#usernameInscript').val();
		var passwordInscript = $('#passwordInscript').val();
		var password2Inscript = $('#password2Inscript').val();
		var emailInscript = $('#emailInscript').val();
		var captcha_response = $('#captcha_response').val();

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
	
		$('#submitInscript').val('Inscription en cours...');
	
		return true;
}

function mot_de_passe () 
{
		var error = 0;
		var msg = '';
	
		var emailMDP = $('#emailMDP').val();
		var captcha_response = $('#captcha_response').val();

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
	
		$('#submitMDP').val('Envois en cours...');
	
		return true;
}

