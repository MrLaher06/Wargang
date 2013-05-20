<?php

defined(	'SYSPATH'	)	or	die(	'No direct access allowed.'	);

class	Batiments_Option_Controller	extends	Actions_Controller	{

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
			* Méthode : 
			* @return
			*/
		public	function	vehicule(	$bat	=	false	)
		{
				$vehicule	=	Vehicule_Model::instance()->select_id(	$this->_user->id_vehicule	);

				$view	=	new	View(	'batiments/options/vehicule'	);
				$view->liste_vehicule	=	$this->class->vehicule(	$bat->id	);
				$view->niveau	=	$this->_user->niveau;
				$view->flic	=	$this->_user->id_gang	===	1	?	true	:	false;
				$view->recharge	=	(	$this->_user->id_vehicule	&&	(	$this->_user->reservoir_vehicule	<	$vehicule->reservoir	)	)	?	$vehicule	:	false;
				$view->render(	true	);
		}

		/**
			* Méthode : 
			* @return
			*/
		public	function	arme(	$bat	=	false	)
		{
				$arme	=	Arme_Model::instance()->select_id(	$this->_user->id_arme	);

				$view	=	new	View(	'batiments/options/arme'	);
				$view->liste_arme	=	$this->class->arme();
				$view->niveau	=	$this->_user->niveau;
				$view->recharge	=	(	$this->_user->id_arme	&&	(	$this->_user->munition	<	$arme->munition_arme	)	)	?	$arme	:	false;
				$view->render(	true	);
		}

		/**
			* Méthode : 
			* @return
			*/
		public	function	protection(	$bat	=	false	)
		{
				$view	=	new	View(	'batiments/options/protection'	);
				$view->liste_protection	=	$this->class->protection();
				$view->niveau	=	$this->_user->niveau;
				$view->render(	true	);
		}

		/**
			* Méthode : 
			* @return
			*/
		public	function	banque(	$bat	=	false	)
		{
				$banques	=	$this->class->listing(	'banque'	);

				foreach(	$banques	as	$val	)
						$position[$val->x.'-'.$val->y]	=	true;

				$view	=	new	View(	'batiments/options/banque'	);
				$view->liste_user	=	$this->class->banque_users(	$this->_user->id,	$this->_user->id_gang	);
				$view->id_user	=	$this->_user->id;
				$view->argent_banque	=	$this->_user->argent_banque;
				$view->virement	=	$this->_user->niveau	>=	5	?	true	:	false;
				$view->carte	=	new	View(	'carte/mini_map'	);
				$view->carte->data	=	$position;
				$view->liste_banque	=	$banques;
				$view->bat	=	$bat;
				$view->render(	true	);
		}

		/**
			* Méthode : 
			* @return
			*/
		public	function	hospital(	$bat	=	false	)
		{
				$timer	=	time()	-	$this->_user->time_move;
				$point_gagne	=	floor(	$timer	/	3600	);
				$point_gagne	=	$point_gagne	<	10	?	$point_gagne	:	10;
				$hp	=	$this->_user->hp	+	$point_gagne;
				$prix	=	$this->_user->niveau	<	1	?	round(	5	*	$point_gagne	)	:	round(	$point_gagne	*	100	*	$this->_user->niveau	);

				$view	=	new	View(	'batiments/options/hospital'	);
				$view->temps	=	date::convertir_date(	$timer	);
				$view->point_gagner	=	$point_gagne;
				$view->point_total	=	$hp	<	100	?	$hp	:	100;
				$view->prix	=	$prix;
				$view->id	=	$bat->id;
				$view->render(	true	);
		}

		/**
			* Méthode : 
			* @return
			*/
		public	function	victoire(	$bat	=	false	)
		{
				$argent	=	0;
				$batiment	=	0;
				$user	=	0;
				$chef	=	false;

				if(	$information	=	$this->class->victoire(	$this->_user->x,	$this->_user->y,	$this->_user->id_gang	)	)
				{
						foreach(	$information	as	$val	)
						{
								$argent	+=	$val->argent;
								$batiment	+=	$val->batiment;
								$user++;

								if(	$this->_user->id	==	$val->id_user_gang	&&	$val->id	==	$val->id_user_gang	)
										$chef	=	true;
						}
				}

				$view	=	new	View(	'batiments/options/victoire'	);
				$view->argent	=	$argent;
				$view->batiment	=	$batiment;
				$view->bat	=	$bat;
				$view->nbr	=	$user;
				$view->chef	=	$chef;
				$view->niveau	=	$this->_user->niveau;
				$view->valide_gang	=	$this->_user->id_gang	>	3	?	'vert'	:	'rouge';
				$view->valide_niveau	=	$this->_user->niveau	>=	Kohana::config(	'partie.level_chef_victoire'	)	?	'vert'	:	'rouge';
				$view->valide_argent	=	$argent	>=	Kohana::config(	'partie.argent_victoire'	)	?	'vert'	:	'rouge';
				$view->valide_batiment	=	$batiment	>=	Kohana::config(	'partie.batiment_victoire'	)	?	'vert'	:	'rouge';
				$view->valide_user	=	$user	>=	Kohana::config(	'partie.user_total_case_victoire'	)	?	'vert'	:	'rouge';
				$view->valide_chef	=	$chef	?	'vert'	:	'rouge';

				$view->valide_button	=	$user	>=	Kohana::config(	'partie.user_total_case_victoire'	)
						&&	$batiment	>=	Kohana::config(	'partie.batiment_victoire'	)
						&&	$argent	>=	Kohana::config(	'partie.argent_victoire'	)
						&&	$this->_user->niveau	>=	Kohana::config(	'partie.level_chef_victoire'	)
						&&	$this->_user->id_gang	>	3
						&&	$chef
						&&	$this->class->verif_en_cours_victoire()	?	true	:	false;

				$view->render(	true	);
		}

