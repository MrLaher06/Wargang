<?php

defined(	'SYSPATH'	)	or	die(	'No direct access allowed.'	);

class	Jeu_Controller	extends	Template_Controller	{

		/**
			* Méthode : 
			* @return
			*/
		public	function	index()
		{
				$drogues	=	new	Drogues_Controller;
				$users	=	new	Users_Controller;
				$actions	=	new	Actions_Controller;
				$tchat	=	new	Tchat_Controller;
				$gang	=	new	Gang_Controller;

				if(	$users->planque()	)
						url::redirect(	'logout'	);

				if(	$users->facebook()	)
				{
						$this->template->facebook	=	true;
						$this->template->css	=	html::stylesheet(	Kohana::config(	'template.css_facebook'	)	);
				}

				if(	!$temps	=	$users->prison()	)
				{
						$this->template->user	=	$users->afficher_information_user();

						$this->template->competences	=	$users->afficher_competense_user();

						$this->template->contenu	=	$actions->liste_actions_possibles();

						$this->template->drogues	=	$drogues->afficher_liste();

						$this->template->gang	=	$gang->liste_actions_gang();
				}
				else
						$this->template->contenu	=	Flic_Controller::afficher_prison(	$temps	);

				$this->template->menu_top	=	new	View(	'template/menu_top'	);
				$this->template->menu_top->facebook	=	$users->facebook();
				$this->template->menu_top->role	=	(	in_array(	'admin',	$users->role()	)	||	in_array(	'modo',	$users->role()	)	)	?	true	:	false;

				$this->template->tchat	=	$tchat->affichage();

				$this->template->historique	=	'<span class="rouge">En cas de r&eacute;actualisation votre historique sera supprim&eacute;.</span>';
		}

}

?>