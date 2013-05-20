<?php

defined(	'SYSPATH'	)	or	die(	'No direct access allowed.'	);

class	Flic_Controller	extends	Actions_Controller	{

		/**
			* Méthode : 
			* @return
			*/
		public	function	prison(	$id_user	=	false,	$user	=	false	)
		{
				sleep(	2	);

				if(	!$user	)
				{
						$user	=	new	User_Model;
						$user->selection_id(	$id_user	);
				}

				if(	!$user->planque	&&	$user->x	==	$this->_user->x	&&	$user->y	==	$this->_user->y	&&	$user->recherche	)
				{
						$user->prison	=	time();
						$user->argent	+=	round(	$user->argent	/	4	);
						$user->y	=	rand(	1,	Kohana::config(	'carte.taille_carte'	)	);
						$user->x	=	rand(	1,	Kohana::config(	'carte.taille_carte'	)	);

						$user->update(	array(	'argent'	=>	$user->argent,
								'recherche'	=>	0,
								'munition'	=>	0,
								'id_arme'	=>	0,
								'x'	=>	$user->x,
								'y'	=>	$user->y,
								'prison'	=>	$user->prison	)	);

						$this->_user->argent	+=	round(	$user->argent	/	4	);
						$this->_user->modifier();

						$db	=	Database::instance();
						$db->update(	'combats',	array(	'actif'	=>	0	),	array(	'id_attaque'	=>	$this->_user->id,	'actif'	=>	1	)	);
						$db->update(	'combats',	array(	'actif'	=>	0	),	array(	'id_defense'	=>	$this->_user->id,	'type_defense'	=>	'user',	'actif'	=>	1	)	);

						self::tchat(	$this->_user->username.' vient de mettre en taule '.$user->username	);
						Tchat_Model::instance()->insertion(	$user->username,	'Tu es en taule',	$user->id_gang,	'alert'	);
						Tchat_Model::instance()->insertion(	$this->_user->username,	'Tu l\'as mis en taule',	$this->_user->id_gang,	'alert'	);
						Statistiques_Model::instance()->insertion(	$this->_user->id,	'mettre_prison'	);
						Statistiques_Model::instance()->insertion(	$user->id,	'aller_prison'	);
				}
				parent::index();
		}

		/**
			* Méthode : 
			* @return
			*/
		public	function	control(	$id_user	=	false	)
		{
				sleep(	2	);

				$user	=	new	User_Model;
				$user->selection_id(	$id_user	);

				if(	!$user->planque	&&	$user->x	==	$this->_user->x	&&	$user->y	==	$this->_user->y	&&	$user->recherche	&&	rand(	0,	1	)	==	1	)
						self::prison(	false,	$user	);

				elseif(	!$user->planque	&&	$user->x	==	$this->_user->x	&&	$user->y	==	$this->_user->y	&&	$user->id_arme	&&	$user->munition	&&	rand(	0,	1	)	==	1	)
				{
						$user->y	=	rand(	1,	Kohana::config(	'carte.taille_carte'	)	);
						$user->x	=	rand(	1,	Kohana::config(	'carte.taille_carte'	)	);

						$user->update(	array(	'recherche'	=>	0,
								'munition'	=>	0,
								'id_arme'	=>	0,
								'x'	=>	$user->x,
								'y'	=>	$user->y	)	);

						Statistiques_Model::instance()->insertion(	$this->_user->id,	'retirer_arme'	);
						Statistiques_Model::instance()->insertion(	$user->id,	'confisque_arme'	);
						self::tchat(	$this->_user->username.' vient de confisquer l\'arme de '.$user->username	);
						Tchat_Model::instance()->insertion(	$user->username,	'Tu as été contrôlé et tu avais une arme.',	$user->id_gang,	'alert'	);
						Tchat_Model::instance()->insertion(	$this->_user->username,	'Il avait une arme.',	$this->_user->id_gang,	'alert'	);

						parent::index();
				}
				else
						parent::index();
		}

		/**
			* Méthode : 
			* @return
			*/
		public	function	denoncer(	$id_user	=	false	)
		{
				sleep(	8	);

				$user	=	new	User_Model;
				$user->selection_id(	$id_user	);

				Statistiques_Model::instance()->insertion(	$user->id,	'denoncer'	);

				if(	!$user->planque	&&	$user->x	==	$this->_user->x	&&	$user->y	==	$this->_user->y	&&	$user->recherche	&&	rand(	0,	1	)	==	1	)
						self::prison(	false,	$user	);
				else
						parent::index();
		}

		/**
			* Méthode : 
			* @return
			*/
		public	function	afficher_prison(	$delai	=	false	)
		{
				$view	=	new	View(	'batiments/options/prison'	);
				$view->delai	=	$delai;

				$list	=	Database::instance()->from(	'users'	)->join(	'gangs',	'gangs.id',	'users.id_gang',	'LEFT'	)->where(	'prison !=',	0	)->get();

				if(	$list->count()	)
				{
						$view->prisonniers	=	new	View(	'score/conteneur'	);
						$view->prisonniers->resultat	=	$list;
						$view->prisonniers->home	=	true;
						$view->prisonniers->titre	=	true;
				}

				return	$view;
		}

		private	function	tchat(	$txt	=	false	)
		{
				Tchat_Model::instance()->insertion(	$this->_user->username,	$txt.' <a href=\'javascript:;\' onclick=\'panelAfficher("center","journal","'.url::base(	TRUE	).'journal.html","Journal","Journal");\'>Voir sur le journal</a>',	$this->_user->id_gang,	'info'	);
		}

}

?>