		/**
			* Méthode : 
			* @return
			*/
		public	function	autoroute(	$bat	=	false	)
		{
				$list_autoroute	=	$this->class->autoroute();

				$position[$this->_user->x.'-'.$this->_user->y]	=	true;

				foreach(	$list_autoroute	as	$val	)
						if(	$bat->id	!=	$val->id	)
								$position[$val->x.'-'.$val->y]	=	true;

				$view	=	new	View(	'batiments/options/autoroute'	);
				$view->liste_autoroute	=	$list_autoroute;
				$view->passage	=	$this->_user->id_vehicule	?	true	:	false;
				$view->carte	=	new	View(	'carte/mini_map'	);
				$view->carte->data	=	$position;
				$view->bat	=	$bat;
				$view->render(	true	);
		}

		/**
			* Méthode : 
			* @return
			*/
		public	function	commissariat(	$bat	=	false	)
		{
				$nbr_total	=	$this->class->liste_police_users();

				if(	$nbr_total->count()	)
						foreach(	$nbr_total	as	$val	)
								$liste_user[]	=	'<span class="name_tchat">'.$val->username.'</span>';

				$view	=	new	View(	'batiments/options/commissariat'	);
				$view->user	=	$this->_user;
				$view->nbr_total_flic_possible	=	4;
				$view->nbr_flic_actuel	=	$nbr_total->count();
				$view->liste_flic	=	$nbr_total->count()	?	implode(	', ',	$liste_user	)	:	'Aucun policier pour le moment';
				$view->bat	=	$bat;
				$view->render(	true	);
		}

		/**
			* Méthode : 
			* @return
			*/
		public	function	mafia(	$bat	=	false	)
		{
				$mission_total	=	0;
				$mission_en_cour	=	0;
				$mission_user	=	0;
				$mission_bot	=	0;
				$mission_batiment	=	0;
				$mission_vehicule	=	0;
				$liste_mission	=	false;

				$missions	=	$this->class->verif_mission(	$this->_user->id	);

				if(	$missions->count()	)
				{
						foreach(	$missions	as	$val	)
						{
								$mission_total++;

								if(	!$val->id_combat	)
								{
										if(	$val->type	==	'user'	&&	$val->actif	)
										{
												$user_detail	=	$this->class->option_mission(	'username',	'users',	$val->id_mission	);
												if(	$user_detail->count()	)
												{
														$mission_en_cour++;
														$liste_mission[]	=	'<strong class="orange">Cible</strong> : '.$user_detail->current()->username
																.' pour : <strong class="vert">'.number_format(	$val->argent	).'</strong> $ et  <strong class="bleu">'.number_format(	$val->xp	).'</strong> XP.';
												}
										}
										elseif(	$val->type	==	'bot'	&&	$val->actif	)
										{
												$ennemis_detail	=	$this->class->option_mission(	'nom',	'ennemis',	$val->id_mission	);
												if(	$ennemis_detail->count()	)
												{
														$mission_en_cour++;
														$liste_mission[]	=	'<strong class="orange">Habitant</strong> : '.$ennemis_detail->current()->nom
																.' pour <strong class="vert">'.number_format(	$val->argent	).'</strong> $ et  <strong class="bleu">'.number_format(	$val->xp	).'</strong> XP.';
												}
										}
										elseif(	$val->type	==	'batiment'	&&	$val->actif	)
										{
												$batiment_detail	=	$this->class->option_mission(	'nom',	'carte',	$val->id_mission	);
												if(	$batiment_detail->count()	)
												{
														$mission_en_cour++;
														$liste_mission[]	=	'<strong class="orange">Braquage</strong> : '.$batiment_detail->current()->nom
																.' pour <strong class="vert">'.number_format(	$val->argent	).'</strong> $ et <strong class="bleu">'.number_format(	$val->xp	).'</strong> XP.';
												}
										}
										elseif(	$val->type	==	'vehicule'	&&	$val->actif	)
										{
												$vehicule_detail	=	$this->class->option_mission(	'name_vehicule',	'vehicules',	$val->id_mission	);
												if(	$vehicule_detail->count()	)
												{
														$mission_en_cour++;
														$liste_mission[]	=	'<strong class="orange">Véhicule</strong> : '.$vehicule_detail->current()->name_vehicule
																.' pour <strong class="vert">'.number_format(	$val->argent	).'</strong> $ et <strong class="bleu">'.number_format(	$val->xp	).'</strong> XP.';
												}
										}
								}

								if(	$val->type	==	'user'	)
										$mission_user++;
								elseif(	$val->type	==	'bot'	)
										$mission_bot++;
								elseif(	$val->type	==	'batiment'	)
										$mission_batiment++;
								elseif(	$val->type	==	'vehicule'	)
										$mission_vehicule++;
						}
				}

				$view	=	new	View(	'batiments/options/mafia'	);
				$view->bat	=	$bat;
				$view->gang	=	$this->_user->id_gang	!=	1	?	true	:	false;
				$view->mission_total	=	$mission_total;
				$view->mission_en_cour	=	$mission_en_cour;
				$view->mission_user	=	$mission_user;
				$view->mission_bot	=	$mission_bot;
				$view->mission_batiment	=	$mission_batiment;
				$view->mission_vehicule	=	$mission_vehicule;
				$view->liste_en_cours	=	$liste_mission;
				$view->render(	true	);
		}

