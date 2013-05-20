<?php
defined('SYSPATH') or die('Access non autoris&eacute;.');

class Batiment_Model extends Model
{
	protected static $instance;
	 
	public static function instance()
	{
		if (Batiment_Model::$instance === NULL)
			new Batiment_Model;

		return Batiment_Model::$instance;
	}
	
	public function __construct()
	{
		parent::__construct();
		Batiment_Model::$instance = $this;
	}
	
	/**
	* Methode : pour selection batiment selon position
	*/
	public function select_id( $id ) 
	{
		$query = $this->db->from('carte')
											->where( 'id', $id )
											->limit(1)
											->get();
		
		return $query->count() ? $query->current() : false;
	}
	
	/**
	* Methode : pour selection batiment selon position
	*/
	public function selection( $x, $y ) 
	{
		$query = $this->db->select('*, carte.id as id, carte.id_gang as id_gang, ( SELECT MAX(protection) FROM (`carte`) ) as protection_max')
											->from('carte')
											->join('gangs', 'gangs.id', 'carte.id_gang', 'LEFT')
											->where( array( 'x' => $x, 'y' => $y ) )
											->limit(1)
											->get();
		
		return $query->count() ? $query->current() : false;
	}
	
	/**
	* Methode : mettre a jour un batiment
	*/
	public function update( array $set, $id )
	{			
		return $this->db->update('carte', $set , array( 'id' =>  $id ) );
	}
	
	/**
	* Methode : liste des vehicules dans les batiments
	*/
	public function vehicule( $id_batiment = false )
	{
		$query = $this->db->select('*, (SELECT count(id) FROM users WHERE users.id_vehicule = vehicules.id GROUP BY  users.id_vehicule ) as nb_utiliser, (SELECT count(id) FROM parking WHERE parking.id_vehicule = vehicules.id GROUP BY  parking.id_vehicule ) as nb_parking')
											->from('vehicules')
											->where('id_batiment', $id_batiment)
											->orderby('niveau_vehicule','ASC')
											->get();
		
		return $query->count() ? $query : false;
	}
	
	/**
	* Methode : liste des armes dans les batiments
	*/
	public function arme()
	{			
		$query = $this->db->select('*, (SELECT count(id) FROM users WHERE users.id_arme = armes.id GROUP BY  users.id_arme ) as nb_utiliser')
											->from('armes')
											->orderby('niveau_arme','ASC')
											->get();
		
		return $query->count() ? $query : false;
	}
	
	/**
	* Methode : liste des protection dans les batiments
	*/
	public function protection()
	{	
		$query = $this->db->select('*, (SELECT count(id) FROM users WHERE users.id_protection = protections.id GROUP BY  users.id_protection ) as nb_utiliser')
											->from('protections')
											->orderby('niveau_protection','ASC')
											->get();
		
		return $query->count() ? $query : false;
	}
	
	/**
	* Methode : liste des users pour des transfert de banque
	*/
	public function banque_users( $id = false, $id_gang = false )
	{	
		$query = $this->db->select('users.id, username')
											->from('users')
											->join('gangs', 'gangs.id', 'users.id_gang')
											->where( array( 'users.id_gang' => $id_gang, 'users.id !=' => $id, 'users.niveau >=' => 1 ) )
											->orderby('users.username','DESC')
											->get();
		
		return $query->count() ? $query : false;
	}
	
	/**
	* Methode : victoire dans les batiments
	*/
	public function victoire( $x = false, $y = false, $id_gang = false )
	{			
		$query = $this->db->select('argent, ( select count(id) from carte where id_user = users.id ) as batiment, id_user_gang, users.id, username')
											->from('users')
											->join('gangs', 'gangs.id', 'users.id_gang', 'LEFT')
											->where( array('planque' => 0, 'x' => $x, 'y' => $y, 'id_gang' => $id_gang, 'id_gang >' => 3) )
											->get();
		
		return $query->count() ? $query : false;
	}
	
