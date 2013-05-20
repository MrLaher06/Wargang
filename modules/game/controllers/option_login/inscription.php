<?php

defined(	'SYSPATH'	)	or	die(	'No direct access allowed.'	);

class	Inscription_Controller	extends	Controller	{

		private	$captcha;

		/**
			* Méthode : 
			* @return
			*/
		public	function	__construct()
		{
				parent::__construct();

				$this->captcha	=	new	Captcha;
		}

		/**
			* Méthode : 
			* @return
			*/
		public	function	inscription()
		{
				if(	!request::is_ajax()	)
						return	false;

				$view	=	new	View(	'login/inscription'	);
				$view->captcha	=	$this->captcha->render();
				$view->render(	true	);
		}

		/**
			* Méthode : 
			* @return
			*/
		public	function	register()
		{
				if(	$this->captcha->invalid_count()	>	100	)
						self::redirection(	'Trop de tentative (protection robot)'	);

				elseif(	Auth::instance()->logged_in()	)
						url::redirect();

				elseif(	$_POST	)
				{
						$username	=	$this->input->post(	'usernameInscript'	);
						$password	=	$this->input->post(	'passwordInscript'	);
						$password2	=	$this->input->post(	'password2Inscript'	);
						$email	=	$this->input->post(	'emailInscript'	);
						$taille_carte	=	Kohana::config(	'carte.taille_carte'	);

						$user	=	ORM::factory(	'user',	$username	);
						$users	=	new	User_Model;

						$verif_mot_compose	=	explode(	' ',	$username	);

						if(	!$username	||	!$password	||	!$password2	||	!$email	)
								$txt	=	'Veuillez remplir tous les champs du formulaire';

						elseif(	count(	$verif_mot_compose	)	>	1	)
								$txt	=	'Veuillez indiquer un identifiant non composé';

						elseif(	$password	!=	$password2	)
								$txt	=	'Veuillez indiquer deux mot de passe identique';

						elseif(	!valid::email(	$email	)	||	!valid::email_domain(	$email	)	||	!valid::email_rfc(	$email	)	)
								$txt	=	'Veuillez indiquer un e-mail valide';

						elseif(	!Captcha::valid(	$this->input->post(	'captcha_response'	)	)	)
								$txt	=	'Veuillez recopier le texte de l\'image correctement';

						elseif(	$users->verification_mail(	$email	)	)
								$txt	=	'Votre mail existe d&eacute;j&agrave; dans nos bases de donn&eacute;es';

						elseif(	$user->loaded	)
								$txt	=	'Un compte existe d&eacute;j&agrave; avec cet identifiant';

						elseif(	$user->verification_banni(	$_SERVER['REMOTE_ADDR']	)	)
								$txt	=	'Vous êtes banni du site';

						elseif(	$users->insertion(	array(	'username'	=>	$username,	'x'	=>	rand(	1,	$taille_carte	),	'y'	=>	rand(	1,	$taille_carte	),	'password'	=>	Auth::instance()->hash_password(	$password	),	'email'	=>	$email,	'ip'	=>	$_SERVER['REMOTE_ADDR']	)	)	)
						{
								self::email(	$email,	$username,	$password,	true	);

								self::email(	'Wargang <'.Kohana::config(	'game.mail_site'	).'>',	$username,	$password	);

								url::redirect();
								return;
						}
						else
								$txt	=	'Une erreur est survenue lors de l\'enregistrement de votre compte';
				}
				else
						$txt	=	'Vous ne pouvez pas vous rendre directement sur cette page';

				self::redirection(	$txt	);
		}

		/**
			* Méthode : 
			* @return
			*/
		public	function	validation(	$code	=	false	)
		{
				$valeur	=	self::decrypte(	$code,	'inscription_validation'	);

				if(	valid::email(	$valeur	)	&&	valid::email_domain(	$valeur	)	&&	valid::email_rfc(	$valeur	)	)
				{
						if(	Database::instance()->update(	'users',	array(	'valide'	=>	1	),	array(	'email'	=>	$valeur	)	)	)
								self::redirection(	'inscription valide'	);
				}
				else
						self::redirection(	'inscription non valide'	);
		}

		/**
			* Méthode : 
			* @return
			*/
		private	static	function	redirection(	$msg	=	false	)
		{
				url::redirect(	'home?msg='.urlencode(	$msg	)	);
		}

		/**
			* Méthode : 
			* @return
			*/
		private	static	function	email(	$to	=	false,	$username	=	false,	$password	=	false,	$validation	=	false	)
		{
				$from	=	'Wargang <'.Kohana::config(	'game.mail_site'	).'>';
				$subject	=	'Inscription sur War gang';
				$message	=	'Votre inscription a été réussie.<br />Identifiant : '.$username.'<br />Mot de passe : '.$password;

				if(	$validation	)
				{
						$email_verif	=	self::crypte(	$to,	'inscription_validation'	);

						$message	.=	'<br /><br />Veuillez valider votre inscription en cliquant sur ce lien : <a href="'.url::base(TRUE).'/validation/'.$email_verif.'.html">http://'.url::base(TRUE).'/validation/'.$email_verif.'.html</a>';
				}

				return	email::send(	$to,	$from,	$subject,	$message,	true	);
		}

		private	static	function	generation_cle(	$Texte,	$CleDEncryptage	)
		{
				$CleDEncryptage	=	md5(	$CleDEncryptage	);
				$Compteur	=	0;
				$VariableTemp	=	'';
				for(	$Ctr	=	0;	$Ctr	<	strlen(	$Texte	);	$Ctr++	)
				{
						if(	$Compteur	==	strlen(	$CleDEncryptage	)	)
								$Compteur	=	0;
						$VariableTemp.=	substr(	$Texte,	$Ctr,	1	)	^	substr(	$CleDEncryptage,	$Compteur,	1	);
						$Compteur++;
				}
				return	$VariableTemp;
		}

		private	static	function	crypte(	$Texte,	$Cle	)
		{
				srand(	(double)	microtime()	*	1000000	);
				$CleDEncryptage	=	md5(	rand(	0,	32000	)	);
				$Compteur	=	0;
				$VariableTemp	=	'';

				for(	$Ctr	=	0;	$Ctr	<	strlen(	$Texte	);	$Ctr++	)
				{
						if(	$Compteur	==	strlen(	$CleDEncryptage	)	)
								$Compteur	=	0;
						$VariableTemp.=	substr(	$CleDEncryptage,	$Compteur,	1	).(substr(	$Texte,	$Ctr,	1	)	^	substr(	$CleDEncryptage,	$Compteur,	1	)	);
						$Compteur++;
				}
				return	base64_encode(	self::generation_cle(	$VariableTemp,	$Cle	)	);
		}

		private	static	function	decrypte(	$Texte,	$Cle	)
		{
				$Texte	=	self::generation_cle(	base64_decode(	$Texte	),	$Cle	);
				$VariableTemp	=	'';

				for(	$Ctr	=	0;	$Ctr	<	strlen(	$Texte	);	$Ctr++	)
				{
						$md5	=	substr(	$Texte,	$Ctr,	1	);
						$Ctr++;
						$VariableTemp.=	(	substr(	$Texte,	$Ctr,	1	)	^	$md5);
				}
				return	$VariableTemp;
		}

}

?>