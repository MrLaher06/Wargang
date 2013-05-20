<?php

defined(	'SYSPATH'	)	or	die(	'No direct access allowed.'	);

class	Journal_Controller	extends	System_Controller	{

		/**
			* M�thode : 
			* @return
			*/
		public	function	index()
		{
				$view	=	new	View(	'journal/conteneur'	);
				$view->resultat	=	Journal_Model::instance()->select(	7	);
				$view->render(	true	);
		}

		/**
			* M�thode : 
			* @return
			*/
		public	function	proposer()
		{
				$view	=	new	View(	'journal/proposer'	);
				$view->render(	true	);
		}

		/**
			* M�thode : 
			* @return
			*/
		public	function	youtube(	$id	)
		{
				$view	=	new	View(	'journal/youtube'	);
				$view->id	=	$id;
				$view->render(	true	);
		}

		/**
			* M�thode : 
			* @return
			*/
		public	function	dailymotion(	$id	)
		{
				$view	=	new	View(	'journal/dailymotion'	);
				$view->id	=	$id;
				$view->render(	true	);
		}

		/**
			* M�thode : 
			* @return
			*/
		public	function	enregistrement_proposition()
		{
				if(	!request::is_ajax()	)
						return	false;

				$array['texte']	=	$this->input->post(	'texte_article'	);
				$array['titre']	=	$this->input->post(	'titre'	);
				$array['type']	=	$this->input->post(	'type'	);
				$array['lang']	=	$this->input->post(	'lang'	);
				$array['actif']	=	0;

				Database::instance()->insert(	'journal_articles',	$array	);

				$from	=	'Wargang <'.Kohana::config(	'game.mail_site'	).'>';
				$subject	=	'Proposition d\'article pour War gang';
				$message	=	'Titre : '.$array['titre'].'<br />';
				$message	.=	'Message : '.$array['texte'].'<br />';
				$message	.=	'Type : '.$array['type'];

				email::send(	$from,	$from,	$subject,	$message,	true	);
				email::send(	$this->_user->email,	$from,	$subject,	$message,	true	);
		}

}

?>