<?php

defined(	'SYSPATH'	)	or	die(	'No direct access allowed.'	);

class	Regles_Controller	extends	Template_Admin_Controller	{

		/**
			* Méthode : 
			* @return
			*/
		public	function	index()
		{
				$this->template->add_element_button	=	url::base(	TRUE	).'admin/regles/ajout.html';
				$this->template->titre	=	'Liste des règles pour le jeu';

				$query	=	Database::instance()->select(	'id, titre, lang'	)->from(	'regles'	)->get();

				if(	$query->count()	)
				{
						foreach(	$query	as	$val	)
						{
								$lien	=	false;

								foreach(	$val	as	$key2	=>	$val2	)
								{
										if(	!$lien	)
												$lien	=	'admin/regles/detail/'.$val2;

										if(	$val2	!==	false	)
												$val->$key2	=	html::anchor(	$lien,	text::limit_chars(	strip_tags(	$val2	),	100,	'...',	true	)	);
								}
								$rows[]	=	$val;
						}
						$this->template->contenu	=	Table::instance()->init(	'regles',	array(	'class'	=>	'tablesorter'	)	)->rows(	$rows	)->tri(	false,	30	)->get();
				}
		}

		/**
			* Méthode : 
			* @return
			*/
		public	function	detail(	$id_regles	)
		{
				$this->template->button	=	true;
				$this->template->titre	=	'Détail de la règles';

				$query	=	Database::instance()->from(	'regles'	)->where(	'id',	$id_regles	)->limit(	1	)->get();

				if(	$query->count()	)
				{
						$regles	=	$query->count()	?	$query->current()	:	new	stdClass;

						$this->template->contenu	=	new	View(	'admin/regles/detail'	);
						$this->template->contenu->regles	=	$regles;
				}
		}

		/**
			* Méthode : 
			* @return
			*/
		public	function	enregistrement(	$type,	$id_articles	=	false	)
		{
				$db	=	Database::instance();

				if(	$_POST	&&	(	$type	==	'sauve'	||	$type	==	'valid'	)	)
						$db->update(	'regles',	$_POST,	array(	'id'	=>	$_POST['id']	)	);

				elseif(	$_POST	&&	$type	==	'trash'	)
				{
						$db->delete(	'regles',	array(	'id'	=>	$_POST['id']	)	);
				}

				if(	$type	==	'annul'	||	$type	==	'valid'	||	$type	==	'trash'	)
						url::redirect(	'admin/regles'	);
				else
						url::redirect(	'admin/regles/detail/'.$id_articles	);
		}

		/**
			* Méthode : 
			* @return
			*/
		public	function	ajout()
		{
				$query	=	Database::instance()->insert(	'regles',	array(	'texte'	=>	'En cours de publication.'	)	);
				url::redirect(	'admin/regles/detail/'.$query->insert_id()	);
		}

}

?>