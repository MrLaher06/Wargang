<?php

defined(	'SYSPATH'	)	or	die(	'No direct access allowed.'	);

class	Carte_Controller	extends	System_Controller	{

		private	$class;

		/**
			* Méthode : 
			* @return
			*/
		public	function	__construct()
		{
				parent::__construct();
				$this->class	=	Carte_Model::instance();
		}

		/**
			* Méthode : 
			* @return
			*/
		public	function	afficher()
		{

				if(	$temps	=	$this->_user->prison()	)
				{
						echo	'Tu es en prison, il te reste encore '.$temps.' à tirer.<br /><a onclick="fermer_carte()" href="javascript:;"><strong>Fermer cette fenêtre</strong></a>';
						return	false;
				}

				if(	$this->_user->planque	)
				{
						echo	'Vous avez été planqué automatique car nous avons détecté aucune action de votre par depuis plus de 10 min.<br /><a onclick="fermer_carte()" href="javascript:;"><strong>Fermer cette fenêtre</strong></a>';
						return	false;
				}

				$contenu	=	new	View(	'carte/map'	);

				$contenu->tableau	=	self::initialisation();

				$contenu->render(	true	);
		}

		/**
			* Méthode : 
			* @return
			*/
		public	function	deplacement()
		{
				if(	!request::is_ajax()	||	$this->_user->planque	)
						return	false;

				$vehicule	=	new	Vehicule_Model;
				$vehicule->select_id(	$this->_user->id_vehicule	);

				if(	$this->_user->delai_move(	$vehicule->deplacement	)	==	0	)
						self::traitement_deplacement();

				self::refresh_ajax();
		}

		/**
			* Méthode : 
			* @return
			*/
		public	function	refresh_ajax()
		{
				if(	!request::is_ajax()	||	$this->_user->planque	)
						return	false;

				echo	self::initialisation();
		}

		/**
			* Méthode : 
			* @return
			*/
		private	function	initialisation()
		{
				$this->y	=	$this->_user->y;
				$this->x	=	$this->_user->x;
				$this->yMin	=	$this->_user->facebook	?	$this->y	-	3	:	$this->y	-	4;
				$this->xMin	=	$this->_user->facebook	?	$this->x	-	4	:	$this->x	-	5;
				$this->yMax	=	$this->_user->facebook	?	$this->y	+	4	:	$this->y	+	5;
				$this->xMax	=	$this->_user->facebook	?	$this->x	+	5	:	$this->x	+	6;

				$this->class->liste_batiment();
				$this->class->liste_users(	$this->_user->id,	$this->xMin,	$this->yMin,	$this->xMax,	$this->yMax	);

				return	self::creation_tableau_carte();
		}

		/**
			* Méthode : 
			* @return
			*/
		private	function	creation_tableau_carte()
		{
				$vehicule	=	new	Vehicule_Model;
				$vehicule->select_id(	$this->_user->id_vehicule	);

				$display	=	'<div id="chrono">D&eacute;placement possible dans : <span id="delai">'.$this->_user->delai_move(	$vehicule->deplacement(	$this->_user->etat_vehicule,	$this->_user->reservoir_vehicule	)	).'</span>s</div>'."\n";
				$display	.=	'<table cellspacing="0" cellpadding="0" class="tableCarte">'."\n";

				$display	.=	'<tr>'."\n";
				$display	.=	'<td class="td_letter"></td>'."\n";
				for(	$x	=	$this->xMin;	$x	<	$this->xMax;	$x++	)
				{
						$lettre_x	=	$x	>	0	&&	$x	<	Kohana::config(	'carte.taille_carte'	)	+	1	?	$x	:	false;
						$display	.=	'<td align="center" valign="middle" class="td_letter">'.$lettre_x.'</td>'."\n";
				}
				$display	.=	'</tr>'."\n";

				for(	$y	=	$this->yMin;	$y	<	$this->yMax;	$y++	)
				{
						$lettre_y	=	(	$y	>	0	&&	$y	<=	Kohana::config(	'carte.taille_carte'	)	)	?	chr(	$y	+	64	)	:	false;

						$display	.=	'<td align="center" valign="middle" class="td_letter">'.$lettre_y.'</td>'."\n";

						for(	$x	=	$this->xMin;	$x	<	$this->xMax;	$x++	)
						{
								$class	=	'';

								if(	$y	<	1	||	$x	<	1	||	$y	>	Kohana::config(	'carte.taille_carte'	)	||	$x	>	Kohana::config(	'carte.taille_carte'	)	)
										$class	=	'no_passage';

								$display	.=	'<td class="'.$class.'">'."\n";

								$display	.=	self::gestion_case(	$y,	$x	);

								$display	.=	'</td>'."\n";
						}
						$display	.=	'</tr>'."\n";
				}
				$display	.=	'</table>'."\n";

				return	$display;
		}

