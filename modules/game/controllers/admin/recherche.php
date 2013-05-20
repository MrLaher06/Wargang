<?php

defined(	'SYSPATH'	)	or	die(	'No direct access allowed.'	);

class	Recherche_Controller	extends	Template_Admin_Controller	{

		/**
			* Méthode : 
			* @return
			*/
		public	function	index()
		{
				$this->template->contenu	=	new	View(	'admin/home/conteneur'	);
				$this->template->contenu->right	=	new	View(	'admin/home/aide'	);
				$this->template->contenu->left	=	'Aucun résultat.';

				if(	$mot	=	$this->input->post(	's'	)	)
				{
						$this->template->titre	=	'Recherche : '.$mot;

						$db	=	Database::instance();

						$armes	=	array(	);
						$vehicules	=	array(	);
						$protections	=	array(	);
						$gangs	=	array(	);
						$drogues	=	array(	);
						$users	=	array(	);

						$nbr_armes	=	0;
						$nbr_vehicules	=	0;
						$nbr_protections	=	0;
						$nbr_gangs	=	0;
						$nbr_drogues	=	0;
						$nbr_users	=	0;

						if(	$this->input->post(	'armes'	)	)
						{
								$armes	=	$db->select(	'id, name_arme as titre'	)->from(	'armes'	)->like(	'name_arme',	$mot	)->get();
								$nbr_armes	=	$armes->count();
								$armes	=	self::gestion_row(	$armes,	'armes'	);
						}

						if(	$this->input->post(	'vehicules'	)	)
						{
								$vehicules	=	$db->select(	'id, name_vehicule as titre'	)->from(	'vehicules'	)->like(	'name_vehicule',	$mot	)->get();
								$nbr_vehicules	=	$vehicules->count();
								$vehicules	=	self::gestion_row(	$vehicules,	'vehicules'	);
						}

						if(	$this->input->post(	'protections'	)	)
						{
								$protections	=	$db->select(	'id, name_protection as titre'	)->from(	'protections'	)->like(	'name_protection',	$mot	)->get();
								$nbr_protections	=	$protections->count();
								$protections	=	self::gestion_row(	$protections,	'protections'	);
						}

						if(	$this->input->post(	'gangs'	)	)
						{
								$gangs	=	$db->select(	'id, nom_gang as titre'	)->from(	'gangs'	)->like(	'nom_gang',	$mot	)->get();
								$nbr_gangs	=	$gangs->count();
								$gangs	=	self::gestion_row(	$gangs,	'gangs'	);
						}

						if(	$this->input->post(	'drogues'	)	)
						{
								$drogues	=	$db->select(	'id, name as titre'	)->from(	'drogues'	)->like(	'name',	$mot	)->get();
								$nbr_drogues	=	$drogues->count();
								$drogues	=	self::gestion_row(	$drogues,	'drogues'	);
						}

						if(	$this->input->post(	'users'	)	)
						{
								$users	=	$db->select(	'id, username as titre'	)->from(	'users'	)->like(	'username',	$mot	)->get();
								$nbr_users	=	$users->count();
								$users	=	self::gestion_row(	$users,	'users'	);
						}

						$rows	=	array_merge(	$armes,	$vehicules,	$protections,	$gangs,	$drogues,	$users	);

						$this->template->contenu->right->nbr_armes	=	$nbr_armes;
						$this->template->contenu->right->nbr_vehicules	=	$nbr_vehicules;
						$this->template->contenu->right->nbr_protections	=	$nbr_protections;
						$this->template->contenu->right->nbr_gangs	=	$nbr_gangs;
						$this->template->contenu->right->nbr_drogues	=	$nbr_drogues;
						$this->template->contenu->right->nbr_users	=	$nbr_users;

						$this->template->contenu->right->nbr_total	=	$nbr_armes	+	$nbr_vehicules	+	$nbr_protections	+	$nbr_gangs	+	$nbr_drogues	+	$nbr_users;

						$this->template->contenu->left	=	Table::instance()->init(	'arme',	array(	'class'	=>	'tablesorter'	)	)->rows(	$rows	)->tri(	false,	30	)->get();
				}
		}

		private	static	function	gestion_row(	$obj,	$type_lien	)
		{
				$rows	=	array(	);

				if(	$obj->count()	)
				{
						foreach(	$obj	as	$val	)
						{
								$lien	=	false;
								$val->type	=	$type_lien;

								foreach(	$val	as	$key2	=>	$val2	)
								{
										if(	!$lien	)
												$lien	=	'admin/'.$type_lien.'/detail/'.$val2;

										if(	$val2	!==	false	)
												$val->$key2	=	html::anchor(	$lien,	text::limit_chars(	strip_tags(	$val2	),	100,	'...',	true	)	);
								}
								$rows[]	=	$val;
						}
				}

				return	$rows;
		}

}

?>