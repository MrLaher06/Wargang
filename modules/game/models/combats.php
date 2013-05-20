<?php
defined('SYSPATH') or die('Access non autoris&eacute;.');

class Combats_Model extends Model
{
	private $xp = false;
	
	private $niveau = false;
	
	protected static $instance;
	 
	public static function instance()
	{
		if (Combats_Model::$instance === NULL)
			new Combats_Model;

		return Combats_Model::$instance;
	}
	
	public function __construct()
	{
		parent::__construct();
		Combats_Model::$instance = $this;
	}
	
	/**
	* Methode : enregistrement d'un combat contre un bot
	*/
	public function enregistrement_prepare_combat_bot( $id_bot, $x, $y, $id_user, $id_gang )
	{
		if( self::verif_bot( $id_user, $id_bot, $x, $y ) )
		{			
			$array = array('id_attaque' => $id_user,
										 'gang_attaque' => $id_gang,
										 'id_defense' => $id_bot,
										 'type_defense' => 'bot',
										 'x' => $x,
										 'y' => $y,
										 'date' => date::NOW() );
			
			return self::insertion( $array );
		}
		return false;
	}
	
	/**
	* Methode : enregistrement d'une participation à un combat contre un bot
	*/
	public function enregistrement_participer_combat_bot( $id_combat, $x, $y, $id_user, $id_gang )
	{
		if( $bot = self::verif_combat( $id_combat ) )
		{			
			$array = array('id_attaque' => $id_user,
										 'gang_attaque' => $id_gang,
										 'id_defense' => $bot->id_defense,
										 'type_defense' => 'bot',
										 'id_combat' => $id_combat,
										 'x' => $x,
										 'y' => $y,
										 'date' => date::NOW() );
			
			return self::insertion( $array );
		}
		return false;
	}
	
	/**
	* Methode : pour vérifier que le bot est a sa place
	*/
	private function verif_bot( $id_user, $id_bot, $x, $y ) 
	{	
		if(self::verif_user( $id_user ))
			return false;
											
		return $this->db->select('id')
										->from('ennemis')
										->where(array('id' => $id_bot, 'x' => $x, 'y' => $y ) )
										->limit(1)
										->get()
										->count();
	}
	
	/**
	* Methode : enregistrement d'un combat contre un bot
	*/
	public function enregistrement_prepare_combat_user( $id_user_defense, $x, $y, $id_user, $id_gang )
	{
		if( self::verif_user_defense( $id_user, $id_user_defense, $x, $y ) )
		{			
			$array = array('id_attaque' => $id_user,
										 'gang_attaque' => $id_gang,
										 'id_defense' => $id_user_defense,
										 'type_defense' => 'user',
										 'x' => $x,
										 'y' => $y,
										 'date' => date::NOW() );
			
			return self::insertion( $array );
		}
		return false;
	}
	
	/**
	* Methode : enregistrement d'une participation à un combat contre un user
	*/
	public function enregistrement_participer_combat_user( $id_combat, $x, $y, $id_user, $id_gang )
	{
		if( $user = self::verif_combat( $id_combat ) )
		{			
			$array = array('id_attaque' => $id_user,
										 'gang_attaque' => $id_gang,
										 'id_defense' => $user->id_defense,
										 'type_defense' => 'user',
										 'id_combat' => $id_combat,
										 'x' => $x,
										 'y' => $y,
										 'date' => date::NOW() );
			
			return self::insertion( $array );
		}
		return false;
	}
	
	/**
	* Methode : pour vérifier que le user est a sa place
	*/
	private function verif_user_defense( $id_user, $id_user_defense, $x, $y ) 
	{	
		if(self::verif_user( $id_user ))
			return false;
											
		return $this->db->select('id')
										->from('users')
										->where(array('id' => $id_user_defense, 'x' => $x, 'y' => $y, 'planque' => 0 ) )
										->limit(1)
										->get()
										->count();
	}
	
	/**
	* Methode : enregistrement d'un combat contre un bot
	*/
	public function enregistrement_prepare_combat_batiment( $id_batiment, $x, $y, $id_user, $id_gang )
	{
		if( self::verif_batiment( $id_user, $id_batiment, $x, $y ) )
		{			
			$array = array('id_attaque' => $id_user,
										 'gang_attaque' => $id_gang,
										 'id_defense' => $id_batiment,
										 'type_defense' => 'batiment',
										 'x' => $x,
										 'y' => $y,
										 'date' => date::NOW() );
			
			return self::insertion( $array );
		}
		return false;
	}
	
