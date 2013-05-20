<?php

defined(	'SYSPATH'	)	or	die(	'No direct access allowed.'	);

class	Mot_De_Passe_Controller	extends	Controller	{

		/**
			* M�thode : 
			* @return
			*/
		public	function	__construct()
		{
				parent::__construct();

				$this->captcha	=	new	Captcha;
		}

		/**
			* M�thode : 
			* @return
			*/
		public	function	mot_de_passe()
		{
				if(	!request::is_ajax()	)
						return	false;

				$view	=	new	View(	'login/mot_de_passe'	);
				$view->captcha	=	$this->captcha->render();
				$view->render(	true	);
		}

		/**
			* M�thode : 
			* @return
			*/
		public	function	envois()
		{
				if(	$this->captcha->invalid_count()	>	100	)
						self::redirection(	'Trop de tentative (protection robot)'	);

				elseif(	Auth::instance()->logged_in()	)
						url::redirect();

				elseif(	$_POST	)
				{
						if(	$email	=	$this->input->post(	'emailMDP'	)	)
						{
								$users	=	new	User_Model;

								if(	!valid::email(	$email	)	||	!valid::email_domain(	$email	)	||	!valid::email_rfc(	$email	)	)
										$txt	=	'Veuillez un e-mail valide';

								elseif(	!Captcha::valid(	$this->input->post(	'captcha_response'	)	)	)
										$txt	=	'Veuillez recopier le texte de l\'image correctement';

								elseif(	!$users->verification_mail(	$email	)	)
										$txt	=	'Votre mail n\'existe pas dans nos bases de donn&eacute;es';

								elseif(	$mdp	=	$users->modifier_mot_de_passe(	$email	)	)
								{
										if(	self::email(	$email,	$mdp	)	)
												$txt	=	'Nouveau mot de passe envoy&eacute;';
										else
												$txt	=	'Une erreur est survenue lors de l\'envois du e-mail';
								}
								else
										$txt	=	'Une erreur est survenue lors de la g&eacute;n&eacute;ration du mot de passe';
						}
						else
								$txt	=	'Veuillez indiquer un e-mail';

						self::redirection(	$txt	);
				}
		}

		/**
			* M�thode : 
			* @return
			*/
		private	static	function	email(	$to	=	false,	$password	=	false	)
		{
				$from	=	'Wargang <'.Kohana::config(	'game.mail_site'	).'>';
				$subject	=	'Mot de passe oublié sur War gang';
				$message	=	'Vous venez de faire une demande de mot de passe.<br />Mot de passe : '.$password;

				return	email::send(	$to,	$from,	$subject,	$message,	TRUE	);
		}

		/**
			* M�thode : 
			* @return
			*/
		private	static	function	redirection(	$msg	=	false	)
		{
				url::redirect(	'home?msg='.urlencode(	$msg	)	);
		}

}

?>