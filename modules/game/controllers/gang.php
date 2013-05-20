<?php

defined(	'SYSPATH'	)	or	die(	'No direct access allowed.'	);

class	Gang_Controller	extends	System_Controller	{

		private	$class;
		private	$nbr_actions;
		private	$en_participation;

		public	function	__construct()
		{
				parent::__construct();

				$this->class	=	Gang_Model::instance();
		}

		/**
			* Méthode : 
			* @return
			*/
		public	function	index()
		{
				if(	!request::is_ajax()	)
						return	false;

				echo	self::liste_actions_gang();
		}

		/**
			* Méthode : 
			* @return
			*/
		public	function	liste_actions_gang()
		{
				if(	$temps	=	$this->_user->prison()	)
						return	Flic_Controller::afficher_prison(	$temps	);

				if(	$this->_user->planque	)
						return	Users_Controller::planque_view();

				$view	=	new	View(	'gang/informations'	);
				$view->deplacement	=	false;

				$this->en_participation	=	$this->class->verif_user_participe(	$this->_user->id	);

				$view->bots	=	self::liste_actions_bot();
				$view->users	=	self::liste_actions_user();
				$view->batiments	=	self::liste_actions_batiment();
				$view->my_id	=	$this->_user->id;
				$view->my_niveau	=	$this->_user->niveau;

				if(	!$this->nbr_actions	)
				{
						if(	(	time()	-	$this->_user->time_move)	>	Vehicule_Model::instance()->select_id(	$this->_user->id_vehicule	)->deplacement	)
								$view->deplacement	=	true;

						if(	$liste_users_gang	=	$this->class->liste_users_gang(	$this->_user->id_gang	)	)
								$view->liste_users	=	$liste_users_gang;

						$view->crea_gang	=	$this->_user->niveau	>=	Kohana::config(	'gang.niveau_crea'	)
								&&	$this->_user->id_gang	>	1
								&&	$this->_user->argent	>=	Kohana::config(	'gang.argent_crea'	)	?	true	:	false;

						if(	$this->class->select_id(	$this->_user->id_gang	)->id_user_gang	==	$this->_user->id	&&	$this->_user->id_gang	>	1	)
						{
								$view->list_invite	=	$this->class->liste_invite_gang(	$this->_user->id_gang,	$this->_user->id	);
								$view->boss_gang	=	true;
								$view->crea_gang	=	false;

								$view->list_invite_en_cours	=	$this->class->invitation_en_cours(	$this->_user->id_gang	);
						}

						$view->list_invite_demande	=	$this->class->invitation_demande(	$this->_user->id	);
				}

				$view->nbr_actions	=	$this->nbr_actions;

				return	$view;
		}

		/**
			* Méthode : 
			* @return
			*/
		public	function	liste_actions_bot()
		{
				if(	$this->_user->planque	||	$this->_user->prison()	)
						return	false;

				if(	$bots	=	$this->class->combat_bot(	$this->_user->id_gang	)	)
				{
						$vue	=	round(	(	$this->_user->niveau	/	10	)	+	4	);

						$display	=	false;

						foreach(	$bots	as	$val	)
						{
								$view	=	new	View(	'gang/liste_bots'	);
								$view->val	=	$val;
								$view->possible	=	Carte_Model::visibilite(	$val->y,	$val->x,	$this->_user->y,	$this->_user->x,	$this->_user->niveau	);
								$view->participer	=	$this->_user->id;
								$view->liste_participant	=	$this->class->list_participant(	$val->id_combat	);
								$view->desactive	=	$this->en_participation;

								$display	.=	$view;
						}

						$this->nbr_actions	+=	$bots->count();

						return	$display;
				}
				return	false;
		}

		/**
			* Méthode : 
			* @return
			*/
		public	function	liste_actions_user()
		{
				if(	$this->_user->planque	||	$this->_user->prison()	)
						return	false;

				if(	$users	=	$this->class->combat_user(	$this->_user->id_gang	)	)
				{
						$vue	=	round(	(	$this->_user->niveau	/	10	)	+	4	);

						$display	=	false;

						foreach(	$users	as	$val	)
						{
								$view	=	new	View(	'gang/liste_users'	);
								$view->val	=	$val;
								$view->possible	=	Carte_Model::visibilite(	$val->y,	$val->x,	$this->_user->y,	$this->_user->x,	$this->_user->niveau	);
								$view->participer	=	$this->_user->id;
								$view->liste_participant	=	$this->class->list_participant(	$val->id_combat	);
								$view->desactive	=	$this->en_participation;

								$display	.=	$view;
						}

						$this->nbr_actions	+=	$users->count();

						return	$display;
				}
				return	false;
		}

		/**
			* Méthode : 
			* @return
			*/
		public	function	liste_actions_batiment()
		{
				if(	$this->_user->planque	||	$this->_user->prison()	)
						return	false;

				if(	$batiments	=	$this->class->combat_batiment(	$this->_user->id_gang	)	)
				{
						$vue	=	round(	(	$this->_user->niveau	/	10	)	+	4	);

						$display	=	false;

						foreach(	$batiments	as	$val	)
						{
								$view	=	new	View(	'gang/liste_batiments'	);
								$view->val	=	$val;
								$view->possible	=	Carte_Model::visibilite(	$val->y,	$val->x,	$this->_user->y,	$this->_user->x,	$this->_user->niveau	);
								$view->participer	=	$this->_user->id;
								$view->liste_participant	=	$this->class->list_participant(	$val->id_combat	);
								$view->desactive	=	$this->en_participation;

								$display	.=	$view;
						}

						$this->nbr_actions	+=	$batiments->count();

						return	$display;
				}
				return	false;
		}

