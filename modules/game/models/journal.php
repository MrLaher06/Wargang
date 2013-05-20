<?php
defined('SYSPATH') or die('Access non autoris&eacute;.');

class Journal_Model extends Model
{
	protected static $instance;

	/**
	* Méthode : 
	* @return
	*/
	public static function instance()
	{
		if (Journal_Model::$instance == NULL)
			new Journal_Model;

		return Journal_Model::$instance;
	}
	
	/**
	* Méthode : 
	* @return
	*/
	public function __construct()
	{
		parent::__construct();
		Journal_Model::$instance = $this;
	}
	
	/**
	* Méthode : 
	* @return
	*/
	public function select( $limit = 5, $offset = false ) 
	{
		$articles = false;
		$query = $this->db->select('*, journal.id as id')
											->from('journal')
											->join('journal_articles', 'journal_articles.id', 'journal.id_article')
											->orderby('journal.id','DESC')
											->limit($limit, $offset)
											->get();
		
		if( $query->count() )
		{
			foreach( $query as $val )
			{
				if(!$val->id_attaque_gang) $val->id_attaque_gang = rand(2,3);
				if(!$val->id_defense_gang) $val->id_defense_gang = rand(2,3);
				
				$id_gang[] = $val->id_attaque_gang;
				$id_gang[] = $val->id_defense_gang;
			}
			
			$liste_gang = $this->db->select('id, nom_gang')
														 ->from('gangs')
														 ->in('id', array_unique($id_gang) )
														 ->get();
			
			if( $liste_gang->count() )
			{
				foreach( $liste_gang as $val )
					$id_gang[$val->id] = $val->nom_gang;
				
				foreach( $query as $val )
				{
					$text = str_replace('{attaque}', $val->attaque, $val->texte);
					$text = str_replace('{defense}', $val->defense, $text);
					$text = str_replace('{gang_attaque}', $id_gang[$val->id_attaque_gang], $text);
					$text = str_replace('{gang_defense}', $id_gang[$val->id_defense_gang], $text);
					$text = str_replace('{argent}', number_format($val->argent).' $', $text);
					$text = str_replace('{position}', $val->position, $text);
					$text = str_replace('{nombre_attaque}', $val->nombre_attaque, $text);
					
					$articles[] = array( 'value' => $val, 'text' => $text );
				}
			}
			return $articles;
		}
		return false;
	}
	
	/**
	* Méthode : 
	* @return
	*/
	public function unique( $id = false ) 
	{
		$articles = false;
		
		$query = $this->db->select('*, journal.id as id')
											->from('journal')
											->join('journal_articles', 'journal_articles.id', 'journal.id_article')
											->where('journal.id', $id)
											->limit(1)
											->get();
		
		if( $query->count() )
		{
			$id_gang[] = $query->current()->id_attaque_gang;
			$id_gang[] = $query->current()->id_defense_gang;
			
			$liste_gang = $this->db->select('id, nom_gang')
														 ->from('gangs')
														 ->in('id', array_unique($id_gang) )
														 ->get();
			
			if( $liste_gang->count() )
			{
				foreach( $liste_gang as $val )
					$id_gang[$val->id] = $val->nom_gang;
				
				foreach( $query as $val )
				{
					if(!isset($id_gang[$val->id_attaque_gang])) $id_gang[$val->id_attaque_gang] = 'inconnu';
					if(!isset($id_gang[$val->id_defense_gang])) $id_gang[$val->id_defense_gang] = 'inconnu';
					
					$text = str_replace('{attaque}', $val->attaque, $val->texte);
					$text = str_replace('{defense}', $val->defense, $text);
					$text = str_replace('{gang_attaque}', $id_gang[$val->id_attaque_gang], $text);
					$text = str_replace('{gang_defense}', $id_gang[$val->id_defense_gang], $text);
					$text = str_replace('{argent}', number_format($val->argent).' $', $text);
					$text = str_replace('{position}', $val->position, $text);
					$text = str_replace('{nombre_attaque}', $val->nombre_attaque, $text);
					
					$articles[] = array( 'value' => $val, 'text' => $text );
				}
			}
			return $articles;
		}
		return false;
	}
	
	/**
	* Méthode : 
	* @return
	*/
	public function attaque_victoire( $attaque, $defense, $argent= 0, $nombre_attaque = 1)
	{
		$image = rand(0,3) > 0 && isset($defense->avatar) ? '/avatars/'.$defense->avatar : '/avatars/'.$attaque->avatar;
		
		$array = array('id_article' => self::select_article_random( 1 ),
									 'attaque' => $attaque->username,
									 'defense' => $defense->username,
									 'id_attaque_gang' => $attaque->id_gang,
									 'id_defense_gang' => $defense->id_gang,
									 'date' => date::NOW(),
									 'argent' => $argent,
									 'position' => chr($attaque->y + 64).' - '.$attaque->x,
									 'nombre_attaque' => $nombre_attaque,
									 'image' => '/avatars/'.$attaque->avatar );
		
		self::insertion( $array );
	}
	
