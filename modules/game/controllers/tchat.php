<?php

defined(	'SYSPATH'	)	or	die(	'No direct access allowed.'	);

class	Tchat_Controller	extends	System_Controller	{

		private	$class;

		/**
			* Méthode : 
			* @return
			*/
		public	function	__construct()
		{
				parent::__construct();
				$this->class	=	Tchat_Model::instance();
		}

		/**
			* Méthode : 
			* @return
			*/
		public	function	index()
		{
				if(	!request::is_ajax()	||	$this->_user->planque	)
						return	false;

				echo	self::texte();
		}

		/**
			* Méthode : 
			* @return
			*/
		public	function	affichage()
		{
				if(	$this->_user->planque	)
						return	false;

				$view	=	new	View(	'tchat/conteneur'	);
				$view->texte	=	self::texte();
				$view->formulaire	=	new	View(	'tchat/formulaire'	);

				return	$view;
		}

		/**
			* Méthode : 
			* @return
			*/
		public	function	smiley()
		{
				$view	=	new	View(	'tchat/smiley'	);
				$view->render(	true	);
		}

		/**
			* Méthode : 
			* @return
			*/
		public	function	texte()
		{
				if(	$this->_user->planque	)
						return	false;

				$type	=	$this->input->get(	'type'	);

				if(	$type	==	'all'	)
						$type	=	false;

				if(	$val	=	$this->class->selection(	$type	)	)
				{
						$view	=	new	View(	'tchat/texte'	);
						$view->donnees	=	$val;
						$view->id_gang	=	$this->_user->id_gang;
						$view->name	=	strtolower(	$this->_user->username	);

						return	$view;
				}
				return	false;
		}

		/**
			* Méthode : 
			* @return
			*/
		public	function	envois()
		{
				if(	!request::is_ajax()	||	$this->_user->planque	)
						return	false;

				$id_gang	=	false;
				$valeur_demande	=	false;

				$text	=	$this->input->post(	'txt'	);

				if(	substr(	$text,	0,	1	)	==	'/'	)
				{
						$text	=	explode(	' ',	$text	);

						$valeur_demande	=	strtolower(	$text[0]	);
						unset(	$text[0]	);

						$valeur_demande	=	str_replace(	'/',	'',	$valeur_demande	);

						$text	=	implode(	' ',	$text	);
				}

				if(	$valeur_demande	==	'gang'	)
						$id_gang	=	$this->_user->id_gang;

				if(	$valeur_demande	==	'online'	)
				{
						$text	=	'Il y a '.$this->class->online().' gangster(s) dehors';
						$valeur_demande	=	'alert';
				}

				if(	$valeur_demande	==	'attaque'	)
				{
						$attaque	=	Arme_Model::instance()->select_id(	$this->_user->id_arme	);
						$attaque->munition	=	$this->_user->munition;
						$attaque->id_arme	=	$this->_user->id_arme;

						$text	=	'Votre attaque est de : '.Combats_Model::point_attaque_combat(	$attaque	).' pt(s)';
						$valeur_demande	=	'alert';
				}

				if(	$valeur_demande	==	'defense'	)
				{
						$defense	=	Protection_Model::instance()->select_id(	$this->_user->id_protection	);
						$defense->etat_protection	=	$this->_user->etat_protection;
						$defense->id_protection	=	$this->_user->id_protection;

						$text	=	'Votre défense est de : '.Combats_Model::point_defense_combat(	$defense	).' pt(s)';
						$valeur_demande	=	'alert';
				}

				if(	$this->_user->tchat	)
						$this->class->insertion(	$this->_user->username,	$text,	$id_gang,	$valeur_demande	);

				echo	self::texte();
		}

}

?>