	/**
	* Methode : enregistrement d'une participation à un combat contre un bot
	*/
	public function enregistrement_participer_combat_batiment( $id_combat, $x, $y, $id_user, $id_gang )
	{
		if( $batiment = self::verif_combat( $id_combat ) )
		{			
			$array = array('id_attaque' => $id_user,
										 'gang_attaque' => $id_gang,
										 'id_defense' => $batiment->id_defense,
										 'type_defense' => 'batiment',
										 'id_combat' => $id_combat,
										 'x' => $x,
										 'y' => $y,
										 'date' => date::NOW() );
			
			return self::insertion( $array );
		}
		return false;
	}
	
	/**
	* Methode : pour vérifier que le bot est a sa place
	*/
	private function verif_batiment( $id_user, $id_batiment, $x, $y ) 
	{	
		if(self::verif_user( $id_user ))
			return false;
											
		return $this->db->select('id')
										->from('carte')
										->where(array('id' => $id_batiment, 'x' => $x, 'y' => $y ) )
										->limit(1)
										->get()
										->count();
	}
	
	
	/**
	* Methode : pour supprimer un combat
	*/
	public function delete_combat( $id_combat, $id_user = false, $victoire = 0 ) 
	{
		if($id_user)
			$this->db->update('combats', array( 'actif' => 0, 'reussi' => $victoire ), array( 'id_defense' => $id_user ) );
			
		$this->db->update('combats', array( 'actif' => 0, 'reussi' => $victoire ), array( 'id' => $id_combat ) );
		$this->db->update('combats', array( 'actif' => 0, 'reussi' => $victoire ), array( 'id_combat' => $id_combat ) );
	}
	
	/**
	* Methode : pour vérifier que le combat existe
	*/
	private function verif_combat( $id_combat ) 
	{	
		$query = $this->db->from('combats')
											->where(array('id' => $id_combat, 'actif' => 1 ) )
											->limit(1)
											->get();
											
		return $query->count() ? $query->current() : false;
	}
	
	/**
	* Methode : pour vérifier que le user est en combat
	*/
	public function verif_user( $id_user ) 
	{	
		return $this->db->select('id')
										->from('combats')
										->where(array( 'id_attaque' => $id_user, 'actif' => 1 ) )
										->limit(1)
										->get()
										->count();
	}
	
	/**
	* Methode : pour vérifier que le user est en combat
	*/
	public function verif_attaque_alerte( $id_user ) 
	{	
		return $this->db->select('id')
										->from('combats')
										->where(array( 'id_defense' => $id_user, 'actif' => 1, 'type_defense' => 'user' ) )
										->limit(1)
										->get()
										->count();
	}
	
	/**
	* Methode : insertion d'une ligne dans les combats
	*/
	private function insertion( array $array ) 
	{		
		$this->db->update('users', array( 'last_activity' => time() ), array( 'id' => $array['id_attaque'] ) );
		
		return $this->db->insert('combats', $array );
	}
	
	/**
	* Methode : lister tous les personnes qui sont sur l'action
	*/
	private function liste_users_action( $id_combat ) 
	{
		sleep( 2 );
		
		$query = $this->db->select('SQL_NO_CACHE *, combats.id as id, users.id as id_user')
											->from('combats')
											->join('users', 'users.id', 'combats.id_attaque' )
											->join('armes', 'armes.id', 'users.id_arme', 'LEFT')
											->join('protections', 'protections.id', 'users.id_protection', 'LEFT')
											->where('combats.actif = 1 AND ( combats.id = '.$id_combat.' OR combats.id_combat = '.$id_combat.' )')
											->get();
											
		if( $query->count() )
			return $query;
			
		return false;
	}
	
	/**
	* Methode : calcul les point d attaque
	*/
	public static function point_attaque_combat( $attaque ) 
	{	
		if( $attaque->id_arme && $attaque->munition && $attaque->precision && $attaque->precision < 100 )
			return $attaque->attaque - ( $attaque->attaque / $attaque->precision );
			
		elseif( $attaque->id_arme && $attaque->munition && $attaque->precision )
			return $attaque->attaque++;	
			
		return 1/4;
	}
	
	/**
	* Methode : calcul les point de défense
	*/
	public static function point_defense_combat( $defense ) 
	{	
		if( $defense->id_protection && $defense->etat_protection && $defense->etat_protection < 100 )
			return $defense->defense - ( $defense->defense / $defense->etat_protection );
			
		elseif( $defense->id_protection && $defense->etat_protection )
			return $defense->defense++;
			
		return 1/4;
	}
	
