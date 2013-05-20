<?php

defined(	'SYSPATH'	)	or	die(	'No direct access allowed.'	);

class	Allopass_Controller	extends	System_Controller	{

		/**
			* Méthode : 
			* @return
			*/
		public	function	index()
		{
				$v	=	new	View(	'allopass/formulaire'	);
				$v->render(	true	);
		}

		/**
			* Méthode : 
			* @return
			*/
		public	function	traitement_hospital_hp()
		{
				$this->_user->hp	+=	10;
				$this->_user->xp++;

				$this->_user->modifier();

				self::notification();

				Tchat_Model::instance()->insertion(	$this->_user->username,	'Paiement Allopass effectué avec succès',	$this->_user->id_gang,	'alert'	);

				Statistiques_Model::instance()->insertion(	$this->_user->id,	'allopass'	);

				url::redirect(	'allopass/valide'	);
		}

		/**
			* Méthode : 
			* @return
			*/
		public	function	valide()
		{
				$v	=	new	View(	'allopass/valide'	);
				$v->render(	true	);
		}

		/**
			* Méthode : 
			* @return
			*/
		public	function	erreur()
		{
				$v	=	new	View(	'allopass/erreur'	);
				$v->render(	true	);
		}

		/**
			* Méthode : 
			* @return
			*/
		public	function	tarif(	$lien_regle	=	false	)
		{
				$v	=	new	View(	'allopass/tarif'	);

				if(	$lien_regle	)
						$v->regle	=	true;

				$v->render(	true	);
		}

		/**
			* Méthode : 
			* @return
			*/
		public	function	notification()
		{
				$to	=	'Allopass <'.Kohana::config(	'game.mail_proprio'	).'>';
				$from	=	'Wargang <'.Kohana::config(	'game.mail_site'	).'>';
				$subject	=	'Inscription sur War gang';
				$message	=	'Paiement en ligne Allopass pour 10 pts de HP';

				email::send(	$to,	$from,	$subject,	$message,	true	);
				email::send(	$this->_user->email,	$from,	$subject,	$message,	true	);
		}

}

?>