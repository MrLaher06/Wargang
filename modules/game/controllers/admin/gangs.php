<?php

defined(	'SYSPATH'	)	or	die(	'No direct access allowed.'	);

class	Gangs_Controller	extends	Template_Admin_Controller	{

		/**
			* Méthode : 
			* @return
			*/
		public	function	index()
		{
				$this->template->titre	=	'Liste des gangs';
				$this->template->add_element_button	=	url::base(	TRUE	).'admin/gangs/ajout.html';

				$query	=	Database::instance()->select(	'id, nom_gang as nom, commentaire_gang as commentaire'	)->from(	'gangs'	)->get();

				if(	$query->count()	)
				{
						foreach(	$query	as	$val	)
						{
								$lien	=	false;

								foreach(	$val	as	$key2	=>	$val2	)
								{
										if(	!$lien	)
												$lien	=	'admin/gangs/detail/'.$val2;

										if(	$val2	!==	false	)
												$val->$key2	=	html::anchor(	$lien,	text::limit_chars(	strip_tags(	$val2	),	80,	'...',	true	)	);
								}
								$rows[]	=	$val;
						}
						$this->template->contenu	=	Table::instance()->init(	'gangs',	array(	'class'	=>	'tablesorter'	)	)->rows(	$rows	)->tri(	false,	30	)->get();
				}
		}

		/**
			* Méthode : 
			* @return
			*/
		public	function	detail(	$id_gang	)
		{
				$this->template->button	=	true;
				$this->template->titre	=	'Détail du gang';

				$gang	=	Database::instance()->from(	'gangs'	)->where(	'id',	$id_gang	)->limit(	1	)->get();

				$users	=	Database::instance()->select(	'id, username, email, hp, xp, argent, argent_banque, niveau, planque, recherche'	)->from(	'users'	)->where(	'id_gang',	$id_gang	)->get();

				$this->template->contenu	=	new	View(	'admin/gangs/detail'	);
				$this->template->contenu->gang	=	$gang->count()	?	$gang->current()	:	new	stdClass;

				$argent	=	0;
				$chef	=	'Aucun Chef';

				if(	$users->count()	)
				{
						foreach(	$users	as	$val	)
						{
								$lien	=	false;

								$argent	+=	round(	$val->argent	+	$val->argent_banque	);

								if(	$this->template->contenu->gang->id	>	3	&&	$val->id	==	$this->template->contenu->gang->id_user_gang	)
										$chef	=	$val->username;

								foreach(	$val	as	$key2	=>	$val2	)
								{
										if(	!$lien	)
												$lien	=	'admin/users/detail/'.$val2;

										if(	is_numeric(	$val2	)	)
												$val2	=	number_format(	$val2	);

										if(	$val2	!==	false	)
												$val->$key2	=	html::anchor(	$lien,	text::limit_chars(	strip_tags(	$val2	),	80,	'...',	true	)	);
								}
								$rows[]	=	$val;
						}

						$this->template->contenu->users	=	Table::instance()->init(	'users',	array(	'class'	=>	'tablesorter'	)	)->rows(	$rows	)->tri(	false,	30	)->get();
				}

				$this->template->contenu->argent	=	$argent;
				$this->template->contenu->nbr_users	=	$users->count();
				$this->template->contenu->color	=	self::color(	$this->template->contenu->gang->couleur_gang	);
				$this->template->contenu->chef	=	$chef;
		}

		/**
			* Méthode : 
			* @return
			*/
		public	function	enregistrement(	$type,	$id_gang	=	false	)
		{
				$db	=	Database::instance();

				if(	$_POST	&&	(	$type	==	'sauve'	||	$type	==	'valid'	)	)
						$db->update(	'gangs',	$_POST,	array(	'id'	=>	$_POST['id']	)	);

				elseif(	$_POST	&&	$type	==	'trash'	)
				{
						$db->delete(	'gangs',	array(	'id'	=>	$_POST['id']	)	);
				}

				if(	$type	==	'annul'	||	$type	==	'valid'	||	$type	==	'trash'	)
						url::redirect(	'admin/gangs'	);
				else
						url::redirect(	'admin/gangs/detail/'.$id_gang	);
		}

		/**
			* Méthode : 
			* @return
			*/
		public	function	ajout()
		{
				$query	=	Database::instance()->insert(	'gangs',	array(	'nom_gang'	=>	''	)	);
				url::redirect(	'admin/gangs/detail/'.$query->insert_id()	);
		}

		/**
			* Méthode : 
			* @return
			*/
		private	static	function	color(	$defaut	=	false	)
		{
				$cs	=	array(	'00',	'33',	'66',	'99',	'CC',	'FF'	);

				$display	=	false;

				for(	$i	=	0;	$i	<	6;	$i++	)
				{
						for(	$j	=	0;	$j	<	6;	$j++	)
						{
								for(	$k	=	0;	$k	<	6;	$k++	)
								{
										$c	=	$cs[$i].$cs[$j].$cs[$k];
										$select	=	$defaut	==	'#'.$c	?	'selected="selected"'	:	'';
										$display	.=	'<option value="#'.$c.'" '.$select.' style="background-color:#'.$c.';">&nbsp;</option>'."\n";
								}
						}
				}
				return	$display;
		}

}

?>