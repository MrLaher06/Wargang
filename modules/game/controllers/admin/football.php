<?php

defined(	'SYSPATH'	)	or	die(	'No direct access allowed.'	);

class	Football_Controller	extends	Template_Admin_Controller	{

		/**
			* Méthode : 
			* @return
			*/
		public	function	index()
		{
				$this->template->titre	=	'Liste des équipe de football pour les paris';

				$query	=	Database::instance()->select(	'id, name, attaque, defense, physique, vitesse, reaction, agilite, technique, agressivite, mentalite, jeu_equipe, regularite, endurance, id as moyenne'	)
								->from(	'equipe_football'	)
								->get();

				if(	$query->count()	)
				{
						foreach(	$query	as	$val	)
						{
								$lien	=	false;
								$nb_col	=	0;
								$total_row	=	0;

								foreach(	$val	as	$key2	=>	$val2	)
								{
										if(	!$lien	)
												$lien	=	'admin/football/detail/'.$val2;

										if(	$val2	!==	false	)
										{
												if(	$key2	==	'moyenne'	)
												{
														$val2	=	round(	$total_row	/	$nb_col	);
														$val2	=	$val2	<	50	?	'<span class="rouge">'.$val2.' %</span>'	:	'<span class="vert">'.$val2.' %</span>';
												}
												else	if(	is_numeric(	$val2	)	&&	$key2	!=	'id'	)
												{
														$nb_col++;
														$total_row	+=	$val2;
														$val2	=	$val2	<	50	?	'<span class="rouge">'.$val2.' %</span>'	:	'<span class="vert">'.$val2.' %</span>';
												}

												$val->$key2	=	html::anchor(	$lien,	text::limit_chars(	$val2,	35,	'...',	false	)	);
										}
								}
								$rows[]	=	$val;
						}

						$this->template->contenu	=	Table::instance()->init(	'football_equipe',	array(	'class'	=>	'tablesorter'	)	)->rows(	$rows	)->tri(	false,	30	)->get();
				}
		}

		/**
			* Méthode : 
			* @return
			*/
		public	function	detail(	$id	)
		{
				$db	=	Database::instance();

				$query	=	$db->from(	'equipe_football'	)
								->where(	'id',	$id	)
								->limit(	1	)
								->get();

				if(	$query->count()	)
				{
						$this->template->button	=	true;

						$this->template->titre	=	'Détail de l\'équipe de football';
						$this->template->contenu	=	new	View(	'admin/football/detail'	);
						$this->template->contenu->bots	=	$query->current();
				}
		}

		/**
			* Méthode : 
			* @return
			*/
		public	function	enregistrement(	$type,	$id_ennemis	=	false	)
		{
				$db	=	Database::instance();

				if(	$_POST	&&	(	$type	==	'sauve'	||	$type	==	'valid'	)	)
						$db->update(	'equipe_football',	$_POST,	array(	'id'	=>	$_POST['id']	)	);

				elseif(	$_POST	&&	$type	==	'trash'	)
						$db->delete(	'equipe_football',	array(	'id'	=>	$_POST['id']	)	);

				if(	$type	==	'annul'	||	$type	==	'valid'	||	$type	==	'trash'	)
						url::redirect(	'admin/football'	);
				else
						url::redirect(	'admin/football/detail/'.$id_ennemis	);
		}

}

?>