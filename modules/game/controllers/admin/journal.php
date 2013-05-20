<?php

defined(	'SYSPATH'	)	or	die(	'No direct access allowed.'	);

class	Journal_Controller	extends	Template_Admin_Controller	{

		/**
			* Méthode : 
			* @return
			*/
		public	function	index()
		{
				$this->template->add_element_button	=	url::base(	TRUE	).'admin/journal/ajout.html';
				$this->template->titre	=	'Liste des articles pour le journal';

				$query	=	Database::instance()->select(	'id, titre, type, lang, actif'	)->from(	'journal_articles'	)->orderby(	'actif',	'ASC'	)->get();

				if(	$query->count()	)
				{
						foreach(	$query	as	$val	)
						{
								$lien	=	false;

								foreach(	$val	as	$key2	=>	$val2	)
								{
										if(	!$lien	)
												$lien	=	'admin/journal/detail/'.$val2;

										if(	$key2	==	'type'	)
												$val2	=	self::type_article(	$val2	);

										if(	$key2	==	'actif'	)
												$val2	=	$val2	?	'<span class="vert">Oui</span>'	:	'<span class="rouge">Non</span>';

										if(	$val2	!==	false	)
												$val->$key2	=	html::anchor(	$lien,	text::limit_chars(	$val2,	100,	'...',	true	)	);
								}
								$rows[]	=	$val;
						}
						$this->template->contenu	=	Table::instance()->init(	'journal',	array(	'class'	=>	'tablesorter'	)	)->rows(	$rows	)->tri(	false,	30	)->get();
				}
		}

		/**
			* Méthode : 
			* @return
			*/
		public	function	detail(	$id_journal_articles	)
		{
				$this->template->button	=	true;
				$this->template->titre	=	'Détail de l\'article';

				$query	=	Database::instance()->from(	'journal_articles'	)->where(	'id',	$id_journal_articles	)->limit(	1	)->get();

				if(	$query->count()	)
				{
						$journal_articles	=	$query->count()	?	$query->current()	:	new	stdClass;

						$this->template->contenu	=	new	View(	'admin/journal_articles/detail'	);
						$this->template->contenu->journal_articles	=	$journal_articles;
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
						$db->update(	'journal_articles',	$_POST,	array(	'id'	=>	$_POST['id']	)	);

				elseif(	$_POST	&&	$type	==	'trash'	)
				{
						$db->delete(	'journal_articles',	array(	'id'	=>	$_POST['id']	)	);
				}

				if(	$type	==	'annul'	||	$type	==	'valid'	||	$type	==	'trash'	)
						url::redirect(	'admin/journal'	);
				else
						url::redirect(	'admin/journal/detail/'.$id_articles	);
		}

		/**
			* Méthode : 
			* @return
			*/
		public	function	ajout()
		{
				$query	=	Database::instance()->insert(	'journal_articles',	array(	'type'	=>	1	)	);
				url::redirect(	'admin/journal/detail/'.$query->insert_id()	);
		}

		/**
			* Méthode : 
			* @return
			*/
		private	static	function	type_article(	$type	)
		{
				switch(	$type	)
				{
						case	1	:
								return	'"Attaque" vient de démonter "défense"';
								break;
						case	2	:
								return	'"Attaque" vient de se casser les dents sur "défense"';
								break;
						case	3	:
								return	'"Attaque" a braqué "batiment"';
								break;
						case	4	:
								return	'"Attaque" a loupé le braquage "batiment"';
								break;
						case	5	:
								return	'"Attaque" vient d\'acheter un "batiment"';
								break;
						case	6	:
								return	'"Attaque" vient de rouler sur "défense"';
								break;
						case	7	:
								return	'"Attaque" a voulu rouler sur "défense" mais il a loupé';
								break;
						case	8	:
								return	'"Attaque" vient de mettre en prison "défense"';
								break;
						case	9	:
								return	'"Attaque" vient de voler de l\'argent';
								break;
						case	10	:
								return	'"Attaque" a loupé le vole d\'argent';
								break;
						case	11	:
								return	'"Attaque" vient de dénoncer "défense"';
								break;
						case	12	:
								return	'"Attaque" a voulu dénoncer "défense" mais il a loupé';
								break;
				}

				return	false;
		}

}

?>