<?php

defined(	'SYSPATH'	)	or	die(	'No direct access allowed.'	);

class	Batiments_Option_Validation_Controller	extends	Actions_Controller	{

		private	$class;

		/**
			* Méthode : 
			* @return
			*/
		public	function	__construct(	$class	)
		{
				parent::__construct();

				$this->class	=	$class;
		}

		/**
			* Méthode : Acheter un véhicule dans un garage
			* @return
			*/
		public	function	vehicule(	$id	=	false	)
		{
				$vehicule	=	Vehicule_Model::instance();

				if(	$this->_user->id_vehicule	)
				{
						$vehicule->select_id(	$this->_user->id_vehicule	);

						$this->_user->argent	+=	round(	$vehicule->prix_vehicule	/	2	);
						$this->_user->vente_element++;
				}

				$vehicule->select_id(	$id	);

				if(	$vehicule->prix_vehicule	<=	$this->_user->argent	&&	$vehicule->niveau_vehicule	<=	$this->_user->niveau	)
				{
						$this->_user->argent	-=	$vehicule->prix_vehicule;
						$this->_user->id_vehicule	=	$vehicule->id;
						$this->_user->etat_vehicule	=	$vehicule->etat_vehicule;
						$this->_user->reservoir_vehicule	=	$vehicule->reservoir;
						$this->_user->xp++;
						$this->_user->achat_element++;

						$this->_user->modifier();
						Statistiques_Model::instance()->insertion(	$this->_user->id,	'achat_vehicule'	);
				}
		}

		/**
			* Méthode : on achete une arme
			* @return
			*/
		public	function	arme(	$id	=	false	)
		{
				$arme	=	Arme_Model::instance();

				if(	$this->_user->id_arme	)
				{
						$arme->select_id(	$this->_user->id_arme	);

						$this->_user->argent	+=	round(	$arme->prix_arme	/	2	);
						$this->_user->vente_element++;
				}

				$arme->select_id(	$id	);

				if(	$arme->prix_arme	<=	$this->_user->argent	&&	$arme->niveau_arme	<=	$this->_user->niveau	)
				{
						$this->_user->argent	-=	$arme->prix_arme;
						$this->_user->id_arme	=	$arme->id;
						$this->_user->munition	=	$arme->munition_arme;
						$this->_user->xp++;
						$this->_user->achat_element++;

						$this->_user->modifier();
						Statistiques_Model::instance()->insertion(	$this->_user->id,	'achat_arme'	);
				}
		}

		/**
			* Méthode : on achete une protection 
			* @return
			*/
		public	function	protection(	$id	=	false	)
		{
				$protection	=	Protection_Model::instance();

				if(	$this->_user->id_protection	)
				{
						$protection->select_id(	$this->_user->id_protection	);

						$this->_user->argent	+=	round(	$protection->prix_protection	/	2	);
						$this->_user->vente_element++;
				}

				$protection->select_id(	$id	);

				if(	$protection->prix_protection	<=	$this->_user->argent	&&	$protection->niveau_protection	<=	$this->_user->niveau	)
				{
						$this->_user->argent	-=	$protection->prix_protection;
						$this->_user->id_protection	=	$protection->id;
						$this->_user->etat_protection	=	100;
						$this->_user->xp++;
						$this->_user->achat_element++;

						$this->_user->modifier();
						Statistiques_Model::instance()->insertion(	$this->_user->id,	'achat_protection'	);
				}
		}

		/**
			* Méthode : pour la vie c'est un hosto
			* @return
			*/
		public	function	hospital(	$id	=	false	)
		{
				$timer	=	time()	-	$this->_user->time_move;
				$point_gagne	=	floor(	$timer	/	3600	);
				$point_gagne	=	$point_gagne	<	10	?	$point_gagne	:	10;
				$hp	=	$this->_user->hp	+	$point_gagne;
				$prix	=	$this->_user->niveau	<	1	?	round(	5	*	$point_gagne	)	:	round(	$point_gagne	*	100	*	$this->_user->niveau	);

				if(	$point_gagne	>	0	&&	$this->_user->argent	>=	$prix	)
				{
						$this->_user->argent	-=	$prix;
						$this->_user->xp++;
						$this->_user->time_move	=	time();
						$this->_user->achat_element++;
						$this->_user->hp	=	$hp	<	100	?	$hp	:	100;

						$this->_user->modifier();
						Statistiques_Model::instance()->insertion(	$this->_user->id,	'hospital'	);
				}
		}

