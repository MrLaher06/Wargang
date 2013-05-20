<?php

defined(	'SYSPATH'	)	or	die(	'No direct access allowed.'	);

class	Protections_Controller	extends	Template_Admin_Controller	{

		/**
			* Méthode : 
			* @return
			*/
		public	function	index()
		{
				$this->template->add_element_button	=	url::base(	TRUE	).'admin/protections/ajout.html';
				$this->template->titre	=	'Liste des protections';

				$query	=	Database::instance()->select(	'id, name_protection as nom, commentaire_protection as description, defense, niveau_protection as niveau, prix_protection as prix'	)->from(	'protections'	)->get();

				if(	$query->count()	)
				{
						foreach(	$query	as	$val	)
						{
								$lien	=	false;

								foreach(	$val	as	$key2	=>	$val2	)
								{
										if(	!$lien	)
												$lien	=	'admin/protections/detail/'.$val2;

										if(	$val2	!==	false	)
												$val->$key2	=	html::anchor(	$lien,	text::limit_chars(	strip_tags(	$val2	),	100,	'...',	true	)	);
								}
								$rows[]	=	$val;
						}
						$this->template->contenu	=	Table::instance()->init(	'protection',	array(	'class'	=>	'tablesorter'	)	)->rows(	$rows	)->tri(	false,	30	)->get();
				}
		}

		/**
			* Méthode : 
			* @return
			*/
		public	function	detail(	$id_protection	)
		{
				$this->template->button	=	true;
				$this->template->titre	=	'Détail de la protection';

				$db	=	Database::instance();

				$query	=	$db->from(	'protections'	)->where(	'id',	$id_protection	)->limit(	1	)->get();

				if(	$query->count()	)
				{
						$users	=	$db->select(	'id, username'	)->from(	'users'	)->where(	'id_protection',	$id_protection	)->limit(	1	)->get();

						$this->template->contenu	=	new	View(	'admin/protections/detail'	);
						$this->template->contenu->protection	=	$query->current();
						$this->template->contenu->proprietaire	=	$users->count()	?	$users->current()	:	false;
				}
		}

		/**
			* Méthode : 
			* @return
			*/
		public	function	enregistrement(	$type,	$id_protections	=	false	)
		{
				$db	=	Database::instance();

				if(	$_POST	&&	(	$type	==	'sauve'	||	$type	==	'valid'	)	)
						$db->update(	'protections',	$_POST,	array(	'id'	=>	$_POST['id']	)	);

				elseif(	$_POST	&&	$type	==	'trash'	)
						$db->delete(	'protections',	array(	'id'	=>	$_POST['id']	)	);

				Cache::instance()->delete_tag(	'protection'	);

				if(	$type	==	'annul'	||	$type	==	'valid'	||	$type	==	'trash'	)
						url::redirect(	'admin/protections'	);
				else
						url::redirect(	'admin/protections/detail/'.$id_protections	);
		}

		/**
			* Méthode : 
			* @return
			*/
		public	function	ajout()
		{
				$query	=	Database::instance()->insert(	'protections',	array(	'commentaire_protection'	=>	1	)	);
				url::redirect(	'admin/protections/detail/'.$query->insert_id()	);
		}

}

?>