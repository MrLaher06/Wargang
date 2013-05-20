<?php

defined(	'SYSPATH'	)	or	die(	'No direct access allowed.'	);

class	System_Controller	extends	Controller	{

		protected	$_user;
		protected	$_role;
		protected	$_session;

		/**
			* Méthode : 
			* @return
			*/
		public	function	__construct()
		{
				parent::__construct();

				$authentic	=	new	Auth;

				if(	$authentic->logged_in()	)
				{
						$cache	=	new	Cache();

						$this->_session	=	Session::instance();

						$this->_user	=	$authentic->get_user();

						if(	$this->_user->hp	<=	0	)
								$this->_user->mort();

						if(	$this->_user->valide	==	0	)
								Login_Controller::logout(	'Veuillez valider votre inscription via le mail qui a été envoyé'	);

						if(	$this->_user->banni	)
						{
								cookie::set(	md5(	'banni'	),	1,	(	60	*	30	)	);
								Login_Controller::logout(	'Vous &ecirc;tes banni du jeu'	);
						}

						$this->_role->name	=	$this->_user->roles->select_list(	'id',	'name'	);

						$this->_role->description	=	$this->_user->roles->select_list(	'id',	'description'	);

						$this->_user->last_activity	=	$this->_session->get(	'last_activity'	);
				}
				else
						url::redirect();
		}

		/**
			* Méthode : 
			* @return
			*/
		public	function	admin()
		{
				if(	!in_array(	'admin',	$this->_role->name	)	&&	!in_array(	'modo',	$this->_role->name	)	)
						url::redirect();
		}

}

?>