	/**
	* Methode : conpare les points de chaque partie attaque/defense
	*/
	private function comparer_point( $attaque, $defense ) 
	{		
		if( $attaque > $defense )
			return array('attaque', ( $attaque - $defense ) );
		
		return array('defense', ( $defense - $attaque ) );
	}
	
	/********************************************************************************
	* Methode : calcul combat user vs bot
	********************************************************************************/
	public function calcul_combat_bot( $id_combat ) 
	{
		$array_histo['resultat'] = 'VICTOIRE';
		$array_histo['defense'] = false;
		$array_histo['argent'] = 0;
		$my_user = false;
		$aide_user = false;
		$attaque_bot = 0;
		$defense_bot = 0;
		$attaque_users = 0;
		$defense_users = 0;
		
		// recupération des attaquants (avec un sleep() )
		if( $liste_users_attaque = self::liste_users_action( $id_combat ) )
		{
			$liste_users_detail = $liste_users_attaque->current();
			
			//on recupère la defense
			$defense_user = $this->db->select('SQL_NO_CACHE *, ennemis.id as id, ennemis.nom as nom')
															 ->from('ennemis')
													 		 ->join('armes', 'armes.id', 'ennemis.id_arme', 'LEFT')
													 		 ->join('protections', 'protections.id', 'ennemis.id_protection', 'LEFT')
															 ->where( array('ennemis.id' => $liste_users_detail->id_defense, 
																							'ennemis.x' => $liste_users_detail->x, 
																							'ennemis.y' => $liste_users_detail->y ) )
															 ->limit(1)
															 ->get();
						
			foreach( $liste_users_attaque as $val )
			{
				if($val->id_combat == 0)
				{
					$my_user = $val;
					$array_histo['attaque'] = $my_user->username;
					$defense_users = self::point_defense_combat( $val );
				}
				else
				{
					$aide_user[] = $val;
					$array_histo['aide'][] = $val->username;
				}
					
				$attaque_users += self::point_attaque_combat( $val );
			}
																		 
			if( $defense_user->count() )
			{
				$defense_user = $defense_user->current();
				
				$array_histo['defense'] = $defense_user->nom;
				
				$defense_bot = self::point_defense_combat( $defense_user );
				
				$array_histo['stat_attaque'][] = 'Votre attaque a fait un score de <strong>'.$attaque_users.'</strong> pts contre une défense de <strong>'.$defense_bot.'</strong> pts.';
		
				$attaque = self::comparer_point( $attaque_users, $defense_bot );
				
				//Calcul des point VICTOIRE BOT
				if( $attaque && $attaque[0] == 'attaque' )
				{
					$argent = ( $aide_user ) ? round( $defense_user->argent / ( 2 + count( $aide_user ) ) ) : ( $defense_user->argent / 4 );
					$xp = ( $aide_user ) ? round( $defense_user->xp / ( 1 + count( $aide_user ) ) ) : $defense_user->xp;
					
					if($aide_user)
					{
						foreach( $aide_user as $val )
						{
							$val->argent += $argent;
							$val->xp += $xp;
							$val->victoire++;
							$val->munition--;
							$val->etat_protection--;
							$array_histo['argent'] += $argent;
						}
					}
					
					$my_user->argent += round($argent * 2);
					$my_user->xp += $xp;
					$my_user->victoire++;
					$my_user->munition--;
					$my_user->etat_protection--;
					$my_user->recherche = 1;
					
					$array_histo['argent'] += round($argent * 2);
					
					$defense_user->etat_protection -= $attaque[1];
							
					if( $defense_user->etat_protection < 0 )
					{
						$defense_user->hp += $defense_user->etat_protection;
						$defense_user->etat_protection = 0;
					}
					
					$defense_user->munition--;
					$defense_user->xp++;
					$defense_user->x = rand(1, Kohana::config( 'carte.taille_carte' ));
					$defense_user->y = rand(1, Kohana::config( 'carte.taille_carte' ));
				}
				//Calcul des point DEFAITE BOT
				else
				{
					$argent = ( ( $defense_user->argent / 2 )  / ( 2 + count( $aide_user ) ) );
					$array_histo['resultat'] = 'DEFAITE';
					
					if($aide_user)
					{
						foreach( $aide_user as $val )
						{
							$val->argent = ( $argent > $val->argent ) ? 0 : $val->argent - $argent;
							$val->hp--;
							$val->xp++;
							$val->defaite++;
							$val->munition--;
							$val->etat_protection--;
						}
					}
					
					// Le bot se relance dans un combat
					if( $defense_user->hp > 0 && rand(0,1) )
					{
						$attaque_bot = self::point_attaque_combat( $defense_user );
						
						$array_histo['stat_attaque'][] = 'Votre défense a fait un score de <strong>'.$defense_users.'</strong> pts contre une attaque de <strong>'.$attaque_bot.'</strong> pts.';
						
						$defense = self::comparer_point( $attaque_bot, $defense_users );
						
						if( $defense && $defense[0] == 'attaque' )
						{
							$my_user->etat_protection -= $defense[1];
					
							$my_user->x = rand(1, Kohana::config( 'carte.taille_carte' ));
							$my_user->y = rand(1, Kohana::config( 'carte.taille_carte' ));
								
							if(rand(0,1)) $my_user->id_arme = 0;
						}
						else
						{
							$defense_user->x = rand(1, Kohana::config( 'carte.taille_carte' ));
							$defense_user->y = rand(1, Kohana::config( 'carte.taille_carte' ));
						}
					}
					
					if( $my_user->etat_protection < 0 )
					{
						$my_user->hp += $my_user->etat_protection;
						$my_user->etat_protection = 0;
					}
					
					$my_user->hp--;
					$my_user->argent = ( $argent > $my_user->argent ) ? 0 : $my_user->argent - $argent;
					$my_user->defaite++;
					$my_user->xp++;
					$my_user->munition--;
				}
				
				$message_tchat = 'Combat contre <strong>'.$array_histo['defense'].'</strong> : <strong class="rouge">'.$array_histo['resultat'].'</strong><br />'."\n";
				
				if($array_histo['argent'])
					$message_tchat .= 'Gain total qu\'il a perdu : <strong>'.number_format($array_histo['argent']).' $</strong><br />'."\n";
					
				$message_tchat .= $array_histo['stat_attaque'][0]."\n";
				
				if( isset($array_histo['aide']) )
					$message_tchat .= '<br />Vous avez été aidé par '.count($array_histo['aide']).' gangster(s) : '.implode(', ', $array_histo['aide'])."\n";
				else
					$message_tchat .= '<br />Aucun gangster ne vous a aidé sur ce coup'."\n";
					
				if(isset($array_histo['stat_attaque'][1]))
				{
					$message_tchat .= '<br /><span class="rouge"><strong>'.$array_histo['defense'].'</strong> en a profité pour vous ré-attaquer</span><br />'."\n";
					$message_tchat .= $array_histo['stat_attaque'][1]."\n";
				}
						
				self::update_users_aide_attaque ( $aide_user, $message_tchat );
				
				self::update_user_attaque ( $my_user, $message_tchat );
				
				self::update_bot_attaque ( $defense_user );
			}
		}
		return $array_histo;
	}
	
