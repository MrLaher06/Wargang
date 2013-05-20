<?php

defined(	'SYSPATH'	)	or	die(	'No direct access allowed.'	);

class	Carte_Controller	extends	Template_Admin_Controller	{

		/**
			* Méthode : 
			* @return
			*/
		public	function	index()
		{
				$this->template->add_element_button	=	url::base(	TRUE	).'admin/carte/ajout.html';
				$this->template->titre	=	'Liste des éléments de la carte';

				$query	=	Database::instance()->select(	'id, nom, type_option as option, protection, commentaire, x, y'	)->from(	'carte'	)->get();

				if(	$query->count()	)
				{
						foreach(	$query	as	$val	)
						{
								$lien	=	false;

								foreach(	$val	as	$key2	=>	$val2	)
								{
										if(	!$lien	)
												$lien	=	'admin/carte/detail/'.$val2;

										if(	$val2	!==	false	)
												$val->$key2	=	html::anchor(	$lien,	text::limit_chars(	strip_tags(	$val2	),	80,	'...',	true	)	);

										if(	$key2	==	'y'	)
												$val->$key2	=	html::anchor(	$lien,	chr(	$val2	+	64	)	);
								}
								$rows[]	=	$val;
						}
						$this->template->contenu	=	Table::instance()->init(	'carte',	array(	'class'	=>	'tablesorter'	)	)->rows(	$rows	)->tri(	false,	30	)->get();
				}
		}

		/**
			* Méthode : 
			* @return
			*/
		public	function	detail(	$id_carte	)
		{
				$this->template->button	=	true;
				$this->template->titre	=	'Détail de la carte';

				$query	=	Database::instance()->from(	'carte'	)->where(	'id',	$id_carte	)->limit(	1	)->get();

				if(	$query->count()	)
				{
						$carte	=	$query->count()	?	$query->current()	:	new	stdClass;

						$this->template->contenu	=	new	View(	'admin/carte/detail'	);
						$this->template->contenu->carte	=	$carte;
				}
		}

		/**
			* Méthode : 
			* @return
			*/
		public	function	enregistrement(	$type,	$id_carte	=	false	)
		{
				$db	=	Database::instance();

				if(	$_POST	&&	(	$type	==	'sauve'	||	$type	==	'valid'	)	)
						$db->update(	'carte',	$_POST,	array(	'id'	=>	$_POST['id']	)	);

				elseif(	$_POST	&&	$type	==	'trash'	)
				{
						$db->delete(	'carte',	array(	'id'	=>	$_POST['id']	)	);
				}

				if(	$type	==	'annul'	||	$type	==	'valid'	||	$type	==	'trash'	)
						url::redirect(	'admin/carte'	);
				else
						url::redirect(	'admin/carte/detail/'.$id_carte	);
		}

		/**
			* Méthode : 
			* @return
			*/
		public	function	ajout()
		{
				$query	=	Database::instance()->insert(	'carte',	array(	'id_user'	=>	0	)	);
				url::redirect(	'admin/carte/detail/'.$query->insert_id()	);
		}

}

?>