		/**
			* Méthode : permet de faire des virements et des retraits
			* @return
			*/
		public	function	banque(	$id	=	false	)
		{
				$argent_virement	=	$this->input->get(	'argent_virement'	);
				$argent_retrait	=	$this->input->get(	'argent_retrait'	);
				$argent_user	=	$this->input->get(	'argent_user'	);

				if(	$argent_virement	&&	is_numeric(	$argent_virement	)	&&	$this->_user->argent	>=	$argent_virement	)
				{
						if(	$argent_user	==	$this->_user->id	)
								$this->_user->argent_banque	+=	$argent_virement;
						else
						{
								$perso	=	new	User_Model;

								if(	$perso->selection_id(	$argent_user,	'argent_banque, username'	)	)
								{
										$perso->argent_banque	+=	$argent_virement;

										$perso->update(	array(	'argent_banque'	=>	$perso->argent_banque	)	);

										Tchat_Model::instance()->insertion(	$this->_user->username,	'Virement de '.$this->_user->username.' : '.number_format(	$argent_virement	).' $',	$perso->id_gang,	$perso->username	);

										Statistiques_Model::instance()->insertion(	$perso->id,	'recu_virement'	);
								}
						}

						$this->_user->argent	-=	$argent_virement;

						$this->_user->modifier();

						Tchat_Model::instance()->insertion(	$this->_user->username,	'Virement de : '.number_format(	$argent_virement	).' $',	$this->_user->id_gang,	'alert'	);

						Statistiques_Model::instance()->insertion(	$this->_user->id,	'virement'	);
				}

				if(	$argent_retrait	&&	is_numeric(	$argent_retrait	)	&&	$this->_user->argent_banque	>=	$argent_retrait	)
				{
						$this->_user->argent_banque	-=	$argent_retrait;
						$this->_user->argent	+=	$argent_retrait;

						$this->_user->modifier();

						Tchat_Model::instance()->insertion(	$this->_user->username,	'Retrait de : '.number_format(	$argent_retrait	).' $',	$this->_user->id_gang,	'alert'	);

						Statistiques_Model::instance()->insertion(	$this->_user->id,	'retrait'	);
				}
		}

		/**
			* Méthode : autoroute pour traverser la carte rapidement
			* @return
			*/
		public	function	autoroute(	$id	=	false	)
		{
				$passage	=	$this->_user->id_vehicule	?	true	:	false;

				if(	!$passage	&&	$this->_user->argent	>=	200	)
				{
						$list	=	$this->class->autoroute(	$id	);

						$n_stop	=	rand(	1,	$list->count()	);
						$n	=	1;

						foreach(	$list	as	$val	)
						{
								if(	$n	==	$n_stop	)
								{
										$this->_user->x	=	$val->x;
										$this->_user->y	=	$val->y;
										break;
								}
								else
										$n++;
						}

						$this->_user->argent	-=	200;
						$this->_user->xp++;

						$this->_user->modifier();

						Tchat_Model::instance()->insertion(	$this->_user->username,	'Passage sur l\'autoroute avec le bus',	$this->_user->id_gang,	'alert'	);

						Statistiques_Model::instance()->insertion(	$this->_user->id,	'bus'	);
				}
				elseif(	$passage	&&	$this->_user->argent	>=	100	&&	(	$new_autoroute	=	$this->class->select_id(	$this->input->get(	'autoroute'	)	)	)	)
				{
						$this->_user->argent	-=	100;
						$this->_user->x	=	$new_autoroute->x;
						$this->_user->y	=	$new_autoroute->y;
						$this->_user->xp++;

						$this->_user->modifier();

						Tchat_Model::instance()->insertion(	$this->_user->username,	'Passage sur l\'autoroute',	$this->_user->id_gang,	'alert'	);

						Statistiques_Model::instance()->insertion(	$this->_user->id,	'autoroute'	);
				}
		}