	/********************************************************************************
	* Methode : calcul BRAQUAGE
	********************************************************************************/
	public function calcul_combat_batiment( $id_combat ) 
	{	
		$array_histo['resultat'] = 'VICTOIRE';
		$array_histo['argent'] = 0;
		$rapport['batiment'] = false;
		$my_user = false;
		$aide_user = false;
		$attaque_users = 0;
		$time_batiment = time();
		
		// recupération des attaquants (avec un sleep() )
		if( $liste_users_attaque = self::liste_users_action( $id_combat ) )
		{
			$liste_users_detail = $liste_users_attaque->current();
			
			//on recupère la defense
			$defense_batiment = $this->db->from('carte')
																	 ->where( array('id' => $liste_users_detail->id_defense, 
																									'x' => $liste_users_detail->x, 
																									'y' => $liste_users_detail->y ) )
																	 ->limit(1)
																	 ->get();
						
			foreach( $liste_users_attaque as $val )
			{
				if($val->id_combat == 0)
				{
					$my_user = $val;
					$array_histo['attaque'] = $my_user->username;
				}
				else
				{
					$aide_user[] = $val;
					$array_histo['aide'][] = $val->username;
				}
					
				$attaque_users += self::point_attaque_combat( $val );
			}
																		 
			if( $defense_batiment->count() )
			{
				$defense_batiment = $defense_batiment->current();
				
				$array_histo['batiment'] = $defense_batiment;
				
				$array_histo['defense'] = $defense_batiment->nom;
								
				$array_histo['stat_attaque'] = 'Votre braquage a fait un score de <strong>'.$attaque_users.'</strong> pts.';
		
				$attaque = self::comparer_point( $attaque_users, $defense_batiment->protection );
				
				//Calcul des point VICTOIRE BRAQUAGE
				if( $attaque && $attaque[0] == 'attaque' )
				{
					$argent = ( $aide_user ) ? round( $defense_batiment->coffre / ( 2 + count( $aide_user ) ) ) : $defense_batiment->coffre;
					
					if($aide_user)
					{
						foreach( $aide_user as $val )
						{
							$val->argent += $argent;
							$val->xp += 2000;
							$val->victoire++;
							$val->munition--;
							$array_histo['argent'] += $argent;
						}
					}
					
					$my_user->argent += round($argent * 2);
					$my_user->xp += 5000;
					$my_user->victoire++;
					$my_user->munition--;
					$my_user->recherche = 1;
					
					$array_histo['argent'] += round($argent * 2);					
				}
				//Calcul des point DEFAITE BRAQUAGE
				else
				{
					$array_histo['resultat'] = 'DEFAITE';
					
					if($aide_user)
					{
						foreach( $aide_user as $val )
						{
							$val->hp--;
							$val->defaite++;
							$val->munition--;
						}
					}
					
					$my_user->hp -= 5;
					$my_user->defaite++;
					$my_user->munition--;
					$my_user->recherche = 1;
					
					if(rand(0,1)) 
					{
						$my_user->id_arme = 0;
						$my_user->munition = 0;
					}
					
					$time_batiment = time() - ( 50 * 60 );
				}
				
				$message_tchat = 'Braquage contre <strong>'.$array_histo['defense'].'</strong> : <strong class="rouge">'.$array_histo['resultat'].'</strong><br />'."\n";
		
				if($array_histo['argent'])
					$message_tchat .= 'Gain total remporté : <strong>'.number_format($array_histo['argent']).' $</strong><br />'."\n";
					
				$message_tchat .= $array_histo['stat_attaque']."\n";
				
				if( isset($array_histo['aide']) )
					$message_tchat .= '<br />Vous avez été aidé par '.count($array_histo['aide']).' gangster(s) : '.implode(', ', $array_histo['aide'])."\n";
				else
					$message_tchat .= '<br />Aucun gangster ne vous a aidé sur ce coup'."\n";
				
				self::update_users_aide_attaque ( $aide_user, $message_tchat );
				
				self::update_user_attaque ( $my_user, $message_tchat );
				
				self::update_batiment_attaque ( $defense_batiment, $time_batiment );
			}
		}
				
		return $array_histo;
	}
	
