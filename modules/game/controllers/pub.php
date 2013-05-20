<?php

defined(	'SYSPATH'	)	or	die(	'No direct access allowed.'	);

class	Pub_Controller	extends	Controller	{

		/**
			* M�thode : 
			* @return
			*/
		public	function	index()
		{
				$view	=	new	View(	'pub/banniere'	);
				$view->render(	true	);
		}

}

?>