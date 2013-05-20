<?php

defined(	'SYSPATH'	)	or	die(	'No direct access allowed.'	);

class	Aide_Controller	extends	System_Controller	{

		/**
			* M�thode : 
			* @return
			*/
		public	function	index()
		{
				$query	=	Database::instance()->select(	'id, titre'	)->from(	'regles'	)->get();

				$view	=	new	View(	'autres/aides/sommaire'	);
				$view->left	=	false;
				$view->right	=	false;

				if(	$query->count()	)
				{
						$n	=	0;
						foreach(	$query	as	$val	)
						{
								if(	$n	%	2	==	0	)
										$view->left	.=	'<li><a href="javascript:;" onclick="paneSplitter.loadContent(\'regles\',\''.url::base(TRUE).'aide/detail/'.$val->id.'.html\');">'.$val->titre.'</a></li>';
								else
										$view->right	.=	'<li><a href="javascript:;" onclick="paneSplitter.loadContent(\'regles\',\''.url::base(TRUE).'aide/detail/'.$val->id.'.html\');">'.$val->titre.'</a></li>';

								$n++;
						}
				}

				$view->render(	true	);
		}

		/**
			* M�thode : 
			* @return
			*/
		public	function	detail(	$id,	$alert	=	false	)
		{
				$query	=	Database::instance()->from(	'regles'	)->where(	'id',	$id	)->limit(	1	)->get();

				$view	=	new	View(	'autres/aides/conteneur'	);

				if(	$query->count()	)
				{
						$view->content	=	$query->current();
						$view->alert	=	$alert;
				}

				$view->render(	true	);
		}

}

?>