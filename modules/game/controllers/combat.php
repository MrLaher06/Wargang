<?php

defined(	'SYSPATH'	)	or	die(	'No direct access allowed.'	);

class	Combat_Controller	extends	Actions_Controller	{

		private	$class;

		/**
			* Méthode : 
			* @return
			*/
		public	function	__construct()
		{
				parent::__construct();

				$this->class	=	Combats_Model::instance();
		}

		/**
			* Méthode : 
			* @return
			*/
		public	function	index()
		{
				if(	!request::is_ajax()	||	$this->_user->planque	||	$this->_user->prison()	)
						return	false;

				parent::index();
		}

		/**
			* Méthode : 
			* @return
			*/
		public	function	prepare_attaque_bot(	$id_bot	)
		{
				if(	!request::is_ajax()	||	$this->_user->planque	||	$this->_user->prison()	)
						return	false;

				Tchat_Model::instance()->insertion(	$this->_user->username,	'Action de votre gang contre un bot en cours',	$this->_user->id_gang,	'gang'	);
				Statistiques_Model::instance()->insertion(	$this->_user->id,	'prepare_attaque_bot'	);

				$this->class->enregistrement_prepare_combat_bot(	$id_bot,	$this->_user->x,	$this->_user->y,	$this->_user->id,	$this->_user->id_gang	);
				parent::index();
		}

		/**
			* Méthode : 
			* @return
			*/
		public	function	participer_attaque_bot(	$id_combat	)
		{
				if(	!request::is_ajax()	||	$this->_user->planque	||	$this->_user->prison()	)
						return	false;

				Statistiques_Model::instance()->insertion(	$this->_user->id,	'participe_attaque_bot'	);

				$this->class->enregistrement_participer_combat_bot(	$id_combat,	$this->_user->x,	$this->_user->y,	$this->_user->id,	$this->_user->id_gang	);
				parent::index();
		}

		/**
			* Méthode : 
			* @return
			*/
		public	function	lancer_attaque_bot(	$id_combat	)
		{
				if(	!request::is_ajax()	||	$this->_user->planque	||	$this->_user->prison()	)
						return	false;

				$valide	=	self::calcul_combat_bot(	$id_combat	)	?	1	:	0;
				Statistiques_Model::instance()->insertion(	$this->_user->id,	'lancer_attaque_bot'	);

				$this->class->delete_combat(	$id_combat,	false,	$valide	);
				parent::index();
		}

		/**
			* Méthode : 
			* @return
			*/
		public	function	prepare_attaque_user(	$id_user	)
		{
				if(	!request::is_ajax()	||	$this->_user->planque	||	$this->_user->prison()	)
						return	false;

				Tchat_Model::instance()->insertion(	$this->_user->username,	'Action de votre gang contre un gangster en cours',	$this->_user->id_gang,	'gang'	);
				Statistiques_Model::instance()->insertion(	$this->_user->id,	'prepare_attaque_user'	);

				$this->class->enregistrement_prepare_combat_user(	$id_user,	$this->_user->x,	$this->_user->y,	$this->_user->id,	$this->_user->id_gang	);
				parent::index();
		}

		/**
			* Méthode : 
			* @return
			*/
		public	function	participer_attaque_user(	$id_combat	)
		{
				if(	!request::is_ajax()	||	$this->_user->planque	||	$this->_user->prison()	)
						return	false;

				Statistiques_Model::instance()->insertion(	$this->_user->id,	'participe_attaque_user'	);

				$this->class->enregistrement_participer_combat_user(	$id_combat,	$this->_user->x,	$this->_user->y,	$this->_user->id,	$this->_user->id_gang	);
				parent::index();
		}

		/**
			* Méthode : 
			* @return
			*/
		public	function	lancer_attaque_user(	$id_combat	)
		{
				if(	!request::is_ajax()	||	$this->_user->planque	||	$this->_user->prison()	)
						return	false;

				$valide	=	self::calcul_combat_user(	$id_combat	)	?	1	:	0;
				Statistiques_Model::instance()->insertion(	$this->_user->id,	'lancer_attaque_user'	);

				$this->class->delete_combat(	$id_combat,	$this->_user->id,	$valide	);
				parent::index();
		}

		/**
			* Méthode : 
			* @return
			*/
		public	function	prepare_attaque_batiment(	$id_batiment	)
		{
				if(	!request::is_ajax()	||	$this->_user->planque	||	$this->_user->prison()	)
						return	false;

				Tchat_Model::instance()->insertion(	$this->_user->username,	'Action de votre gang pour un braquage en cours',	$this->_user->id_gang,	'gang'	);
				Statistiques_Model::instance()->insertion(	$this->_user->id,	'prepare_braquage'	);

				$this->class->enregistrement_prepare_combat_batiment(	$id_batiment,	$this->_user->x,	$this->_user->y,	$this->_user->id,	$this->_user->id_gang	);
				parent::index();
		}