	/**
	* Methode : pour selection batiment selon position
	*/
	public function listing( $type_option = false ) 
	{
		$this->db->select('*, carte.id as id, carte.x as x, carte.y as y')
					 	 ->from('carte')
						 ->join('users', 'users.id', 'carte.id_user', 'LEFT')
						 ->join('gangs', 'gangs.id', 'carte.id_gang', 'LEFT');
		
		if( $type_option )
			$this->db->where('type_option', $type_option );
						 
		$query = $this->db->orderby('nom','ASC')->get();
		
		return $query->count() ? $query : false;
	}
	
	/**
	* Methode : pour selection batiment de type autoroute
	*/
	public function autoroute( $id = false ) 
	{
		$query = $this->db->from('carte')
											->where( array('type_option'=>'autoroute', 'id != '=>$id) )
											->get();
		
		return $query->count() ? $query : false;
	}
	
	/**
	* Methode : liste des users qui sont flic
	*/
	public function liste_police_users()
	{	
		return $this->db->from('users')
											->where('id_gang', 1)
											->orderby('users.username','DESC')
											->get();
	}
	
	/**
	* Methode : liste des users qui sont flic
	*/
	public function nbr_users()
	{	
		$query = $this->db->select('COUNT(id) as nbr')
											->from('users')
											->orderby('users.username','DESC')
											->get();
		
		return $query->count() ? $query->current()->nbr : false;
	}
	
	/**
	* Methode : verifier si la partie n'est pas deja gagné
	*/
	public function verif_en_cours_victoire()
	{	
		$query = $this->db->select('en_cours_partie')
											->from('parties')
											->limit(1)
											->get();
		
		return $query->count() ? $query->current()->en_cours_partie : true;
	}
	
	/**
	* Methode : mettre a jour un batiment
	*/
	public function update_partie( array $set )
	{			
		return $this->db->update('parties', $set , array( 'en_cours_partie' =>  1 ) );
	}
	
	/**
	* Methode : on liste les dernieres missions du joueur effectué
	*/
	public function type_mission( $id_user )
	{
		$query = $this->db->select('type')
											->from('users_mission')
											->where(array('id_user' => $id_user))
											->limit(3)
											->orderby('id','DESC')
											->get();
		$type = false;
		
		if($query->count())
		{
			foreach($query as $val)
			{
				switch( $val->type )
				{
					case 'user' : $type[] = 1; break;
					case 'bot' : $type[] = 2; break;
					case 'batiment' : $type[] = 3; break;
					case 'vehicule' : $type[] = 4; break;
				}
			}
		}
			
		return self::rand_type_mission( $type );
	}
	
	private function rand_type_mission( $type = false )
	{
		$rand = rand(1,4);
		
		if( is_array($type) && in_array( $rand, $type ) )
			return self::rand_type_mission($type);
		
		return $rand;
	}
	
	/**
	* Methode : on liste les mission du joueur
	*/
	public function verif_mission( $id_user )
	{	
		return $this->db->from('users_mission')
										->where(array('id_user' => $id_user, 'id_combat' => 0))
										->get();
	}
	
	/**
	* Methode : demander une mission de type : USER
	*/
	public function demande_mission_user( $niv, $id_gang, $id_user = false )
	{	
		$query = $this->db->select('id, xp')
											->from('users')
											->where( array('id_gang !=' => $id_gang, 
																		'id !=' => $id_user, 
																		'niveau >=' => $niv, 
																		'last_login >=' => (time() - ( 60 * 60 * 24 * 2 ) ) ) )
											->where('id NOT IN ( SELECT id_user FROM users_mission WHERE actif = 1 AND id_user = users.id )')
											->orderby(NULL, 'RAND()')
											->limit(1)
											->get();
											
		return $query->count() ? $query->current() : false;
	}
	
	/**
	* Methode : demander une mission de type : BOT
	*/
	public function demande_mission_bot( $niv )
	{	
		$query = $this->db->select('id')
											->from('ennemis')
											->where('niveau <=', $niv)
											->orderby(NULL, 'RAND()')
											->limit(1)
											->get();
											
		return $query->count() ? $query->current() : false;
	}
	