		/**
			* Méthode : 
			* @return
			*/
		public	function	parking(	$bat	=	false	)
		{
				$vehicule	=	Vehicule_Model::instance()->select_id(	$this->_user->id_vehicule	);

				$view	=	new	View(	'batiments/options/parking'	);
				$view->niveau	=	$this->_user->niveau;
				$view->flic	=	$this->_user->id_gang	===	1	?	true	:	false;
				$view->prix_min	=	$this->_user->id_vehicule	?	round(	$vehicule->prix_vehicule	/	2	)	:	false;
				$view->prix_max	=	$this->_user->id_vehicule	?	$vehicule->prix_vehicule	:	false;
				$view->recharge	=	(	$this->_user->id_vehicule	&&	(	$this->_user->reservoir_vehicule	<	$vehicule->reservoir	)	)	?	$vehicule	:	false;
				$view->list_parking	=	$this->class->list_parking(	$this->_user->x,	$this->_user->y	);
				$view->id	=	$bat->id;
				$view->render(	true	);
		}

		/**
			* Méthode : 
			* @return
			*/
		public	function	penitencier(	$bat	=	false	)
		{
				$list	=	Database::instance()->from(	'users'	)->join(	'gangs',	'gangs.id',	'users.id_gang',	'LEFT'	)->where(	'prison !=',	0	)->get();

				$view	=	new	View(	'batiments/options/penitencier'	);
				$view->nbr_prisonniers	=	$list->count();

				if(	$list->count()	)
				{
						$view->prisonniers	=	new	View(	'score/conteneur'	);
						$view->prisonniers->home	=	true;
						$view->prisonniers->titre	=	true;
						$view->prisonniers->resultat	=	$list;
				}

				$view->render(	true	);
		}

		/**
			* Méthode : 
			* @return
			*/
		public	function	casino(	$bat	=	false	)
		{
				$view	=	new	View(	'batiments/options/casino'	);
				$view->argent	=	$this->_user->argent;
				$view->render(	true	);
		}

		/**
			* Méthode : 
			* @return
			*/
		public	function	sport(	$bat	=	false	)
		{
				$view	=	new	View(	'batiments/options/sport'	);

				$sport	=	Sport_Model::instance();

				if(	$match_en_cours	=	$sport->match_en_cours()	)
				{
						$select	=	'image, id, name';
						$view->equipe_domicile	=	$sport->detail_equipe(	$match_en_cours->equipe_domicile,	$select	);
						$view->equipe_visiteur	=	$sport->detail_equipe(	$match_en_cours->equipe_visiteur,	$select	);
						$view->match_en_cours	=	$match_en_cours;
				}

				if(	$list	=	$sport->liste_equipe()	)
						$view->equipes	=	$list;

				$view->render(	true	);
		}

		/**
			* Méthode : 
			* @return
			*/
		public	function	musique(	$bat	=	false	)
		{
				if(	$stream	=	fopen(	'http://www.cosmichiphop.com/flux-wargang.php',	'r'	)	)
				{
						$page	=	stream_get_contents(	$stream	);

						echo	utf8_encode(	$page	);

						fclose(	$stream	);
				}
		}

}

?>