		/**
			* Méthode : le commico pour devenir flic :)
			* @return
			*/
		public	function	commissariat(	$id	=	false	)
		{
				$this->_user->id_gang	=	1;
				$this->_user->xp++;

				$this->_user->modifier();

				$this->class->annuler_toutes_mission(	$this->_user->id	);

				Tchat_Model::instance()->insertion(	$this->_user->username,	'Bienvenue dans la police',	$this->_user->id_gang,	'alert'	);

				Statistiques_Model::instance()->insertion(	$this->_user->id,	'embauche_police'	);

				$from	=	'Wargang <'.Kohana::config(	'game.mail_site'	).'>';
				$subject	=	'Admission dans la police de War Gang';
				$message	=	'Vous venez de rentrer dans la police de War Gang.';

				email::send(	$this->_user->email,	$from,	$subject,	$message,	true	);
		}

		/**
			* Méthode : le commico pour ne plus etre flic
			* @return
			*/
		public	function	demissionner_commissariat(	$id	=	false	)
		{
				$this->_user->id_gang	=	rand(	2,	3	);
				$this->_user->niveau	-=	5;
				$this->_user->xp	=	0;
				$this->_user->id_vehicule	=	0;
				$this->_user->etat_vehicule	=	0;
				$this->_user->reservoir_vehicule	=	0;

				$this->_user->modifier();

				$this->class->annuler_toutes_mission(	$this->_user->id	);

				Tchat_Model::instance()->insertion(	$this->_user->username,	'Démission de votre poste de policier',	$this->_user->id_gang,	'alert'	);

				Statistiques_Model::instance()->insertion(	$this->_user->id,	'demission_police'	);

				$from	=	'Wargang <'.Kohana::config(	'game.mail_site'	).'>';
				$subject	=	'Démission de la police de War Gang';
				$message	=	'Vous avez démissionné de la police de War City.';

				email::send(	$this->_user->email,	$from,	$subject,	$message,	true	);
		}

		/**
			* Méthode : permet de finir le jeu c'est la VICTOIRE
			* @return
			*/
		public	function	victoire(	$id	=	false	)
		{
				$argent	=	0;
				$batiment	=	0;
				$user	=	0;
				$chef	=	false;

				$array	=	false;
				$array['liste_users_victoire']	=	array(	);

				if(	$information	=	$this->class->victoire(	$this->_user->x,	$this->_user->y,	$this->_user->id_gang	)	)
				{
						foreach(	$information	as	$val	)
						{
								$argent	+=	$val->argent;
								$batiment	+=	$val->batiment;
								$array['liste_users_victoire'][]	=	$val->username;
								$user++;

								if(	$this->_user->id	==	$val->id_user_gang	&&	$val->id	==	$val->id_user_gang	)
										$chef	=	true;
						}
				}

				$validation	=	$user	>=	Kohana::config(	'partie.user_total_case_victoire'	)
						&&	$batiment	>=	Kohana::config(	'partie.batiment_victoire'	)
						&&	$this->_user->niveau	>=	Kohana::config(	'partie.level_chef_victoire'	)
						&&	$argent	>=	Kohana::config(	'partie.argent_victoire'	)
						&&	$this->_user->id_gang	>	3
						&&	$chef
						&&	$this->class->verif_en_cours_victoire()	?	true	:	false;

				if(	$validation	)
				{
						$user_actif	=	0;
						$total_user	=	0;
						$argent_user	=	0;
						$flic_user	=	0;

						$users	=	Database::instance()->select(	'argent, argent_banque, id_gang, planque'	)->from(	'users'	)->get();

						if(	$users->count()	)
						{
								foreach(	$users	as	$val	)
								{
										if(	$val->id_gang	==	1	)
												$flic_user++;

										if(	$val->planque	==	0	)
												$user_actif++;

										$argent_user	+=	$val->argent	+	$val->argent_banque;

										$total_user++;
								}
						}

						$gang	=	Gang_Model::instance()->select_id(	$this->_user->id_gang	);

						$array['en_cours_partie']	=	0;
						$array['date_fin_partie']	=	date::NOW();
						$array['liste_users_victoire']	=	@implode(	', ',	$array['liste_users_victoire']	);
						$array['gang_victoire']	=	$gang->nom_gang;
						$array['image_gang']	=	$gang->image_gang;
						$array['slogan_gang']	=	$gang->commentaire_gang;
						$array['argent_victoire']	=	$argent;
						$array['user_actif']	=	$user_actif;
						$array['total_user']	=	$total_user;
						$array['argent_total']	=	$argent_user;
						$array['drogue_total']	=	Database::instance()->select(	'COUNT(id) as nbr'	)->from(	'users_drogues'	)->get()->current()->nbr;
						$array['flic_total']	=	$flic_user;

						$this->class->update_partie(	$array	);

						Tchat_Model::instance()->insertion(	$this->_user->username,	'Le gang de '.$this->_user->username.' vient de gagner le jeu ',	$this->_user->id_gang,	'info'	);

						Statistiques_Model::instance()->insertion(	$this->_user->id,	'victoire_partie'	);
				}
		}

