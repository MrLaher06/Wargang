<?php

defined(	'SYSPATH'	)	or	die(	'No direct access allowed.'	);

class	Avatar_Controller	extends	System_Controller	{

		/**
			* M�thode : 
			* @return
			*/
		public	function	index()
		{
				if(	isset(	$_FILES['userfile']	)	)
				{
						$uploadfile	=	time().'_'.basename(	$_FILES['userfile']['name']	);

						if(	move_uploaded_file(	$_FILES['userfile']['tmp_name'],	DOCROOT.'images/avatars/'.$uploadfile	)	)
						{
								$image	=	new	Image(	DOCROOT.'images/avatars/'.$uploadfile	);
								$image->resize(	100,	100,	Image::AUTO	);
								$image->quality(	75	);
								$image->save();

								$this->_user->avatar	=	$uploadfile;
								$this->_user->modifier();
								Statistiques_Model::instance()->insertion(	$this->_user->id,	'change_avatar'	);
						}
				}
		}

}

?>