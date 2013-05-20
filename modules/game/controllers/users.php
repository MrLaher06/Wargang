<?php

defined(	'SYSPATH'	)	or	die(	'No direct access allowed.'	);

class	Users_Controller	extends	System_Controller	{

		/**
			* Méthode : 
			* @return
			*/
		public	function	afficher_information_user()
		{
				if(	$this->_user->planque	||	$this->_user->prison()	)
						return	false;

				$view	=	new	View(	'user/detail_user'	);

				$view->user	=	$this->_user;
				$view->arme	=	Arme_Model::instance()->select_id(	$this->_user->id_arme	);
				$view->vehicule	=	Vehicule_Model::instance()->select_id(	$this->_user->id_vehicule	);
				$view->protection	=	Protection_Model::instance()->select_id(	$this->_user->id_protection	);
				$view->gang	=	Gang_Model::instance()->select_id(	$this->_user->id_gang	);
				$view->combat	=	Combats_Model::instance()->verif_user(	$this->_user->id	);
				$view->alerte_attaque	=	Combats_Model::instance()->verif_attaque_alerte(	$this->_user->id	);

				return	$view;
		}

		/**
			* Méthode : 
			* @return
			*/
		public	function	username()
		{
				return	$this->_user->username;
		}

		/**
			* Méthode : 
			* @return
			*/
		public	function	prison()
		{
				return	$this->_user->prison();
		}

		/**
			* Méthode : 
			* @return
			*/
		public	function	facebook()
		{
				return	$this->_user->facebook	?	true	:	false;
		}

		/**
			* Méthode : 
			* @return
			*/
		public	function	planque()
		{
				return	$this->_user->planque	?	true	:	false;
		}

		/**
			* Méthode : 
			* @return
			*/
		public	function	planque_view()
		{
				$view	=	new	View(	'user/planque'	);
				$view->login	=	new	View(	'login/identification'	);
				$view->login->frame	=	true;
				return	$view;
		}

		/**
			* Méthode : 
			* @return
			*/
		public	function	role()
		{
				return	$this->_role->name;
		}

		/**
			* Méthode : 
			* @return
			*/
		public	function	stat_left()
		{
				if(	request::is_ajax()	)
						echo	self::afficher_information_user();
		}

		/**
			* Méthode : 
			* @return
			*/
		public	function	afficher_competense_user()
		{
				$view	=	new	View(	'user/competense'	);

				$niveau	=	0;

				if(	$this->_user->niveau	>	9	)
						$niveau	=	round(	$this->_user->niveau	/	10	);

				$array_titre	=	array(	'Postulant',
						'Lascar',
						'Truand',
						'boss',
						'Ca&iuml;d',
						'Bandit',
						'Malfrat',
						'Gangster',
						'Terroriste',
						'Parrain',
						'L&eacute;gende'	);

				$view->titre	=	$array_titre[$niveau];

				if(	$this->_user->argent	<	self::puissance(	10,	3	)	)
						$view->argent	=	'Aucune';

				elseif(	$this->_user->argent	<	self::puissance(	10,	4	)	)
						$view->argent	=	'Carte de retrait';

				elseif(	$this->_user->argent	<	self::puissance(	10,	5	)	)
						$view->argent	=	'Carte bleue';

				elseif(	$this->_user->argent	<	self::puissance(	10,	6	)	)
						$view->argent	=	'Carte silver';

				elseif(	$this->_user->argent	<	self::puissance(	10,	7	)	)
						$view->argent	=	'Carte gold';

				elseif(	$this->_user->argent	<	self::puissance(	10,	8	)	)
						$view->argent	=	'Carte platinium';

				else
						$view->argent	=	'Carte infinitie';

				$view->achat_drogue	=	$this->_user->achat_drogue;
				$view->vente_drogue	=	$this->_user->vente_drogue;

				$view->achat_batiment	=	$this->_user->achat_batiment;
				$view->vente_batiment	=	$this->_user->vente_batiment;
				$view->deplacement	=	$this->_user->deplacement;

				$view->achat_element	=	$this->_user->achat_element;
				$view->vente_element	=	$this->_user->vente_element;

				$view->victoire	=	$this->_user->victoire;
				$view->defaite	=	$this->_user->defaite;

				$view->mission	=	$this->_user->mission;

				return	$view;
		}

		/**
			* Méthode : 
			* @return
			*/
		public	function	competense_right()
		{
				if(	request::is_ajax()	)
						echo	self::afficher_competense_user();
		}

		/**
			* Méthode : 
			* @return
			*/
		private	static	function	puissance(	$x,	$y	)
		{
				$resultat	=	1;

				for(	$i	=	0;	$i	<	$y;	$i++	)
						$resultat	*=	$x;

				return	$resultat;
		}

		/**
			* Méthode : 
			* @return
			*/
		public	function	modification()
		{
				$view	=	new	View(	'user/modification'	);
				$view->info	=	$this->_user;
				$view->render(	true	);
		}

		/**
			* Méthode : 
			* @return
			*/
		public	function	detail(	$id_user	)
		{
				$view	=	new	View(	'user/detail'	);
				$view->info	=	$this->_user->selection_id(	$id_user,	'commentaire, sexe, age, humeur, comportement, connaissance',	false	);
				$view->render(	true	);

				Statistiques_Model::instance()->insertion(	$id_user,	'vu_detail_user'	);
		}

		/**
			* Méthode : 
			* @return
			*/
		public	function	enregistrement()
		{
				if(	!request::is_ajax()	)
						return	false;

				if(	$password	=	$this->input->post(	'password_user'	)	)
						$array['password']	=	Auth::instance()->hash_password(	$password	);

				$array['commentaire']	=	$this->input->post(	'commentaire_user'	);
				$array['sexe']	=	$this->input->post(	'sexe_user'	);
				$array['age']	=	$this->input->post(	'age_user'	);
				$array['humeur']	=	$this->input->post(	'humeur_user'	);
				$array['comportement']	=	$this->input->post(	'comportement_user'	);
				$array['connaissance']	=	$this->input->post(	'connaissance_user'	);

				$this->_user->update(	$array	);

				Statistiques_Model::instance()->insertion(	$this->_user->id,	'modifier_user'	);
		}

		/**
			* Méthode : 
			* @return
			*/
		public	function	modifier_argent()
		{
				if(	!request::is_ajax()	)
						return	false;

				if(	$valeur	=	$this->input->post(	'argent_modif'	)	)
				{
						$this->_user->argent	=	$valeur;
						$this->_user->modifier();
						Statistiques_Model::instance()->insertion(	$this->_user->id,	'casino'	);
				}
		}

}

?>