<?php

defined(	'SYSPATH'	)	or	die(	'No direct access allowed.'	);

class	Actions_Controller	extends	System_Controller	{

		private	$class;

		public	function	__construct()
		{
				parent::__construct();

				$this->class	=	Actions_Model::instance();
		}

		/**
			* Méthode : 
			* @return
			*/
		public	function	index()
		{
				if(	!request::is_ajax()	)
						return	false;

				echo	self::liste_actions_possibles();
		}

		/**
			* Méthode : 
			* @return
			*/
		public	function	liste_actions_possibles()
		{
				if(	$temps	=	$this->_user->prison()	)
						return	Flic_Controller::afficher_prison(	$temps	);

				if(	$this->_user->planque	)
						return	Users_Controller::planque_view();

				$view	=	new	View(	'actions/informations'	);

				$view->victoire	=	$this->class->verif_victoire();

				if(	$nbr_actions	=	$this->class->selection(	$this->_user->x,	$this->_user->y,	$this->_user->id	)	)
				{
						$batiment	=	false;

						$en_participation	=	$this->class->verif_user_participe(	$this->_user->id	);
						$en_lancement	=	$this->class->verif_user_lanceur(	$this->_user->id	);

						if(	$val	=	$this->class->batiment()	)
						{
								$view->batiment	=	new	View(	'batiments/liste_batiments'	);
								$view->batiment->val	=	$val;
								$view->batiment->id_user	=	$this->_user->id;
								$view->batiment->flic	=	$this->_user->id_gang	==	1	?	true	:	false;
								$view->batiment->desactive	=	$en_participation;
								$view->batiment->en_combat	=	(!$en_lancement	||	($en_lancement	&&	$en_lancement->id_defense	==	$val->id	&&	$en_lancement->type_defense	==	'batiment')	)	?	false	:	true;

								$batiment	=	true;
						}

						if(	$user	=	$this->class->users()	)
						{
								$view->users	=	false;
								$view->nbr_users	=	$user->count();

								foreach(	$user	as	$val	)
								{
										$v	=	new	View(	'user/liste_user'	);
										$v->val	=	$val;
										$v->id_vehicule	=	(!$batiment)	?	$this->_user->id_vehicule	:	false;
										$v->id_arme	=	$this->_user->id_arme;
										$v->id_gang	=	$this->_user->id_gang;
										$v->time_login	=	$this->_user->last_login;
										$v->flic	=	$val->id_gang	==	1	?	true	:	false;
										$v->desactive	=	$en_participation;
										$v->en_combat	=	(!$en_lancement	||	($en_lancement	&&	$en_lancement->id_defense	==	$val->id	&&	$en_lancement->type_defense	==	'user')	)	?	false	:	true;

										$view->users	.=	$v;
								}
						}

						if(	$bots	=	$this->class->bots()	)
						{
								$view->bots	=	false;
								$view->nbr_bots	=	$bots->count();

								foreach(	$bots	as	$val	)
								{
										$v	=	new	View(	'bots/liste_bots'	);
										$v->val	=	$val;
										$v->id_vehicule	=	(!$batiment)	?	$this->_user->id_vehicule	:	false;
										$v->id_arme	=	$this->_user->id_arme;
										$v->desactive	=	$en_participation;
										$v->en_combat	=	(!$en_lancement	||	($en_lancement	&&	$en_lancement->id_defense	==	$val->id	&&	$en_lancement->type_defense	==	'bot')	)	?	false	:	true;

										$view->bots	.=	$v;
								}
						}
				}

				if(	!$nbr_actions	)
				{
						$vehicule	=	Vehicule_Model::instance();
						$vehicule->select_id(	$this->_user->id_vehicule	);

						$view->panel	=	new	View(	'actions/panel'	);
						$view->panel->deplacement	=	false;

						if(	(	$vehicule->deplacement(	$this->_user->etat_vehicule,	$this->_user->reservoir_vehicule	)	-	(	time()	-	$this->_user->time_move	)	)	<=	0	)
								$view->panel->deplacement	=	true;
				}

				$view->nbr_actions	=	$nbr_actions;

				return	$view;
		}

}

?>