		/**
			* Méthode : 
			* @return
			*/
		private	function	gestion_case(	$y,	$x	)
		{
				$tpl_case	=	new	View(	'carte/case'	);

				if(	$this->class->visibilite(	$y,	$x,	$this->y,	$this->x,	$this->_user->niveau	)	)
				{
						$tpl_case->lien	=	$this->class->lien_deplacement(	$y,	$x,	$this->y,	$this->x	);

						$donnee_batiment	=	$this->class->search_batiment(	$y,	$x	);
						$donnee_user	=	$this->class->search_user(	$y,	$x	);

						if(	$y	==	$this->y	&&	$x	==	$this->x	&&	$donnee_batiment	)
						{
								$donnee_user[]	=	$this->_user;
								$tpl_case->batiment	=	self::case_batiment(	$donnee_batiment,	$donnee_user	);
						}
						elseif(	$donnee_batiment	)
								$tpl_case->batiment	=	self::case_batiment(	$donnee_batiment,	$donnee_user	);

						elseif(	$y	==	$this->y	&&	$x	==	$this->x	)
								$tpl_case->son_perso	=	self::case_perso(	$donnee_user	);

						elseif(	$donnee_user	)
								$tpl_case->user	=	self::case_user(	$donnee_user	);
				}
				else
						$tpl_case->style	=	'style="background-image:url('.url::base().'images/noir_transparent_50.png)"';

				return	$tpl_case;
		}

		/**
			* Méthode : 
			* @return
			*/
		private	function	traitement_deplacement()
		{
				switch(	$this->input->post(	'direction'	)	)
				{
						case	1	:
								$this->_user->y	-=	1;
								$this->_user->x	-=	1;
								break;
						case	2	:
								$this->_user->y	-=	1;
								break;
						case	3	:
								$this->_user->y	-=	1;
								$this->_user->x	+=	1;
								break;
						case	4	:
								$this->_user->x	-=	1;
								break;
						case	5	:
								$this->_user->x	+=	1;
								break;
						case	6	:
								$this->_user->y	+=	1;
								$this->_user->x	-=	1;
								break;
						case	7	:
								$this->_user->y	+=	1;
								break;
						case	8	:
								$this->_user->y	+=	1;
								$this->_user->x	+=	1;
								break;
				}

				$this->_user->xp++;
				$this->_user->reservoir_vehicule--;
				$this->_user->deplacement++;
				$this->_user->time_move	=	time();

				if(	$this->_user->reservoir_vehicule	<	0	)
						$this->_user->reservoir_vehicule	=	0;

				$this->_user->modifier();

				Statistiques_Model::instance()->insertion(	$this->_user->id,	'deplacement'	);

				$db	=	Database::instance();
				$db->update(	'combats',	array(	'actif'	=>	0	),	array(	'id_attaque'	=>	$this->_user->id,	'actif'	=>	1	)	);
				$db->update(	'combats',	array(	'actif'	=>	0	),	array(	'id_defense'	=>	$this->_user->id,	'type_defense'	=>	'user',	'actif'	=>	1	)	);
		}

		/**
			* Méthode : 
			* @return
			*/
		private	function	case_batiment(	$donnee_batiment	=	false,	$donnee_user	=	false	)
		{
				$array	=	array(	'src'	=>	'images/batiments/'.$donnee_batiment->image,
						'width'	=>	60,
						'height'	=>	60,
						'title'	=>	$donnee_batiment->nom,
						'class'	=>	'elem_map'	);

				if(	$donnee_batiment->couleur_gang	)
				{
						$array['style']	=	'border: 1px solid '.$donnee_batiment->couleur_gang;
						$array['width']	=	58;
						$array['height']	=	58;
				}

				$display	=	html::image(	$array	);

				if(	$donnee_user	)
						$display	.=	self::case_user(	$donnee_user,	20	);

				return	$display;
		}

		/**
			* Méthode : 
			* @return
			*/
		private	function	case_user(	$donnee_user	=	false,	$taille	=	60	)
		{
				$array	=	array(	'width'	=>	$taille	-	2,
						'height'	=>	$taille	-	2,
						'class'	=>	'elem_map',
						'src'	=>	'images/carte/interro.jpg'	);

				if(	$taille	!=	60	)
						$array['class']	=	'elem_map mini_vignette_map';

				if(	is_array(	$donnee_user	)	&&	count(	$donnee_user	)	==	1	)
				{
						$array['src']	=	'images/avatars/'.$donnee_user[0]->avatar;
						$array['title']	=	$donnee_user[0]->username;

						if(	isset(	$donnee_user[0]->couleur_gang	)	)
								$array['style']	=	'border: 1px solid '.$donnee_user[0]->couleur_gang;
				}

				return	html::image(	$array	);
		}

		/**
			* Méthode : 
			* @return
			*/
		private	function	case_perso(	$donnee_user	=	false	)
		{
				$display	=	html::image(	array(	'src'	=>	'images/avatars/'.$this->_user->avatar,	'width'	=>	60,	'height'	=>	60,	'class'	=>	'elem_map'	)	);

				if(	$donnee_user	)
						$display	.=	self::case_user(	$donnee_user,	20	);

				return	$display;
		}

}

?>