	/********************************************************************************
	* Methode : calcul combat USER VS USER
	********************************************************************************/
	public function calcul_combat_user( $id_combat ) 
	{	
		$array_histo['resultat'] = 'VICTOIRE';
		$array_histo['argent'] = 0;
		$array_histo['defense'] = false;
		$array_histo['user_defense'] = new stdClass;
		$my_user = false;
		$aide_user = false;
		$attaque_defense_user = 0;
		$defense_defense_user = 0;
		$attaque_users = 0;
		$defense_users = 0;
	
		// recupération des attaquants (avec un sleep() )
		if( $liste_users_attaque = self::liste_users_action( $id_combat ) )
		{
			$liste_users_detail = $liste_users_attaque->current();
			
			// on recupere la defense
			$defense_user = $this->db->select('SQL_NO_CACHE *, users.id as id')
															 ->from('users')
													 		 ->join('armes', 'armes.id', 'users.id_arme', 'LEFT')
													 		 ->join('protections', 'protections.id', 'users.id_protection', 'LEFT')
															 ->where( array('users.id' => $liste_users_detail->id_defense, 
																							'users.planque' => 0, 
																							'users.x' => $liste_users_detail->x, 
																							'users.y' => $liste_users_detail->y ) )
															 ->limit(1)
															 ->get();
															 
			if(!$defense_user->count())
				return false;
						
			foreach( $liste_users_attaque as $val )
			{
				if($val->id_combat == 0)
				{
					$my_user = $val;
					
					if( $liste_users_detail->x != $my_user->x || $liste_users_detail->y != $my_user->y )
						return false;
						
					$array_histo['attaque'] = $my_user->username;
					$defense_users = self::point_defense_combat( $val );
				}
				else
				{
					$aide_user[] = $val;
					$array_histo['aide'][] = $val->username;
				}
					
				$attaque_users += self::point_attaque_combat( $val );
			}
																		 
			if( $defense_user->count() )
			{
				$defense_user = $defense_user->current();
										
				if( $defense_user->planque || $defense_user->x != $my_user->x || $defense_user->y != $my_user->y )
				{
					$texte_admin = 'Tu n\'est plus à porté pour combattre '.$defense_user->username;
					Tchat_Model::instance()->insertion( $my_user->username, $texte_admin, $my_user->id_gang, 'alert' );
					return false;
				}
				
				$array_histo['defense'] = $defense_user->username;
				
				$array_histo['user_defense'] = $defense_user;

				$defense_point = self::point_defense_combat( $defense_user );
				
				$array_histo['stat_attaque'] = 'Votre attaque a fait un score de <strong>'.$attaque_users.'</strong> pts contre une défense de <strong>'.$defense_point.'</strong> pts.';
		
				$attaque = self::comparer_point( $attaque_users, $defense_point );
				
				//Calcul des point VICTOIRE USER
				if( $attaque && $attaque[0] == 'attaque' )
				{
					$argent = ( $aide_user ) ? round( ( $defense_user->argent / 2 ) / ( 2 + count( $aide_user ) ) ) : ( $defense_user->argent / 4 );
					
					if ( $defense_user->niveau > $my_user->niveau )
						$xp_total = round( ( $defense_user->niveau + ( $defense_user->niveau - $my_user->niveau ) ) * 120 );
						
					elseif ( $defense_user->niveau == $my_user->niveau )
						$xp_total = round( $defense_user->niveau * 110 );
						
					else
						$xp_total = round( ( 100 * $defense_user->niveau ) / ( $my_user->niveau - $defense_user->niveau ) );
					
					$xp = ( $aide_user ) ? round( $xp_total / ( 1 + count( $aide_user ) ) ) : $xp_total;
					
					if($aide_user)
					{
						foreach( $aide_user as $val )
						{
							$val->argent += $argent;
							$val->xp += $xp;
							$val->victoire++;
							$val->munition--;
							$val->etat_protection--;
							$array_histo['argent'] += $argent;
						}
					}
					
					$my_user->argent += round($argent * 2);
					$my_user->xp += $xp;
					$my_user->victoire++;
					$my_user->munition--;
					$my_user->etat_protection--;
					$my_user->recherche = 1;
					
					$array_histo['argent'] += round($argent * 2);
					
					$defense_user->etat_protection -= $attaque[1];
							
					if( $defense_user->etat_protection < 0 )
					{
						$defense_user->hp += $defense_user->etat_protection;
						$defense_user->etat_protection = 0;
					}
					
					if( ( time() - $defense_user->last_activity ) > 600 ) 
						$defense_user->planque = 1;
					
					$defense_user->argent /= 2;
					$defense_user->munition--;
					$defense_user->xp++;
					$defense_user->defaite++;
					$defense_user->x = rand(1, Kohana::config( 'carte.taille_carte' ));
					$defense_user->y = rand(1, Kohana::config( 'carte.taille_carte' ));
				}
				//Calcul des point DEFAITE USER
				else
				{
					$argent = round( $my_user->argent / 2 );
					$array_histo['resultat'] = 'DEFAITE';
					
					if($aide_user)
					{
						foreach( $aide_user as $val )
						{
							$val->hp -= 1;
							$val->xp++;
							$val->defaite++;
							$val->munition--;
							$val->etat_protection--;
						}
					}
					
					if( $my_user->etat_protection < 0 )
					{
						$my_user->hp += $my_user->etat_protection;
						$my_user->etat_protection = 0;
					}
					
					$my_user->argent = ( $argent > $my_user->argent ) ? 0 : $my_user->argent - $argent;
					$my_user->defaite++;
					$my_user->xp++;
					$my_user->munition--;
					$my_user->x = rand(1, Kohana::config( 'carte.taille_carte' ));
					$my_user->y = rand(1, Kohana::config( 'carte.taille_carte' ));
					
					if( ( time() - $defense_user->last_activity ) > 600 ) 
						$defense_user->planque = 1;
					
					$defense_user->argent += $argent;
					$defense_user->munition--;
					$defense_user->xp++;
					$defense_user->victoire++;
				}
				
				$message_tchat = 'Combat contre <strong>'.$array_histo['defense'].'</strong> : <strong class="rouge">'.$array_histo['resultat'].'</strong><br />'."\n";
				
				if($array_histo['argent'])
					$message_tchat .= 'Gain total qu\'il a perdu : <strong>'.number_format($array_histo['argent']).' $</strong><br />'."\n";
					
				$message_tchat .= $array_histo['stat_attaque']."\n";
				
				if( isset($array_histo['aide']) )
					$message_tchat .= '<br />Vous avez été aidé par '.count($array_histo['aide']).' gangster(s) : '.implode(', ', $array_histo['aide'])."\n";
				else
					$message_tchat .= '<br />Aucun gangster ne vous a aidé sur ce coup'."\n";
				
				$message_tchat_defense = '<strong>'.$array_histo['attaque'].'</strong> a essayé de vous combattre mais il s\'est mangé sur vous.<br />'."\n";
				
				if( $array_histo['resultat'] == 'VICTOIRE' )
					$message_tchat_defense = '<strong>'.$array_histo['attaque'].'</strong> vous a combattu et il a été victorieux.<br />'."\n";
				
				if($array_histo['argent'])
					$message_tchat_defense .= 'vous avez perdu : <strong>'.number_format($array_histo['argent']).' $</strong><br />'."\n";
									
				if( isset($array_histo['aide']) )
					$message_tchat_defense .= 'Il a été aidé par '.count($array_histo['aide']).' gangster(s) : '.implode(', ', $array_histo['aide'])."\n";
				else
					$message_tchat_defense .= 'Aucun gangster ne l\' a aidé sur ce coup'."\n";
						
				self::update_users_aide_attaque ( $aide_user, $message_tchat );
				
				self::update_user_attaque ( $my_user, $message_tchat );
				
				$defense_user->id_user = $defense_user->id;
				
				self::update_user_attaque ( $defense_user, $message_tchat_defense );
			}
			return $array_histo;
		}
		return false;
	}
	