		/**
			* Méthode : 
			* @return
			*/
		public	function	participer_attaque_batiment(	$id_combat	)
		{
				if(	!request::is_ajax()	||	$this->_user->planque	||	$this->_user->prison()	)
						return	false;

				Statistiques_Model::instance()->insertion(	$this->_user->id,	'particpe_braquage'	);

				$this->class->enregistrement_participer_combat_batiment(	$id_combat,	$this->_user->x,	$this->_user->y,	$this->_user->id,	$this->_user->id_gang	);
				parent::index();
		}

		/**
			* Méthode : 
			* @return
			*/
		public	function	lancer_attaque_batiment(	$id_combat	)
		{
				if(	!request::is_ajax()	||	$this->_user->planque	||	$this->_user->prison()	)
						return	false;

				$valide	=	self::calcul_combat_batiment(	$id_combat	)	?	1	:	0;
				Statistiques_Model::instance()->insertion(	$this->_user->id,	'lancer_braquage'	);

				$this->class->delete_combat(	$id_combat,	false,	$valide	);
				parent::index();
		}

		/**
			* Méthode : 
			* @return
			*/
		public	function	annuler_attaque(	$id_combat	)
		{
				if(	!request::is_ajax()	||	$this->_user->planque	||	$this->_user->prison()	)
						return	false;

				Tchat_Model::instance()->insertion(	$this->_user->username,	'Action de votre gang annulé',	$this->_user->id_gang,	'gang'	);
				Statistiques_Model::instance()->insertion(	$this->_user->id,	'annuler'	);

				$this->class->delete_combat(	$id_combat	);
				parent::index();
		}

		/**
			* Méthode : 
			* @return
			*/
		private	function	calcul_combat_bot(	$id_combat	)
		{
				$nbr_attaquant	=	1;
				$message_tchat	=	false;

				$rapport	=	$this->class->calcul_combat_bot(	$id_combat	);

				if(	isset(	$rapport['aide']	)	)
						$nbr_attaquant	+=	count(	$rapport['aide']	);

				if(	rand(	0,	1	)	)
				{
						if(	$rapport['resultat']	==	'VICTOIRE'	)
								Journal_Model::instance()->attaque_victoire_bot(	$this->_user,	$rapport['defense'],	$rapport['argent'],	$nbr_attaquant	);
						else
								Journal_Model::instance()->attaque_defaite_bot(	$this->_user,	$rapport['defense'],	$rapport['argent'],	$nbr_attaquant	);
				}

				if(	$rapport['resultat']	==	'VICTOIRE'	)
						return	true;

				return	false;
		}

		/**
			* Méthode : 
			* @return
			*/
		private	function	calcul_combat_batiment(	$id_combat	)
		{
				$rapport	=	$this->class->calcul_combat_batiment(	$id_combat	);

				$nbr_attaquant	=	1;

				if(	isset(	$rapport['aide']	)	)
						$nbr_attaquant	+=	count(	$rapport['aide']	);

				if(	$rapport['resultat']	==	'VICTOIRE'	)
						self::tchat(	$this->_user->username.' vient de réussir son braquage'	);
				else
						self::tchat(	$this->_user->username.' vient de louper son braquage'	);

				if(	rand(	0,	1	)	)
				{
						if(	$rapport['resultat']	==	'VICTOIRE'	)
								Journal_Model::instance()->braquer_batiment_victoire(	$this->_user,	$rapport['batiment'],	$rapport['argent'],	$nbr_attaquant	);
						else
								Journal_Model::instance()->braquer_batiment_defaite(	$this->_user,	$rapport['batiment'],	$rapport['argent'],	$nbr_attaquant	);
				}

				if(	$rapport['resultat']	==	'VICTOIRE'	)
						return	true;

				return	false;
		}

		/**
			* Méthode : 
			* @return
			*/
		private	function	calcul_combat_user(	$id_combat	)
		{
				if(	$rapport	=	$this->class->calcul_combat_user(	$id_combat	)	)
				{
						$nbr_attaquant	=	1;

						if(	isset(	$rapport['aide']	)	)
								$nbr_attaquant	+=	count(	$rapport['aide']	);

						if(	$rapport['resultat']	==	'VICTOIRE'	)
								self::tchat(	$this->_user->username.' vient de réussir son combat'	);
						else
								self::tchat(	$this->_user->username.' vient de louper son combat'	);

						if(	rand(	0,	1	)	)
						{
								if(	$rapport['resultat']	==	'VICTOIRE'	)
										Journal_Model::instance()->attaque_victoire(	$this->_user,	$rapport['user_defense'],	$rapport['argent'],	$nbr_attaquant	);
								else
										Journal_Model::instance()->attaque_defaite(	$this->_user,	$rapport['user_defense'],	$rapport['argent'],	$nbr_attaquant	);
						}

						if(	$rapport['resultat']	==	'VICTOIRE'	)
								return	true;
				}
				else
						Statistiques_Model::instance()->insertion(	$this->_user->id,	'combat_user_disparu'	);

				return	false;
		}

		private	function	tchat(	$txt	=	false	)
		{
				Tchat_Model::instance()->insertion(	$this->_user->username,	$txt.' <a href=\'javascript:;\' onclick=\'panelAfficher("center","journal","'.url::base(	TRUE	).'journal.html","Journal","Journal");\'>Voir sur le journal</a>',	$this->_user->id_gang,	'info'	);
		}

}

?>