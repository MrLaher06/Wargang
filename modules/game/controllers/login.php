<?php

class	Login_Controller	extends	Controller	{

		/**
			* M�thode : 
			* @return
			*/
		public	function	index()
		{
				self::redirection(	'Vous ne pouvez pas vous rendre directement sur cette page'	);
		}

		/**
			* M�thode : 
			* @return
			*/
		public	function	login()
		{
				if(	$_POST	)
				{
						$username	=	strtolower(	$this->input->post(	'username'	)	);
						$password	=	$this->input->post(	'password'	);
						$remember	=	$this->input->post(	'remember'	)	?	true	:	false;

						if(	$username	&&	$password	)
						{
								$user	=	ORM::factory(	'user',	$username	);

								if(	$user->loaded	)
								{
										if(	Auth::instance()->login(	$user,	$password,	$remember	)	)
										{
												$proxy	=	new	Proxy_Model;

												Database::instance()->insert(	'users_multi_compte',	array(	'ip'	=>	$_SERVER['REMOTE_ADDR'],
														'username'	=>	$username,
														'time'	=>	time(),
														'date'	=>	date::NOW(),
														'type'	=>	'login',
														'proxy'	=>	$proxy->detect()	)	);

												Tchat_Model::instance()->insertion(	$username,	$username.' vient de se connecter',	false,	'info'	);
												url::redirect();
												return;
										}
										else
												self::redirection(	'Erreur dans votre mot de passe'	);
								}
								else
										self::redirection(	'Ce compte n\'existe pas'	);
						}
						else
								self::redirection(	'Veuillez indiquer un login et mot de passe'	);
				}
				else
						self::redirection(	'Vous ne pouvez pas vous rendre directement sur cette page'	);

				$this->template	=	new	View(	'defaut/home'	);

				$this->template->render(	true	);
		}

		/**
			* M�thode : 
			* @return
			*/
		public	function	logout(	$txt	=	'Connection avec le jeu termin&eacute;'	)
		{
				$authentic	=	Auth::instance();

				if(	$authentic->logged_in()	)
				{
						$user	=	$authentic->get_user();

						$facebook	=	$user->facebook	===	1	?	true	:	false;

						$proxy	=	new	Proxy_Model;

						$db	=	Database::instance();
						$db->update(	'users',	array(	'planque'	=>	1	),	array(	'id'	=>	$user->id	)	);
						$db->update(	'combats',	array(	'actif'	=>	0	),	array(	'id_attaque'	=>	$user->id,	'actif'	=>	1	)	);
						$db->update(	'combats',	array(	'actif'	=>	0	),	array(	'id_defense'	=>	$user->id,	'type_defense'	=>	'user',	'actif'	=>	1	)	);
						$db->insert(	'users_multi_compte',	array(	'ip'	=>	$_SERVER['REMOTE_ADDR'],
								'username'	=>	$user->username,
								'time'	=>	time(),
								'date'	=>	date::NOW(),
								'type'	=>	'logout',
								'proxy'	=>	$proxy->detect()	)	);

						Statistiques_Model::instance()->insertion(	$user->id,	'logout'	);
						Tchat_Model::instance()->insertion(	$user->username,	$user->username.' vient de se planquer',	$user->id_gang,	'info'	);

						$authentic->logout(	true	);

						if(	$facebook	)
								url::redirect(	'home/facebook'	);

						url::redirect(	'?msg='.urlencode(	$txt	)	);
				}
		}

		/**
			* M�thode : 
			* @return
			*/
		private	static	function	redirection(	$msg	=	false	)
		{
				url::redirect(	'?msg='.urlencode(	$msg	)	);
		}

}

?>