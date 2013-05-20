<?php

defined(	'SYSPATH'	)	or	die(	'No direct access allowed.'	);

class	Ip_Controller	extends	Template_Admin_Controller	{

		/**
			* Méthode : 
			* @return
			*/
		public	function	index()
		{
				$this->template->titre	=	'Liste des IP utilisée par les utilisateurs';
				$this->template->contenu	=	'';

				$query	=	Database::instance()->select(	'ip, username, count(ip) as nombre, time as delai'	)
								->from(	'users_multi_compte'	)
								->where(	'CURDATE() < date group by username'	)
								->limit(	500	)
								->orderby(	array(	'ip'	=>	'DESC',	'delai'	=>	'DESC'	)	)->get();

				if(	$query->count()	)
				{
						$ip	=	array(	);

						foreach(	$query	as	$val	)
						{
								$alert	=	false;

								foreach(	$val	as	$key2	=>	$val2	)
								{
										if(	$key2	==	'ip'	)
										{
												if(	!isset(	$ip[$val2]	)	)
														$ip[$val2]	=	true;
												else
														$alert	=	true;
										}

										if(	$key2	==	'username'	)
												if(	$alert	)
														$val->$key2	=	'<b class="rouge">'.$val2.'</b>';

										if(	$key2	==	'delai'	)
												$val->$key2	=	date::convertir_date(	time()	-	$val2	);
								}

								$rows2[]	=	$val;
						}

						$this->template->contenu	.=	'<h2>Liste Triée de IP avec leur utilisateur depuis 24h</h2>';
						$this->template->contenu	.=	Table::instance()->init(	'distinct_users_multi_compte',	array(	'class'	=>	'tablesorter'	)	)->rows(	$rows2	)->tri(	false,	30	)->get();
				}

				$query	=	Database::instance()->select(	'ip, username, date, time as delai, type'	)->from(	'users_multi_compte'	)->limit(	500	)->orderby(	'id',	'DESC'	)->get();

				if(	$query->count()	)
				{
						foreach(	$query	as	$val	)
						{
								foreach(	$val	as	$key2	=>	$val2	)
								{
										if(	$key2	==	'delai'	)
												$val->$key2	=	date::convertir_date(	time()	-	$val2	);

										elseif(	$key2	==	'date'	)
												$val->$key2	=	date::FormatDate(	$val2	);
								}

								$rows[]	=	$val;
						}

						$this->template->contenu	.=	'<h2>Liste globale des IP</h2>';
						$this->template->contenu	.=	Table::instance()->init(	'users_multi_compte',	array(	'class'	=>	'tablesorter'	)	)->rows(	$rows	)->tri(	false,	20	)->get(	false,	true	);
				}
		}

}

?>