	/**
	* Methode : on met a jour les participant au coups
	*/
	private function update_users_aide_attaque ( $aide_user, $message_tchat )
	{
		if($aide_user)
		{
			foreach( $aide_user as $val )
			{
				Tchat_Model::instance()->insertion( $val->username, $message_tchat, $val->id_gang, 'alert' );
				
				if( $val->munition < 0 ) $val->munition = 0;
				if( $val->niveau > 100 ) $val->niveau = 100;
				
				$val->recherche = rand(0,1);
		
				$this->xp = $val->xp;
				$this->niveau = $val->niveau;
				
				self::increment_niveau();
				
				$val->xp = $this->xp;
				$val->niveau = $this->niveau;
				
				$array = array('argent' => $val->argent, 
											 'hp' => $val->hp, 
											 'xp' => $val->xp, 
									 		 'niveau' => $val->niveau, 
									 		 'recherche' => $val->recherche, 
											 'munition' => $val->munition, 
											 'last_activity' => time(), 
											 'etat_protection' => $val->etat_protection, 
											 'defaite' => $val->defaite, 
											 'victoire' => $val->victoire );
				
				// En cas de mort
				if( $val->hp <= 0 )
					$array = self::mort( $val );
				
				$this->db->update('users', $array, array( 'id' => $val->id_user ) );
			}
		}
	}
	
