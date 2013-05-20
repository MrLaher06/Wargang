<?php

defined(	'SYSPATH'	)	or	die(	'Access non autoris&eacute;.'	);

class	Invitation_Controller	extends	Controller	{

		/**
			* M�thode : 
			* @return
			*/
		public	function	index()
		{
				include_once	APPPATH.'libraries/facebook/facebook.php';

				$appapikey	=	Kohana::config(	'game.appapikey_facebook'	);
				$appsecret	=	Kohana::config(	'game.appsecret_facebook'	);
				$this->facebook	=	new	Facebook(	$appapikey,	$appsecret	);
				$this->facebook->require_frame();
				$uid	=	$this->facebook->require_login();

				$v	=	new	View(	'invitation/invitation'	);

				$v->url	=	Kohana::config(	'game.url_facebook'	);
				$v->contenu	=	'Serez-vous le parrain de War Gang ?';
				$v->cols	=	4;
				$v->rows	=	3;
				$v->titre	=	'Inviter un ami';
				$v->render(	true	);
		}

}

?>