		/**
			* Méthode : 
			* @return
			*/
		public	function	creation()
		{
				if(	$this->_user->niveau	>=	Kohana::config(	'gang.niveau_crea'	)
						&&	$this->_user->id_gang	>	1
						&&	$this->_user->argent	>=	Kohana::config(	'gang.argent_crea'	)	)
				{
						$view	=	new	View(	'gang/creation'	);
						$view->propo_username	=	'Team de '.$this->_user->username;
						$view->render(	true	);
				}
		}

		/**
			* Méthode : 
			* @return
			*/
		public	function	enregistrement_creation()
		{
				if(	!request::is_ajax()	)
						return	false;

				if(	$this->_user->niveau	>=	Kohana::config(	'gang.niveau_crea'	)
						&&	$this->_user->id_gang	>	1
						&&	$this->_user->argent	>=	Kohana::config(	'gang.argent_crea'	)	)
				{
						Tchat_Model::instance()->insertion(	$this->_user->username,	$this->_user->username.' vient de quitter le gang',	$this->_user->id_gang,	'gang'	);

						$array['nom_gang']	=	$this->input->post(	'nom_gang'	);
						$array['image_gang']	=	$this->input->post(	'image_gang'	);
						$array['commentaire_gang']	=	$this->input->post(	'commentaire_gang'	);
						$array['couleur_gang']	=	$this->input->post(	'couleur_gang'	);
						$array['id_user_gang']	=	$this->_user->id;

						$this->_user->update(	array(	'id_gang'	=>	$this->class->insert(	$array	),	'argent'	=>	(	$this->_user->argent	-	Kohana::config(	'gang.argent_crea'	)	)	)	);

						Statistiques_Model::instance()->insertion(	$this->_user->id,	'creation_gang'	);
						Tchat_Model::instance()->insertion(	$this->_user->username,	$this->_user->username.' vient de créer le gang : '.$array['nom_gang'],	$this->_user->id_gang,	'info'	);

						$from	=	'Wargang <'.Kohana::config(	'game.mail_site'	).'>';
						$subject	=	'Votre nouveau gang sur War gang';
						$message	=	'Vous venez de créer un nouveau gang sur War Gang qui porte le nom de : '.$array['nom_gang'].'<br />';
						$message	.=	'Slogan : '.$array['commentaire_gang'];

						email::send(	$this->_user->email,	$from,	$subject,	$message,	true	);
				}
		}

		/**
			* Méthode : 
			* @return
			*/
		public	function	envois_invitation(	$id_user	=	false	)
		{
				if(	!request::is_ajax()	||	!$id_user	)
						return	false;

				$array['id_user_invit']	=	$id_user;
				$array['id_gang_invit']	=	$this->_user->id_gang;
				$array['date_invit']	=	date::NOW();

				$this->class->insert_invitation(	$array	);

				Statistiques_Model::instance()->insertion(	$this->_user->id,	'envois_invitation'	);
				Tchat_Model::instance()->insertion(	$this->_user->username,	$this->_user->username.' vient d\'envoyer une invitation',	$this->_user->id_gang,	'gang'	);

				$from	=	'Wargang <'.Kohana::config(	'game.mail_site'	).'>';
				$subject	=	'Invitation sur War gang';
				$message	=	'Vous venez de recevoir une invitation pour faire parti d\'un autre autre gang.<br />'
						.'Veuillez vous rendre sur le jeu, dans la rubrique "gang" pour la gérer.';

				email::send(	$this->class->email(	$id_user	),	$from,	$subject,	$message,	true	);

				echo	self::liste_actions_gang();
		}

		/**
			* Méthode : 
			* @return
			*/
		public	function	annul_invitation(	$id	=	false	)
		{
				if(	!request::is_ajax()	||	!$id	)
						return	false;

				$this->class->delete_invitation(	$id	);

				Statistiques_Model::instance()->insertion(	$this->_user->id,	'annul_invitation'	);

				echo	self::liste_actions_gang();
		}

		/**
			* Méthode : 
			* @return
			*/
		public	function	valider_invitation(	$id	=	false	)
		{
				if(	!request::is_ajax()	||	!$id	)
						return	false;

				if(	$id_gang	=	$this->class->invitation_detail(	$id	)	)
				{
						Tchat_Model::instance()->insertion(	$this->_user->username,	$this->_user->username.' vient de quitter le gang',	$this->_user->id_gang,	'gang'	);

						$this->_user->id_gang	=	$id_gang;

						Tchat_Model::instance()->insertion(	$this->_user->username,	$this->_user->username.' vient de rentrer dans le gang',	$this->_user->id_gang,	'gang'	);

						$this->_user->update(	array(	'id_gang'	=>	$id_gang	)	);
				}

				$this->class->delete_invitation(	$id	);

				Statistiques_Model::instance()->insertion(	$this->_user->id,	'valide_invitation'	);

				echo	self::liste_actions_gang();
		}

		/**
			* Méthode : 
			* @return
			*/
		public	function	update_boss(	$id	=	false	)
		{
				if(	!request::is_ajax()	||	!$id	)
						return	false;

				$this->class->change_chef(	$id,	$this->_user->id_gang	);

				echo	self::liste_actions_gang();
		}

}

?>