	/**
	* Méthode : 
	* @return
	*/
	public function attaque_defaite( $attaque, $defense, $argent= 0, $nombre_attaque = 1)
	{	
		$image = rand(0,3) == 0 && isset($defense->avatar) ? '/avatars/'.$defense->avatar : '/avatars/'.$attaque->avatar;
	
		$array = array('id_article' => self::select_article_random( 2 ),
									 'attaque' => $attaque->username,
									 'defense' => $defense->username,
									 'id_attaque_gang' => $attaque->id_gang,
									 'id_defense_gang' => $defense->id_gang,
									 'date' => date::NOW(),
									 'argent' => $argent,
									 'position' => chr($attaque->y + 64).' - '.$attaque->x,
									 'nombre_attaque' => $nombre_attaque,
									 'image' => $image );
		
		self::insertion( $array );
	}
	
	/**
	* Méthode : 
	* @return
	*/
	public function attaque_victoire_bot( $attaque, $nom_bot, $argent= 0, $nombre_attaque = 1)
	{		
		$array = array('id_article' => self::select_article_random( 1 ),
									 'attaque' => $attaque->username,
									 'defense' => $nom_bot,
									 'id_attaque_gang' => $attaque->id_gang,
									 'date' => date::NOW(),
									 'argent' => $argent,
									 'position' => chr($attaque->y + 64).' - '.$attaque->x,
									 'nombre_attaque' => $nombre_attaque,
									 'image' => '/avatars/'.$attaque->avatar );
		
		self::insertion( $array );
	}
	
	/**
	* Méthode : 
	* @return
	*/
	public function attaque_defaite_bot( $attaque, $nom_bot, $argent= 0, $nombre_attaque = 1)
	{		
		$array = array('id_article' => self::select_article_random( 2 ),
									 'attaque' => $attaque->username,
									 'defense' => $nom_bot,
									 'id_attaque_gang' => $attaque->id_gang,
									 'date' => date::NOW(),
									 'argent' => $argent,
									 'position' => chr($attaque->y + 64).' - '.$attaque->x,
									 'nombre_attaque' => $nombre_attaque,
									 'image' => '/avatars/'.$attaque->avatar );
		
		self::insertion( $array );
	}
	
	/**
	* Méthode : 
	* @return
	*/
	public function braquer_batiment_victoire( $attaque, $batiment, $argent= 0, $nombre_attaque = 1 )
	{
		$image = rand(0,3) == 0 ? '/avatars/'.$attaque->avatar : '/batiments/'.$batiment->image;
		
		$array = array('id_article' => self::select_article_random( 3 ),
									 'attaque' => $attaque->username,
									 'defense' => $batiment->nom,
									 'id_attaque_gang' => $attaque->id_gang,
									 'date' => date::NOW(),
									 'argent' => $argent,
									 'position' => chr($attaque->y + 64).' - '.$attaque->x,
									 'nombre_attaque' => $nombre_attaque,
									 'image' => $image );
		
		self::insertion( $array );
	}
	
	/**
	* Méthode : 
	* @return
	*/
	public function braquer_batiment_defaite( $attaque, $batiment, $argent= 0, $nombre_attaque = 1 )
	{
		$image = rand(0,3) == 0 ? '/batiments/'.$batiment->image : '/avatars/'.$attaque->avatar;
		
		$array = array('id_article' => self::select_article_random( 4 ),
									 'attaque' => $attaque->username,
									 'defense' => $batiment->nom,
									 'id_attaque_gang' => $attaque->id_gang,
									 'date' => date::NOW(),
									 'argent' => $argent,
									 'position' => chr($attaque->y + 64).' - '.$attaque->x,
									 'nombre_attaque' => $nombre_attaque,
									 'image' => $image );
		
		self::insertion( $array );
	}
	
	/**
	* Méthode : 
	* @return
	*/
	public function acheter_batiment( $attaque, $batiment )
	{
		$image = rand(0,3) == 0 ?  '/avatars/'.$attaque->avatar : '/batiments/'.$batiment->image;
		
		$array = array('id_article' => self::select_article_random( 5 ),
									 'attaque' => $attaque->username,
									 'defense' => $batiment->nom,
									 'id_attaque_gang' => $attaque->id_gang,
									 'date' => date::NOW(),
									 'argent' => $batiment->prix_achat,
									 'position' => chr($attaque->y + 64).' - '.$attaque->x,
									 'image' => $image );
		
		self::insertion( $array );
	}
	
