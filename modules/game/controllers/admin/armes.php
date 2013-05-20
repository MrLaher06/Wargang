<?php

defined(	'SYSPATH'	)	or	die(	'No direct access allowed.'	);

class	Armes_Controller	extends	Template_Admin_Controller	{

		/**
			* Méthode : 
			* @return
			*/
		public	function	index()
		{
				$this->template->add_element_button	=	url::base(	TRUE	).'admin/armes/ajout.html';
				$this->template->titre	=	'Liste des armes';

				$query	=	Database::instance()->select(	'id, name_arme as nom, commentaire_arme as description, attaque, precision, munition_arme as munitions, niveau_arme as niveau, prix_arme as prix'	)
								->from(	'armes'	)
								->orderby(	'prix_arme',	'ASC'	)
								->get();

				if(	$query->count()	)
				{
						foreach(	$query	as	$val	)
						{
								$lien	=	false;

								foreach(	$val	as	$key2	=>	$val2	)
								{
										if(	!$lien	)
												$lien	=	'admin/armes/detail/'.$val2;

										if(	$val2	!==	false	)
												$val->$key2	=	html::anchor(	$lien,	text::limit_chars(	strip_tags(	$val2	),	100,	'...',	true	)	);
								}
								$rows[]	=	$val;
						}
						$this->template->contenu	=	Table::instance()->init(	'arme',	array(	'class'	=>	'tablesorter'	)	)->rows(	$rows	)->tri(	false,	50	)->get();
				}
		}

		/**
			* Méthode : 
			* @return
			*/
		public	function	detail(	$id_arme	)
		{
				$this->template->button	=	true;
				$this->template->titre	=	'Détail de l\'arme';

				$db	=	Database::instance();

				$query	=	$db->from(	'armes'	)->where(	'id',	$id_arme	)->limit(	1	)->get();

				if(	$query->count()	)
				{
						$users	=	$db->select(	'id, username'	)->from(	'users'	)->where(	'id_arme',	$id_arme	)->limit(	1	)->get();

						$this->template->contenu	=	new	View(	'admin/armes/detail'	);
						$this->template->contenu->arme	=	$query->current();
						$this->template->contenu->proprietaire	=	$users->count()	?	$users->current()	:	false;
				}
		}

		/**
			* Méthode : 
			* @return
			*/
		public	function	enregistrement(	$type,	$id_armes	=	false	)
		{
				$db	=	Database::instance();

				if(	$_POST	&&	(	$type	==	'sauve'	||	$type	==	'valid'	)	)
						$db->update(	'armes',	$_POST,	array(	'id'	=>	$_POST['id']	)	);

				elseif(	$_POST	&&	$type	==	'trash'	)
						$db->delete(	'armes',	array(	'id'	=>	$_POST['id']	)	);

				Cache::instance()->delete_tag(	'arme'	);

				if(	$type	==	'annul'	||	$type	==	'valid'	||	$type	==	'trash'	)
						url::redirect(	'admin/armes'	);
				else
						url::redirect(	'admin/armes/detail/'.$id_armes	);
		}

		/**
			* Méthode : 
			* @return
			*/
		public	function	ajout()
		{
				$query	=	Database::instance()->insert(	'armes',	array(	'commentaire_arme'	=>	1	)	);
				url::redirect(	'admin/armes/detail/'.$query->insert_id()	);
		}

}

?>