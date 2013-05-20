<?php

defined(	'SYSPATH'	)	or	die(	'No direct access allowed.'	);

class	Home_Controller	extends	Template_Admin_Controller	{

		/**
			* M�thode : 
			* @return
			*/
		public	function	index()
		{
				$this->template->titre	=	'Gestion de votre administration';
				$this->template->contenu	=	new	View(	'admin/home/conteneur'	);
				$this->template->contenu->left	=	new	View(	'admin/home/menu'	);
				$this->template->contenu->right	=	new	View(	'admin/home/aide'	);

				$db	=	Database::instance();

				$users	=	$db->from(	'users'	)->get();

				$hors_planque	=	0;
				$argent_total_en_cours	=	0;

				if(	$users->count()	)
				{
						foreach(	$users	as	$val	)
						{
								if(	$val->planque	==	0	)
										$hors_planque++;

								$argent_total_en_cours	+=	$val->argent	+	$val->argent_banque;
						}
				}

				$this->template->contenu->right->stat_users	=	$users->count();
				$this->template->contenu->right->stat_planque	=	$hors_planque;
				$this->template->contenu->right->stat_argent	=	$argent_total_en_cours;

				$armes	=	$db->from(	'armes'	)->get();

				$this->template->contenu->right->stat_armes	=	$armes->count();

				$vehicules	=	$db->from(	'vehicules'	)->get();

				$this->template->contenu->right->stat_vehicules	=	$vehicules->count();

				$protections	=	$db->from(	'protections'	)->get();

				$this->template->contenu->right->stat_protections	=	$protections->count();

				$drogues	=	$db->from(	'drogues'	)->get();

				$this->template->contenu->right->stat_drogues	=	$drogues->count();

				$gangs	=	$db->from(	'gangs'	)->get();

				$this->template->contenu->right->stat_gangs	=	$gangs->count();

				$this->template->contenu->right->stat	=	true;
		}

}

?>