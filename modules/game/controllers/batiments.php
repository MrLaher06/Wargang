<?php

defined(	'SYSPATH'	)	or	die(	'No direct access allowed.'	);

class	Batiments_Controller	extends	Actions_Controller	{

		private	$class;

		/**
			* Méthode : 
			* @return
			*/
		public	function	__construct()
		{
				parent::__construct();

				$this->class	=	Batiment_Model::instance();
		}

		/**
			* Méthode : 
			* @return
			*/
		public	function	index()
		{
				if(	!request::is_ajax()	||	$this->_user->planque	)
						return	false;

				parent::index();
		}

		/**
			* Méthode : 
			* @return
			*/
		public	function	liste()
		{
				if(	$this->_user->planque	)
						return	false;

				if(	$list	=	$this->class->listing()	)
				{
						$v	=	new	View(	'batiments/liste'	);
						$v->resultat	=	$list;
						$v->render(	true	);
				}
		}

		/**
			* Méthode : 
			* @return
			*/
		public	function	visite()
		{
				if(	!request::is_ajax()	||	$this->_user->planque	)
						return	false;

				if(	$bat	=	$this->class->selection(	$this->_user->x,	$this->_user->y	)	)
				{
						$option_bat	=	new	Batiments_Option_Controller(	$this->class	);

						switch(	$bat->type_option	)
						{
								case	'vehicule'	:
										$option_bat->vehicule(	$bat	);
										break;
								case	'banque'	:
										$option_bat->banque(	$bat	);
										break;
								case	'mafia'	:
										$option_bat->mafia(	$bat	);
										break;
								case	'arme'	:
										$option_bat->arme(	$bat	);
										break;
								case	'protection'	:
										$option_bat->protection(	$bat	);
										break;
								case	'autoroute'	:
										$option_bat->autoroute(	$bat	);
										break;
								case	'parking'	:
										$option_bat->parking(	$bat	);
										break;
								case	'hospital'	:
										$option_bat->hospital(	$bat	);
										break;
								case	'victoire'	:
										$option_bat->victoire(	$bat	);
										break;
								case	'commissariat'	:
										$option_bat->commissariat(	$bat	);
										break;
								case	'penitencier'	:
										$option_bat->penitencier(	$bat	);
										break;
								case	'casino'	:
										$option_bat->casino(	$bat	);
										break;
								case	'sport'	:
										$option_bat->sport(	$bat	);
										break;
								case	'musique'	:
										$option_bat->musique(	$bat	);
										break;
						}
				}

				$menu	=	new	View(	'batiments/menu_options'	);
				$menu->render(	true	);

				Statistiques_Model::instance()->insertion(	$this->_user->id,	'visite'	);

				$this->_user->modifier();
		}

		/**
			* Méthode : 
			* @return
			*/
		public	function	element(	$type,	$id	=	false	)
		{
				if(	$bat	=	$this->class->selection(	$this->_user->x,	$this->_user->y	)	)
				{
						$valide_bat	=	new	Batiments_Option_Validation_Controller(	$this->class	);

						switch(	$type	)
						{
								case	'vehicule'	:
										$valide_bat->vehicule(	$id	);
										break;
								case	'banque'	:
										$valide_bat->banque(	$id	);
										break;
								case	'mafia'	:
										$valide_bat->mafia(	$id	);
										self::visite();
										return;
										break;
								case	'arme'	:
										$valide_bat->arme(	$id	);
										break;
								case	'protection'	:
										$valide_bat->protection(	$id	);
										break;
								case	'autoroute'	:
										$valide_bat->autoroute(	$id	);
										break;
								case	'hospital'	:
										$valide_bat->hospital(	$id	);
										break;
								case	'victoire'	:
										$valide_bat->victoire(	$id	);
										break;
								case	'commissariat'	:
										$valide_bat->commissariat(	$id	);
										break;
								case	'demissionner_commissariat'	:
										$valide_bat->demissionner_commissariat(	$id	);
										break;
								case	'sport'	:
										$valide_bat->sport();
										break;
								case	'depot_parking'	:
										$valide_bat->depot_parking(	$id	);
										self::visite();
										return;
										break;
								case	'recuperer_parking'	:
										$valide_bat->recuperer_parking(	$id	);
										self::visite();
										return;
										break;
						}
				}
				parent::index();
		}

		/**
			* Méthode : 
			* @return
			*/
		public	function	achat()
		{
				if(	$bat	=	$this->class->selection(	$this->_user->x,	$this->_user->y	)	)
				{
						if(	$bat->prix_achat	<=	$this->_user->argent	)
						{
								Journal_Model::instance()->acheter_batiment(	$this->_user,	$bat	);

								$this->_user->argent	-=	$bat->prix_achat;
								$this->_user->xp++;
								$this->_user->achat_batiment++;

								$this->_user->modifier();

								Statistiques_Model::instance()->insertion(	$this->_user->id,	'achat_batiment'	);

								if(	$bat->id_user	)
								{
										self::vente(	$bat->id_user,	$bat->prix_achat	);
										Statistiques_Model::instance()->insertion(	$bat->id_user,	'vente_batiment'	);
								}

								$bat->prix_achat	+=	round(	$bat->prix_achat	/	rand(	10,	30	)	);
								$bat->id_user	=	$this->_user->id;
								$bat->id_gang	=	$this->_user->id_gang;
								$bat->proprio	=	$this->_user->username;

								unset(	$bat->nom_gang,	$bat->couleur_gang,	$bat->id_user_gang,	$bat->image_gang,	$bat->commentaire_gang,	$bat->protection_max	);

								foreach(	$bat	as	$key	=>	$val	)
										$array[$key]	=	$val;

								$this->class->update(	$array,	$bat->id	);
						}
				}
				parent::index();
		}

		/**
			* Méthode : 
			* @return
			*/
		private	static	function	vente(	$id_proprio,	$prix	)
		{
				$perso	=	new	User_Model;

				$perso->selection_id(	$id_proprio,	'argent, xp, vente_batiment'	);

				$perso->xp++;
				$perso->vente_batiment++;
				$perso->argent	+=	$prix;

				return	$perso->update(	array(	'argent'	=>	$perso->argent,	'xp'	=>	$perso->xp,	'vente_batiment'	=>	$perso->vente_batiment	)	);
		}

		/**
			* Méthode : 
			* @return
			*/
		public	function	essence()
		{
				$vehicule	=	Vehicule_Model::instance()->select_id(	$this->_user->id_vehicule	);

				$prix_essence	=	round(	$this->_user->niveau	*	100	)	+	10;

				if(	$prix_essence	<=	$this->_user->argent	)
				{
						$this->_user->argent	-=	$prix_essence;
						$this->_user->reservoir_vehicule	=	$vehicule->reservoir;
						$this->_user->xp++;
						$this->_user->achat_element++;

						$this->_user->modifier();

						Statistiques_Model::instance()->insertion(	$this->_user->id,	'essence'	);
				}

				parent::index();
		}

		/**
			* Méthode : 
			* @return
			*/
		public	function	munition()
		{
				$arme	=	Arme_Model::instance()->select_id(	$this->_user->id_arme	);

				if(	$arme->prix_munition	<=	$this->_user->argent	)
				{
						$this->_user->argent	-=	$arme->prix_munition;
						$this->_user->munition	=	$arme->munition_arme;
						$this->_user->xp++;
						$this->_user->achat_element++;

						$this->_user->modifier();

						Statistiques_Model::instance()->insertion(	$this->_user->id,	'munition'	);
				}

				parent::index();
		}

}

?>