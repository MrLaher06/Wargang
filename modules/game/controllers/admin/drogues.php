<?php

defined(	'SYSPATH'	)	or	die(	'No direct access allowed.'	);

class	Drogues_Controller	extends	Template_Admin_Controller	{

		/**
			* Méthode : 
			* @return
			*/
		public	function	index()
		{
				$this->template->add_element_button	=	url::base(	TRUE	).'admin/drogues/ajout.html';
				$this->template->titre	=	'Liste des drogues';

				$query	=	Database::instance()->select(	'id, name, description, prix, niveau'	)->from(	'drogues'	)->get();

				if(	$query->count()	)
				{
						foreach(	$query	as	$val	)
						{
								$lien	=	false;

								foreach(	$val	as	$key2	=>	$val2	)
								{
										if(	!$lien	)
												$lien	=	'admin/drogues/detail/'.$val2;

										if(	$val2	!==	false	)
												$val->$key2	=	html::anchor(	$lien,	text::limit_chars(	strip_tags(	$val2	),	100,	'...',	true	)	);
								}
								$rows[]	=	$val;
						}
						$this->template->contenu	=	Table::instance()->init(	'drogues',	array(	'class'	=>	'tablesorter'	)	)->rows(	$rows	)->tri(	false,	30	)->get();
				}
		}

		/**
			* Méthode : 
			* @return
			*/
		public	function	detail(	$id_drogue	)
		{
				$this->template->button	=	true;
				$this->template->titre	=	'Détail de la drogue';

				$query	=	Database::instance()->from(	'drogues'	)->where(	'id',	$id_drogue	)->limit(	1	)->get();

				if(	$query->count()	)
				{
						$drogue	=	$query->count()	?	$query->current()	:	new	stdClass;

						$users	=	Database::instance()->from(	'users_drogues'	)->where(	'id_drogue',	$id_drogue	)->get();

						$this->template->contenu	=	new	View(	'admin/drogues/detail'	);
						$this->template->contenu->drogue	=	$drogue;
						$this->template->contenu->nbr_en_vente	=	$users->count();
				}
		}

		/**
			* Méthode : 
			* @return
			*/
		public	function	enregistrement(	$type,	$id_drogue	=	false	)
		{
				$db	=	Database::instance();

				if(	$_POST	&&	(	$type	==	'sauve'	||	$type	==	'valid'	)	)
						$db->update(	'drogues',	$_POST,	array(	'id'	=>	$_POST['id']	)	);

				elseif(	$_POST	&&	$type	==	'trash'	)
				{
						$db->delete(	'drogues',	array(	'id'	=>	$_POST['id']	)	);
				}

				if(	$type	==	'annul'	||	$type	==	'valid'	||	$type	==	'trash'	)
						url::redirect(	'admin/drogues'	);
				else
						url::redirect(	'admin/drogues/detail/'.$id_drogue	);
		}

		/**
			* Méthode : 
			* @return
			*/
		public	function	ajout()
		{
				$query	=	Database::instance()->insert(	'drogues',	array(	'autoriser'	=>	0	)	);
				url::redirect(	'admin/drogues/detail/'.$query->insert_id()	);
		}

}

?>