	/**
	* Methode : demander une mission de type : BATIMENT
	*/
	public function demande_mission_batiment()
	{	
		$query = $this->db->select('id')
											->from('carte')
											->where('type_option !=', 'mafia' )
											->orderby(NULL, 'RAND()')
											->limit(1)
											->get();
											
		return $query->count() ? $query->current() : false;
	}
	
	/**
	* Methode : demander une mission de type : VEHICULE
	*/
	public function demande_mission_vehicule( $niv, $id_vehicule )
	{	
		$query = $this->db->select('id, prix_vehicule')
											->from('vehicules')
											->where( array('niveau_vehicule <=' => ($niv + 2), 'police' => 0, 'id !=' => $id_vehicule ) ) 
											->orderby(NULL, 'RAND()')
											->limit(1)
											->get();
											
		return $query->count() ? $query->current() : false;
	}
	
	/**
	* Methode : valider une mission : NON VEHICULE
	*/
	public function valide_mission( $type, $id_user, $id_mission, $date )
	{	
		$query = $this->db->select('combats.id as id, users_mission.id_combat as id_users_mission')
										  ->from('combats')
										  ->join('users_mission', 'users_mission.id_combat', 'combats.id', 'LEFT')
										  ->where( array('combats.type_defense' => $type,
																		 'combats.id_attaque' => $id_user,
																		 'combats.id_defense' => $id_mission,
																		 'combats.actif' => 0,
																		 'combats.id_combat' => 0,
																		 'combats.reussi' => 1,
																		 'combats.date >=' => $date ) )
										  ->limit(1)
										  ->get();
		
		return $query->count() ? $query->current() : false;
	}
	
	/**
	* Methode : mettre a jour un batiment
	*/
	public function mission( array $set, $id )
	{			
		return $this->db->update('users_mission', $set , array( 'id' =>  $id ) );
	}
	
	/**
	* Methode : mettre a jour un batiment
	*/
	public function annuler_toutes_mission( $id_user )
	{			
		return $this->db->update('users_mission', array('actif' => 0) , array( 'id_user' =>  $id_user ) );
	}
	
	/**
	* Methode : recuperer detail mission
	*/
	public function option_mission( $select, $from, $id_mission )
	{			
		return $this->db->select($select)->from($from)->where('id', $id_mission)->limit(1)->get();
	}
	
	/**
	* Methode : liste vehicule ds les parkings
	*/
	public function list_parking( $x, $y )
	{	
		$query = $this->db->select('*, parking.id as id')
											->from('parking')
										  ->join('users', 'users.id', 'parking.id_user')
										  ->join('vehicules', 'vehicules.id', 'parking.id_vehicule')
											->where(array('x_parking' => $x, 'y_parking' => $y))
											->get();
											
		return $query->count() ? $query : false;
	}
	
	/**
	* Methode : deposer un véhicule
	*/
	public function depot_vehicule( array $array ) 
	{	
		return $this->db->insert('parking', $array );
	}
	
	/**
	* Methode : supprimer un véhicule
	*/
	public function delete_parking( $id ) 
	{	
		return $this->db->delete('parking', array('id' => $id));
	}
	
	/**
	* Methode : recup info parking
	*/
	public function recuperer_vehicule( $id )
	{	
		$query = $this->db->from('parking')
											->where('id', $id)
											->get();
											
		return $query->count() ? $query->current() : false;
	}
	
	/**
	* Methode : argent vente véhicule
	*/
	public function argent_vente_parking( $id, $argent = 0 )
	{	
		$query = $this->db->select('argent')->from('users')->where( 'id', $id )->limit(1)->get();
		
		if( $query->count() )
			return $this->db->update('users', array('argent' => round( $query->current()->argent + $argent ) ) , array( 'id' =>  $id ) );
			
		return false;
	}
	
	/**
	* Methode : deposer un paris
	*/
	public function insert_paris( array $array ) 
	{	
		return $this->db->insert('equipe_football_paris', $array );
	}
}
?>