	/**
	* Methode : on met a jour l'attaquant principal (lanceur)
	*/
	private function update_user_attaque ( $my_user, $message_tchat )
	{
		Tchat_Model::instance()->insertion( $my_user->username, $message_tchat, $my_user->id_gang, 'alert' );
		
		if( $my_user->munition < 0 ) $my_user->munition = 0;
		if( $my_user->niveau > 100 ) $my_user->niveau = 100;
		
		$this->xp = $my_user->xp;
		$this->niveau = $my_user->niveau;
		
		self::increment_niveau();
		
		$my_user->xp = $this->xp;
		$my_user->niveau = $this->niveau;
		
		
		$array = array('argent' => $my_user->argent, 
									 'hp' => $my_user->hp, 
									 'id_arme' => $my_user->id_arme, 
									 'id_protection' => $my_user->id_protection, 
									 'x' => $my_user->x, 
									 'y' => $my_user->y, 
									 'xp' => $my_user->xp, 
									 'etat_protection' => $my_user->etat_protection, 
									 'munition' => $my_user->munition, 
									 'recherche' => $my_user->recherche, 
									 'niveau' => $my_user->niveau, 
									 'last_activity' => time(),
									 'planque' => $my_user->planque,  
									 'defaite' => $my_user->defaite, 
									 'victoire' => $my_user->victoire );
		
		// En cas de mort
		if( $my_user->hp <= 0 )
			$array = self::mort( $my_user );

		return $this->db->update('users', $array, array( 'id' => $my_user->id_user ) );
	}
	
