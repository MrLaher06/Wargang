<?php

defined(	'SYSPATH'	)	or	die(	'No direct access allowed.'	);

class	Vehicules_Controller	extends	Template_Admin_Controller	{

		/**
			* Méthode : 
			* @return
			*/
		public	function	index()
		{
				$this->template->add_element_button	=	url::base(	TRUE	).'admin/vehicules/ajout.html';
				$this->template->titre	=	'Liste des vehicules';

				$query	=	Database::instance()->select(	'id, name_vehicule as nom, commentaire_vehicule as description, niveau_vehicule as niveau, reservoir, deplacement, prix_vehicule as prix'	)->from(	'vehicules'	)->get();

				if(	$query->count()	)
				{
						foreach(	$query	as	$val	)
						{
								$lien	=	false;

								foreach(	$val	as	$key2	=>	$val2	)
								{
										if(	!$lien	)
												$lien	=	'admin/vehicules/detail/'.$val2;

										if(	$val2	!==	false	)
												$val->$key2	=	html::anchor(	$lien,	text::limit_chars(	strip_tags(	$val2	),	100,	'...',	true	)	);
								}
								$rows[]	=	$val;
						}
						$this->template->contenu	=	Table::instance()->init(	'vehicule',	array(	'class'	=>	'tablesorter'	)	)->rows(	$rows	)->tri(	false,	30	)->get();
				}
		}

		/**
			* Méthode : 
			* @return
			*/
		public	function	detail(	$id_vehicule	)
		{
				$this->template->button	=	true;
				$this->template->titre	=	'Détail du véhicule';

				$db	=	Database::instance();

				$query	=	$db->from(	'vehicules'	)->where(	'id',	$id_vehicule	)->limit(	1	)->get();

				if(	$query->count()	)
				{
						$users	=	$db->select(	'id, username'	)->from(	'users'	)->where(	'id_vehicule',	$id_vehicule	)->limit(	1	)->get();

						$this->template->contenu	=	new	View(	'admin/vehicules/detail'	);
						$this->template->contenu->vehicule	=	$query->current();
						$this->template->contenu->proprietaire	=	$users->count()	?	$users->current()	:	false;
						$this->template->contenu->batiments	=	Database::instance()->select(	'id, nom'	)->from(	'carte'	)->where(	'type_option',	'vehicule'	)->get();
				}
		}

		/**
			* Méthode : 
			* @return
			*/
		public	function	enregistrement(	$type,	$id_vehicules	=	false	)
		{
				$db	=	Database::instance();

				if(	$_POST	&&	(	$type	==	'sauve'	||	$type	==	'valid'	)	)
						$db->update(	'vehicules',	$_POST,	array(	'id'	=>	$_POST['id']	)	);

				elseif(	$_POST	&&	$type	==	'trash'	)
						$db->delete(	'vehicules',	array(	'id'	=>	$_POST['id']	)	);

				Cache::instance()->delete_tag(	'vehicule'	);

				if(	$type	==	'annul'	||	$type	==	'valid'	||	$type	==	'trash'	)
						url::redirect(	'admin/vehicules'	);
				else
						url::redirect(	'admin/vehicules/detail/'.$id_vehicules	);
		}

		/**
			* Méthode : 
			* @return
			*/
		public	function	ajout()
		{
				$query	=	Database::instance()->insert(	'vehicules',	array(	'commentaire_vehicule'	=>	1	)	);
				url::redirect(	'admin/vehicules/detail/'.$query->insert_id()	);
		}

}

?>