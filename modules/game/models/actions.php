<?php
defined('SYSPATH') or die('Access non autoris&eacute;.');

class Actions_Model extends Model
{
	private $batiment = false;
	
	private $users = false;
	
	private $bots = false;
	
	protected static $instance;
	 
	public static function instance()
	{
		if (Actions_Model::$instance === NULL)
			new Actions_Model;

		return Actions_Model::$instance;
	}
	
	public function __construct()
	{
		parent::__construct();
		Actions_Model::$instance = $this;
	}
	
	/**
	* Methode : pour selection de toutes les actions
	*/
	public function selection( $x, $y, $my_id = false ) 
	{
		$array = array( 'carte.x' => $x, 'carte.y' => $y );
		$where = array( 'combats.id_defense' => 'carte.id', 'combats.id_attaque' => $my_id, 'combats.actif' => 1 );
		
		$this->batiment = $this->db->select('SQL_NO_CACHE *, carte.id as id, carte.id_gang as id_gang, ( SELECT MAX(protection) FROM carte ) as protection_max, combats.id as id_combat')
															 ->from('carte')
															 ->join('gangs', 'gangs.id', 'carte.id_gang', 'LEFT')
													  	 ->join('combats', $where, 'combats.type_defense = user', 'LEFT')
															 ->where( $array )
															 ->limit(1)
															 ->get();
															 
		$array = array( 'users.x' => $x, 'users.y' => $y, 'users.planque' => 0, 'users.id !=' => $my_id );
		$where = array( 'combats.id_defense' => 'users.id', 'combats.id_attaque' => $my_id, 'combats.actif' => 1 );
		
		$this->users = $this->db->select('SQL_NO_CACHE *, users.id as id, gangs.id as id_gangs, combats.id as id_combat')
														->from('users')
														->join('vehicules', 'vehicules.id', 'users.id_vehicule', 'LEFT')
														->join('armes', 'armes.id', 'users.id_arme', 'LEFT')
														->join('gangs', 'gangs.id', 'users.id_gang', 'LEFT')
													  ->join('combats', $where, 'combats.type_defense = user', 'LEFT')
														->where( $array )
														->get();
		
		$array = array( 'ennemis.x' => $x, 'ennemis.y' => $y );
		$where = array( 'combats.id_defense' => 'ennemis.id', 'combats.id_attaque' => $my_id, 'combats.actif' => 1 );
		
		$this->bots = $this->db->select('SQL_NO_CACHE *, ennemis.id as id, ennemis.x as x, ennemis.y as y, combats.id as id_combat')
													 ->from('ennemis')
													 ->join('vehicules', 'vehicules.id', 'ennemis.id_vehicule', 'LEFT')
													 ->join('armes', 'armes.id', 'ennemis.id_arme', 'LEFT')
													 ->join('combats', $where, 'combats.type_defense = bot', 'LEFT')
													 ->where( $array )
													 ->get();

		return round( $this->batiment->count() + $this->users->count() + $this->bots->count() );
	}
	
	/**
	* Methode : envoie les informations du/des batiments
	*/
	public function batiment()
	{
		return ( $this->batiment && $this->batiment->count() ) ? $this->batiment->current() : false;
	}
	
	/**
	* Methode : envoie les informations du/des joueurs
	*/
	public function users()
	{
		return ( $this->users && $this->users->count() ) ? $this->users : false;
	}
	
	/**
	* Methode : envoie les informations du/des bots
	*/
	public function bots()
	{
		return ( $this->bots && $this->bots->count() ) ? $this->bots : false;
	}
	
	/**
	* Methode : pour vérifier que le user est en combat (lanceur)
	*/
	public function verif_user_lanceur( $id_user ) 
	{	
		$query = $this->db->select('id_defense, type_defense')
											->from('combats')
											->where(array( 'id_attaque' => $id_user, 'actif' => 1, 'id_combat' => 0 ) )
											->limit(1)
											->get();
											
		return $query->count() ? $query->current() : false;
	}
	
	/**
	* Methode : pour vérifier que le user est en combat (participation)
	*/
	public function verif_user_participe( $id_user ) 
	{	
		return $this->db->select('id')
											->from('combats')
											->where(array( 'id_attaque' => $id_user, 'actif' => 1, 'id_combat !=' => 0 ) )
											->limit(1)
											->get()
											->count();
	}
	
	/**
	* Methode : pour vérifier que le user est en combat (participation)
	*/
	public function verif_victoire() 
	{	
		return $this->db->select('id')->from('parties')->where('en_cours_partie', 1 )->limit(1)->get()->count() ? false : true;
	}
}
?>