	/**
	* Methode :
	*/
	private function update_batiment_attaque ( $defense_batiment, $time_batiment )
	{
		$array = array('protection' => ( $defense_batiment->protection + 100 ), 
											 'coffre' => round( $defense_batiment->coffre + ( $defense_batiment->coffre / 10 ) ), 
											 'timer' => $time_batiment );
				
		return $this->db->update('carte', $array, array( 'id' => $defense_batiment->id ) );
	}
	
	/**
	* Methode :
	*/
	private function update_bot_attaque ( $defense_user )
	{
		if( $defense_user->munition < 0 ) $defense_user->munition = $defense_user->munition_arme;
		if( $defense_user->hp < 0 ) $defense_user->hp = 100;
		if( $defense_user->xp < 0 ) $defense_user->hp = 0;
		if( $defense_user->etat_protection < 0 ) $defense_user->etat_protection = 100;
		
		if( $defense_user->xp > 100 )
		{
			$defense_user->xp = 0;
			$defense_user->niveau++;
			
			if( $defense_user->niveau > 100 ) 
				$defense_user->niveau = 100;
		}
		
		$array = array('argent' => rand(400,6000), 
									 'hp' => $defense_user->hp, 
									 'xp' => $defense_user->xp, 
									 'x' => $defense_user->x, 
									 'y' => $defense_user->y, 
									 'etat_protection' => $defense_user->etat_protection, 
									 'munition' => $defense_user->munition);
		
		return $this->db->update('ennemis', $array, array( 'id' => $defense_user->id ) );
	}
	
	/* 
	* Methode : pour le delai de déplacement
	*/
	public function increment_niveau( $niveau_suivant = false )
	{
		if(!$niveau_suivant)
			$niveau_suivant = self::niveau_suivant();
			
		if( $this->xp > $niveau_suivant )
		{
			$this->xp -= $niveau_suivant;
			$this->niveau++;
			
			$niveau_suivant = self::niveau_suivant();
			
			if($this->xp > $niveau_suivant)
				self::increment_niveau($niveau_suivant);
		}
	}

	/**
	* Methode : pourcentage Niveau suivant
	*/
	public function niveau_suivant() 
	{
		$valeur = 0;
		
		if($this->niveau > 0 )
			$valeur = round( $this->niveau * Kohana::config( 'users.niveau_suivant' ) * 100 );
			
		return (int) ( $valeur > 0 ) ? $valeur : 100;	
	}

	/**
	* Methode : la mort
	*/
	private function mort( $my_user ) 
	{
		$array = array('last_activity' => time(),
										 'x' => rand(1, Kohana::config( 'carte.taille_carte' )),
										 'y' => rand(1, Kohana::config( 'carte.taille_carte' )),
										 'hp' => 100,
										 'xp' => 0,
										 'argent' => 1000,
										 'argent_banque' => 0,
										 'niveau' => 0,
										 'id_arme' => 0,
										 'munition' => 0,
										 'id_protection' => 0,
										 'etat_protection' => 0,
										 'id_vehicule' => 0,
										 'etat_vehicule' => 0,
										 'reservoir_vehicule' => 0,
										 'time_move' => time(),
										 'recherche' => 0,
										 'deplacement' => 0,
										 'achat_drogue' => 0,
										 'vente_drogue' => 0,
										 'achat_batiment' => 0,
										 'vente_batiment' => 0,
										 'achat_element' => 0,
										 'vente_element' => 0,
										 'victoire' => 0,
										 'defaite' => 0);
		
		$this->db->delete('users_drogues', array('id_user' => $my_user->id_user));
		$this->db->update('carte', array( 'id_user' => 0, 'id_gang' => 0, 'proprio' => '' ) , array( 'id_user' =>  $my_user->id_user ) );
		$this->db->update('users_mission', array( 'actif' => 0 ) , array( 'id_user' =>  $my_user->id_user ) );
						
		$from    = 'Wargang <'.Kohana::config('game.mail_site').'>';
		$subject = 'War gang';
		$message = 'Vous êtes mort.';
		
		email::send($my_user->email, $from, $subject, $message, true);
		
		Statistiques_Model::instance()->insertion( $my_user->id, 'game_over' );
		Tchat_Model::instance()->insertion( $my_user->username, '<blink class="rouge">GAME OVER</blink>', $my_user->id_gang, 'alert' );
		
		return $array;
	}
}
?>