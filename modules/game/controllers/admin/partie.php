<?php

defined(	'SYSPATH'	)	or	die(	'No direct access allowed.'	);

class	Partie_Controller	extends	Template_Admin_Controller	{

		/**
			* Méthode : 
			* @return
			*/
		public	function	index()
		{
				$this->template->add_element_button	=	url::base(	TRUE	).'admin/partie/ajout.html';
				$this->template->titre	=	'Liste des parties du jeu';

				$query	=	Database::instance()->select(	'id, date_debut_partie as debut, date_fin_partie as fin, en_cours_partie as fini'	)->from(	'parties'	)->orderby(	'en_cours_partie',	'DESC'	)->get();

				if(	$query->count()	)
				{
						foreach(	$query	as	$val	)
						{
								$lien	=	false;

								foreach(	$val	as	$key2	=>	$val2	)
								{
										if(	!$lien	)
												$lien	=	'admin/partie/detail/'.$val2;

										if(	$key2	==	'fini'	)
												$val2	=	!$val2	?	'<span class="vert">Oui</span>'	:	'<span class="rouge">Non</span>';

										if(	$val2	)
												$val->$key2	=	html::anchor(	$lien,	text::limit_chars(	$val2,	100,	'...',	true	)	);
								}
								$rows[]	=	$val;
						}
						$this->template->contenu	=	Table::instance()->init(	'parties',	array(	'class'	=>	'tablesorter'	)	)->rows(	$rows	)->tri(	false,	30	)->get();
				}
		}

		/**
			* Méthode : 
			* @return
			*/
		public	function	detail(	$id_partie	)
		{
				$this->template->button	=	true;
				$this->template->titre	=	'Détail de la partie';

				$query	=	Database::instance()->from(	'parties'	)->where(	'id',	$id_partie	)->limit(	1	)->get();

				if(	$query->count()	)
				{
						$partie	=	$query->count()	?	$query->current()	:	new	stdClass;

						$this->template->contenu	=	new	View(	'admin/partie/detail'	);
						$this->template->contenu->partie	=	$partie;
				}
		}

		/**
			* Méthode : 
			* @return
			*/
		public	function	enregistrement(	$type,	$id_parties	=	false	)
		{
				$db	=	Database::instance();

				if(	$_POST	&&	(	$type	==	'sauve'	||	$type	==	'valid'	)	)
						$db->update(	'parties',	$_POST,	array(	'id'	=>	$_POST['id']	)	);

				elseif(	$_POST	&&	$type	==	'trash'	)
				{
						$db->delete(	'parties',	array(	'id'	=>	$_POST['id']	)	);
				}

				if(	$type	==	'annul'	||	$type	==	'valid'	||	$type	==	'trash'	)
						url::redirect(	'admin/partie'	);
				else
						url::redirect(	'admin/partie/detail/'.$id_parties	);
		}

		/**
			* Méthode : 
			* @return
			*/
		public	function	ajout()
		{
				Database::instance()->update(	'parties',	array(	'en_cours_partie'	=>	0	),	array(	'en_cours_partie'	=>	1	)	);
				$query	=	Database::instance()->insert(	'parties',	array(	'en_cours_partie'	=>	1,	'date_debut_partie'	=>	date::NOW()	)	);
				url::redirect(	'admin/partie/detail/'.$query->insert_id()	);
		}

}

?>