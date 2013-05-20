<?php

defined(	'SYSPATH'	)	or	die(	'Access non autoris&eacute;.'	);

class	Sitemap_Controller	extends	Controller	{

		protected	$view;

		public	function	__construct()
		{
				parent::__construct();

				header(	"content-type: application/xml"	);
				echo	'<?xml version="1.0" encoding="UTF-8"?>'."\n";
		}

		public	function	index()
		{
				$article	=	Journal_Model::instance()->select(	1000000	);

				if(	$article	)
				{
						echo	'<urlset xmlns="http://www.sitemaps.org/schemas/sitemap/0.9">'."\n";
						foreach(	$article	as	$val	)
						{
								$this->view	=	new	View(	'sitemap/xml_url'	);

								$date	=	explode(	' ',	$val['value']->date	);

								$this->view->loc	=	url::base(TRUE).'archives/detail/'.url::title(	utf8::transliterate_to_ascii(	$date[0]	)	).'/'.url::title(	utf8::transliterate_to_ascii(	$val['value']->titre	)	).'/'.$val['value']->id.'.html';
								$this->view->lastmod	=	self::modifier_date(	$val['value']->date	);
								$this->view->render(	true	);
						}
						echo	'</urlset>'."\n";
				}
		}

		private	static	function	modifier_date(	$date	)
		{
				$date	=	explode(	' ',	$date	);
				return	$date[0];
		}

}

?>