		/**
			* Méthode : gestion de la mafia
			* @return
			*/
		public	function	mafia(	$id	=	false	)
		{
				$type	=	$this->input->get(	'type',	'demande'	);

				if(	$type	==	'valide'	)
						self::valide_mission(	$id	);
				else
						self::demande_mission(	$id	);
		}

		/**
			* Méthode : demander une mission
			* @return
			*/
		public	function	demande_mission(	$id	=	false	)
		{
				$type	=	$this->class->type_mission(	$this->_user->id	);

				$niv	=	$this->_user->niveau	-	10	<	0	?	0	:	$this->_user->niveau	-	10;

				if(	$type	==	1	&&	(	$users	=	$this->class->demande_mission_user(	$niv,	$this->_user->id_gang,	$this->_user->id	)	)	)
				{
						$array	=	array(	'id_mission'	=>	$users->id,
								'type'	=>	'user',
								'argent'	=>	rand(	5000,	50000	),
								'xp'	=>	rand(	$users->xp,	round(	$users->xp	*	10	)	)	);
				}

				if(	$type	==	2	||	(	$type	==	1	&&	isset(	$users	)	&&	!$users	)	)
				{
						$bot	=	$this->class->demande_mission_bot(	$niv	);

						$array	=	array(	'id_mission'	=>	$bot->id,
								'type'	=>	'bot',
								'argent'	=>	rand(	1000,	2000	),
								'xp'	=>	rand(	100,	200	)	);
				}
				elseif(	$type	==	3	)
				{
						$batiment	=	$this->class->demande_mission_batiment();

						$array	=	array(	'id_mission'	=>	$batiment->id,
								'type'	=>	'batiment',
								'argent'	=>	rand(	10000,	200000	),
								'xp'	=>	rand(	400,	1000	)	);
				}
				else
				{
						$vehicule	=	$this->class->demande_mission_vehicule(	$niv,	$this->_user->id_vehicule	);

						$array	=	array(	'id_mission'	=>	$vehicule->id,
								'type'	=>	'vehicule',
								'argent'	=>	round(	($vehicule->prix_vehicule	/	2	)	+	rand(	1000,	20000	)	),
								'xp'	=>	rand(	100,	1000	)	);
				}

				$array['id_user']	=	$this->_user->id;
				$array['date']	=	date::NOW();
				$array['actif']	=	1;
				$array['id_combat']	=	0;

				Database::instance()->insert(	'users_mission',	$array	);

				Tchat_Model::instance()->insertion(	$this->_user->username,	'Demande de mission',	$this->_user->id_gang,	'alert'	);
		}

		/**
			* Méthode : valider une mission
			* @return
			*/
		public	function	valide_mission(	$id	=	false	)
		{
				$missions	=	$this->class->verif_mission(	$this->_user->id	);

				if(	$missions->count()	)
				{
						foreach(	$missions	as	$val	)
						{
								if(	!$val->id_combat	&&	$val->actif	)
								{
										if(	$val->type	!=	'vehicule'	)
										{
												if(	(	$v	=	$this->class->valide_mission(	$val->type,	$this->_user->id,	$val->id_mission,	$val->date	)	)	&&	!$v->id_users_mission	)
												{
														$this->_user->argent	+=	$val->argent;
														$this->_user->xp	+=	$val->xp;
														$this->_user->mission++;
														$this->_user->modifier();

														$this->class->mission(	array(	'actif'	=>	0,	'id_combat'	=>	$v->id	),	$val->id	);

														Tchat_Model::instance()->insertion(	$this->_user->username,	'Validation de la missions n&deg; '.number_format(	$val->id	),	$this->_user->id_gang,	'alert'	);
												}
										}
										elseif(	$val->id_mission	==	$this->_user->id_vehicule	)
										{
												$this->_user->argent	+=	$val->argent;
												$this->_user->xp	+=	$val->xp;
												$this->_user->mission++;
												$this->_user->modifier();

												$this->class->mission(	array(	'actif'	=>	0	),	$val->id	);

												Tchat_Model::instance()->insertion(	$this->_user->username,	'Validation de la missions n&deg; '.number_format(	$val->id	),	$this->_user->id_gang,	'alert'	);
										}
								}
						}
				}
		}

