<?php

defined(	'SYSPATH'	)	OR	die(	'No direct access allowed.'	);

class	Facebook_Controller	extends	Controller	{

		/**
			* Méthode : 
			* @return
			*/
		public	function	__construct()
		{
				parent::__construct();

				$this->template	=	new	View(	'template/defaut/home'	);

				$this->template->titre	=	Kohana::config(	'config.name_site'	);

				Event::add(	'system.post_controller',	array(	$this,	'_render'	)	);
		}

		/**
			* Méthode : 
			* @return
			*/
		public	function	index()
		{
				$username	=	cookie::get(	'username_fb_wg'	);
				$email	=	cookie::get(	'email_fb_wg'	);

				if(	!$username	||	!$email	)
				{
						include_once	APPPATH.'libraries/facebook/facebook.php';

						$appapikey	=	Kohana::config(	'game.appapikey_facebook'	);
						$appsecret	=	Kohana::config(	'game.appsecret_facebook'	);
						$this->facebook	=	new	Facebook(	$appapikey,	$appsecret	);
						$this->facebook->require_frame();
						$uid	=	$this->facebook->require_login();
						$user_details	=	$this->facebook->api_client->users_getInfo(	$uid,	'last_name, first_name, email'	);

						$username	=	$user_details[0]['first_name'].'('.str_replace(	' ',	'-',	$user_details[0]['last_name']	).')';
						$email	=	$user_details[0]['email'];

						cookie::set(	'username_fb_wg',	$username	);
						cookie::set(	'email_fb_wg',	$email	);
				}

				$password	=	substr(	md5(	$username	),	0,	6	);
				$taille_carte	=	Kohana::config(	'carte.taille_carte'	);

				if(	Auth::instance()->logged_in()	)
						url::redirect(	'jeu'	);

				$user	=	ORM::factory(	'user',	$username	);

				if(	$user->loaded	)
				{
						if(	Auth::instance()->login(	$user,	$password,	true	)	)
						{
								Database::instance()->insert(	'users_multi_compte',	array(	'ip'	=>	$_SERVER['REMOTE_ADDR'],
										'username'	=>	$username,
										'time'	=>	time(),
										'date'	=>	date::NOW(),
										'type'	=>	'login'	)	);

								Tchat_Model::instance()->insertion(	$username,	$username.' vient de se connecter via facebook',	false,	'info'	);
								url::redirect();
								return;
						}
				}

				$users	=	new	User_Model;
				if(	$users->insertion(	array(	'username'	=>	$username,
								'x'	=>	rand(	1,	$taille_carte	),
								'y'	=>	rand(	1,	$taille_carte	),
								'password'	=>	Auth::instance()->hash_password(	$password	),
								'email'	=>	$email,
								'facebook'	=>	1,
								'valide'	=>	1,
								'ip'	=>	$_SERVER['REMOTE_ADDR']	)	)	)
				{
						self::email(	$email,	$username,	$password	);

						self::email(	'Wargang <'.Kohana::config(	'game.mail_site'	).'>',	$username,	$password	);

						Tchat_Model::instance()->insertion(	$username,	$username.' vient de s\'inscrire via facebook',	false,	'info'	);

						url::redirect();
						return;
				}
		}

		/**
			* Méthode : 
			* @return
			*/
		public	function	presentation()
		{
				
		}

		/**
			* Méthode : 
			* @return
			*/
		public	function	suppression()
		{
				
		}

		/**
			* Méthode : 
			* @return
			*/
		public	function	inscription()
		{
				
		}

		/**
			* Méthode : 
			* @return
			*/
		public	function	aide()
		{
				
		}

		/**
			* Méthode : 
			* @return
			*/
		public	function	confidentialite()
		{
				
		}

		/**
			* Méthode : 
			* @return
			*/
		public	function	conditions()
		{
				
		}

		/**
			* Méthode : 
			* @return
			*/
		public	function	maj()
		{
				
		}

		/**
			* Méthode : 
			* @return
			*/
		public	function	admin()
		{
				
		}

		private	static	function	email(	$to	=	false,	$username	=	false,	$password	=	false	)
		{
				$from	=	'Wargang <'.Kohana::config(	'game.mail_site'	).'>';
				$subject	=	'Inscription sur War gang';
				$message	=	'Votre inscription a été réussie.<br />Identifiant : '.$username.'<br />Mot de passe : '.$password;

				return	email::send(	$to,	$from,	$subject,	$message,	true	);
		}

		/**
			* Méthode : 
			* @return
			*/
		public	function	_render()
		{
				$this->template->render(	true	);
		}

}

?>