	/**
	* Méthode : 
	* @return
	*/
	public function ecrasser_victoire( $attaque, $defense, $argent= 0 )
	{
		$array = array('id_article' => self::select_article_random( 6 ),
									 'attaque' => $attaque->username,
									 'defense' => $defense->username,
									 'id_attaque_gang' => $attaque->id_gang,
									 'id_defense_gang' => $defense->id_gang,
									 'date' => date::NOW(),
									 'argent' => $argent,
									 'position' => chr($attaque->y + 64).' - '.$attaque->x,
									 'image' => '/avatars/'.$defense->avatar );
		
		self::insertion( $array );
	}
	
	/**
	* Méthode : 
	* @return
	*/
	public function ecrasser_defaite( $attaque, $defense, $argent= 0 )
	{
		$array = array('id_article' => self::select_article_random( 7 ),
									 'attaque' => $attaque->username,
									 'defense' => $defense->username,
									 'name_attaque_gang' => $attaque->username_gang,
									 'name_defense_gang' => $defense->username_gang,
									 'date' => date::NOW(),
									 'argent' => $argent,
									 'position' => chr($attaque->y + 64).' - '.$attaque->x,
									 'image' => $image );
		
		self::insertion( $array );
	}
	
	/**
	* Méthode : 
	* @return
	*/
	public function prison( $flic, $defense )
	{
		$array = array('id_article' => self::select_article_random( 8 ),
									 'attaque' => $flic->username,
									 'defense' => $defense->username,
									 'name_attaque_gang' => 1,
									 'name_defense_gang' => $defense->username_gang,
									 'date' => date::NOW(),
									 'position' => chr($flic->y + 64).' - '.$flic->x,
									 'image' => $image );
		
		self::insertion( $array );
	}
	
	/**
	* Méthode : 
	* @return
	*/
	public function voler_argent_victoire( $attaque, $defense, $argent= 0 )
	{
		$array = array('id_article' => self::select_article_random( 9 ),
									 'attaque' => $attaque->username,
									 'defense' => $defense->username,
									 'name_attaque_gang' => $attaque->username_gang,
									 'name_defense_gang' => $defense->username_gang,
									 'date' => date::NOW(),
									 'argent' => $argent,
									 'position' => chr($attaque->y + 64).' - '.$attaque->x,
									 'image' => $image );
		
		self::insertion( $array );
	}
	
	/**
	* Méthode : 
	* @return
	*/
	public function voler_argent_defaite( $attaque, $defense, $argent= 0 )
	{
		$array = array('id_article' => self::select_article_random( 10 ),
									 'attaque' => $attaque->username,
									 'defense' => $defense->username,
									 'name_attaque_gang' => $attaque->username_gang,
									 'name_defense_gang' => $defense->username_gang,
									 'date' => date::NOW(),
									 'argent' => $argent,
									 'position' => chr($attaque->y + 64).' - '.$attaque->x,
									 'image' => $image );
		
		self::insertion( $array );
	}
	
	/**
	* Méthode : 
	* @return
	*/
	public function denoncer_victoire( $attaque, $defense, $argent= 0 )
	{
		$array = array('id_article' => self::select_article_random( 11 ),
									 'attaque' => $attaque->username,
									 'defense' => $defense->username,
									 'name_attaque_gang' => $attaque->username_gang,
									 'name_defense_gang' => $defense->username_gang,
									 'date' => date::NOW(),
									 'argent' => $argent,
									 'position' => chr($attaque->y + 64).' - '.$attaque->x,
									 'image' => $image );
		
		self::insertion( $array );
	}
	
	/**
	* Méthode : 
	* @return
	*/
	public function denoncer_defaite( $attaque, $defense, $argent= 0 )
	{
		$array = array('id_article' => self::select_article_random( 12 ),
									 'attaque' => $attaque->username,
									 'defense' => $defense->username,
									 'name_attaque_gang' => $attaque->username_gang,
									 'name_defense_gang' => $defense->username_gang,
									 'date' => date::NOW(),
									 'argent' => $argent,
									 'position' => chr($attaque->y + 64).' - '.$attaque->x,
									 'image' => $image );
		
		self::insertion( $array );
	}
	
	/**
	* Méthode : 
	* @return
	*/
	public function count_all( ) 
	{
		$query = $this->db->select('count(id) as nbr')->from('journal')->get();
		
		return $query->count() ? $query->current()->nbr : 0;
	}
	
	/**
	* Méthode : 
	* @return
	*/
	private function insertion( array $array ) 
	{	
		return $this->db->insert('journal', $array );
	}
	
	/**
	* Méthode : 
	* @return
	*/
	private function select_article_random( $type = 0 ) 
	{
		$query = $this->db->select('id')->from('journal_articles')->where( array('type' => $type, 'actif' => 1 ) )->orderby(null, 'RAND()')->limit(1)->get();
		
		return $query->count() ? $query->current()->id : false;
	}
}
?>