		/**
			* Méthode : 
			* @return
			*/
		public	function	depot_parking(	$id	=	false	)
		{
				$prix	=	$this->input->get(	'prix_depot'	);

				$array	=	array(	'id_user'	=>	$this->_user->id,
						'id_vehicule'	=>	$this->_user->id_vehicule,
						'prix_ventre_parking'	=>	$prix,
						'date_parking'	=>	date::NOW(),
						'x_parking'	=>	$this->_user->x,
						'y_parking'	=>	$this->_user->y,
						'etat_parking'	=>	$this->_user->etat_vehicule,
						'reservoir_parking'	=>	$this->_user->reservoir_vehicule	);

				$this->class->depot_vehicule(	$array	);

				$this->_user->id_vehicule	=	0;
				$this->_user->etat_vehicule	=	0;
				$this->_user->reservoir_vehicule	=	0;
				$this->_user->modifier();
		}

		/**
			* Méthode : 
			* @return
			*/
		public	function	recuperer_parking(	$id	=	false	)
		{
				if(	$detail	=	$this->class->recuperer_vehicule(	$id	)	)
				{
						$commission	=	round(	$detail->prix_ventre_parking	*	(	5	/	100	)	);

						if(	$this->_user->id	!=	$detail->id_user	)
						{
								if(	$this->_user->argent	<	$detail->prix_ventre_parking	)
										return;

								$this->class->argent_vente_parking(	$detail->id_user,	(	$detail->prix_ventre_parking	-	$commission	)	);
								$this->_user->argent	-=	$detail->prix_ventre_parking;
						}
						else
						{
								if(	$this->_user->argent	<	$commission	)
										return;

								$this->_user->argent	-=	$commission;
						}

						$this->_user->id_vehicule	=	$detail->id_vehicule;
						$this->_user->etat_vehicule	=	$detail->etat_parking;
						$this->_user->reservoir_vehicule	=	$detail->reservoir_parking;
						$this->_user->modifier();

						$this->class->delete_parking(	$id	);
				}
		}

		/**
			* Méthode : gestion de la mafia
			* @return
			*/
		public	function	sport()
		{
				$sport	=	Sport_Model::instance();

				if(	$match_en_cours	=	$sport->match_en_cours()	)
				{
						$array['id_match']	=	$match_en_cours->id;
						$array['id_user']	=	$this->_user->id;
						$array['date']	=	date::NOW();
						$array['actif']	=	1;

						$argent	=	0;

						if(	(	$argent_domicile	=	$this->input->get(	'argent_domicile'	)	)	&&	is_numeric(	$argent_domicile	)	&&	$this->_user->argent	>=	$argent_domicile	)
						{
								$array['argent']	=	$argent_domicile;
								$array['id_equipe']	=	$match_en_cours->equipe_domicile;

								$this->class->insert_paris(	$array	);

								$this->_user->argent	-=	round(	$argent_domicile	);
								$this->_user->modifier();

								$argent	+=	round(	$argent_domicile	);
						}

						if(	(	$argent_visiteur	=	$this->input->get(	'argent_visiteur'	)	)	&&	is_numeric(	$argent_visiteur	)	&&	$this->_user->argent	>=	$argent_visiteur	)
						{
								$array['argent']	=	$argent_visiteur;
								$array['id_equipe']	=	$match_en_cours->equipe_visiteur;

								$this->class->insert_paris(	$array	);

								$this->_user->argent	-=	round(	$argent_visiteur	);
								$this->_user->modifier();

								$argent	+=	round(	$argent_visiteur	);
						}

						if(	$argent	)
								Tchat_Model::instance()->insertion(	$this->_user->username,	$this->_user->username.' vient de parier sur un match pour la somme de '.number_format(	$argent	).' $',	$this->_user->id_gang,	'info'	);
				}
		}

}

?>