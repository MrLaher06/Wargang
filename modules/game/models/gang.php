<?php
defined('SYSPATH') or die('Access non autoris&eacute;.');

class Gang_Model extends Model
{
	protected static $instance;
	 
	public static function instance()
	{
		if (Gang_Model::$instance == NULL)
			new Gang_Model;

		return Gang_Model::$instance;
	}
	
	public function __construct()
	{
		parent::__construct();
		Gang_Model::$instance = $this;
	}
	
	/**
	* Methode : pour selection un gang
	*/
	public function select_id( $id = false ) 
	{	
		$query = $this->db->from('gangs')->where( 'id', $id )->limit(1)->get();		
		
		if($query->count())
		{
			foreach( $query->current() as $key => $val )
				$this->$key = $val;
		}
		
		return $this;
	}
	
	/**
	* Méthode : 
	* @return
	*/
	public function combat_bot( $id_gang, $id_user = 0 )
	{	
		$query = $this->db->select('*, users.id as id, combats.id as id_combat, users.x as x, users.y as y, ennemis.image as image')
											->from('combats')
											->join('users', 'users.id', 'combats.id_attaque')
											->join('ennemis', 'ennemis.id', 'combats.id_defense')
											->join('vehicules', 'vehicules.id', 'ennemis.id_vehicule', 'LEFT')
											->where( array( 'gang_attaque' => $id_gang, 'type_defense' => 'bot', 'actif' => 1 ) )
											->where('( id_combat = 0 OR ( id_combat != 0 AND id_attaque = '.$id_user.' ) )')
											->get();
	
		return $query->count() ? $query : false;
	}
	
	/**
	* Méthode : 
	* @return
	*/
	public function combat_user( $id_gang, $id_user = 0 )
	{	
		$query = $this->db->select('*, users.id as id, combats.id as id_combat, users.x as x, users.y as y')
											->from('combats')
											->join('users', 'users.id', 'combats.id_defense')
											->join('gangs', 'gangs.id', 'users.id_gang', 'LEFT')
											->join('vehicules', 'vehicules.id', 'users.id_vehicule', 'LEFT')
											->where( array( 'gang_attaque' => $id_gang, 'type_defense' => 'user', 'actif' => 1 ) )
											->where('( id_combat = 0 OR ( id_combat != 0 AND id_attaque = '.$id_user.' ) )')
											->get();
	
		return $query->count() ? $query : false;
	}
	
	/**
	* Méthode : 
	* @return
	*/
	public function combat_batiment( $id_gang, $id_user = 0 )
	{	
		$query = $this->db->select('*, users.id as id, combats.id as id_combat, users.x as x, users.y as y, carte.image as image, ( SELECT MAX(protection) FROM carte ) as protection_max')
											->from('combats')
											->join('users', 'users.id', 'combats.id_attaque')
											->join('carte', 'carte.id', 'combats.id_defense')
											->join('gangs', 'gangs.id', 'users.id_gang', 'LEFT')
											->where( array( 'gang_attaque' => $id_gang, 'type_defense' => 'batiment', 'actif' => 1 ) )
											->where('( id_combat = 0 OR ( id_combat != 0 AND id_attaque = '.$id_user.' ) )')
											->get();
	
		return $query->count() ? $query : false;
	}
	
	/**
	* Methode : liste des paticipant
	*/
	public function list_participant( $id_combat ) 
	{	
		$query = $this->db->select('users.id as id, combats.id as id_combat_particpant, users.username as username')
											->from('combats')
											->join('users', 'users.id', 'combats.id_attaque')
											->where(array('id_combat' => $id_combat, 'actif' => 1 ) )
											->get();
											
		if( $query->count() )
		{
			foreach( $query as $val )
				$var[$val->id] = $val;
			
			return $var;
		}
			
		return false;	
	}
	
	/**
	* Methode : pour vérifier que le user est en combat
	*/
	public function verif_user_participe( $id_user ) 
	{	
		return $this->db->select('id')
											->from('combats')
											->where(array( 'id_attaque' => $id_user, 'actif' => 1 ) )
											->limit(1)
											->get()->count();
	}
	
	/**
	* Methode : lister les users d'un meme gang
	*/
	public function liste_users_gang( $id_gang ) 
	{	
		$query = $this->db->select('*, users.id as id')
											->from('users')
											->join('gangs', 'gangs.id', 'users.id_gang' )
											->where('id_gang', $id_gang)
											->orderby(array('niveau' => 'DESC', 'argent' => 'DESC'))
											->get();
											
		return $query->count() ? $query : false;
	}
	
	/**
	* METHODE : INSERTION UN GANG
	**/
	public function insert( array $set )
	{		
		return $this->db->insert('gangs', $set )->insert_id();
	}
	
	/**
	* Methode : pour inviter de nouveaux joueurs ds son gang
	*/
	public function liste_invite_gang( $id_gang, $id_user ) 
	{	
		return $this->db->select('users.id, username, couleur_gang')
										->from('users')
										->join('gangs', 'gangs.id', 'users.id_gang' )
										->where(array('users.id_gang !=' => $id_gang, 
																	'last_activity > ' => ( time() - ( 60 * 60 * 24 * 2 ) ),
																	'id_gang !=' => 1) )
										->where('users.id != gangs.id_user_gang AND users.id != '.$id_user) 
										->orderby('username', 'ASC')
										->get();
	}
	
	/**
	* METHODE : INSERTION UNE INVITE
	**/
	public function insert_invitation( array $set )
	{		
		return $this->db->insert('gangs_invitations', $set )->insert_id();
	}
	
	/**
	* METHODE : DELETE UNE INVITE
	**/
	public function delete_invitation( $id )
	{		
		return $this->db->delete('gangs_invitations', array('id' => $id));
	}
	
	/**
	* Méthode : 
	* @return
	*/
	public function invitation_en_cours( $id )
	{	
		$query = $this->db->select('*, gangs_invitations.id as id, users.id as id_user')
											->from('gangs_invitations')
											->join('users', 'users.id', 'gangs_invitations.id_user_invit')
											->join('gangs', 'gangs.id', 'users.id_gang')
											->where( 'id_gang_invit', $id )
											->get();
	
		return $query->count() ? $query : false;
	}
	
	/**
	* Méthode : 
	* @return
	*/
	public function invitation_demande( $id )
	{	
		$query = $this->db->select('*, gangs_invitations.id as id, users.id as id_user')
											->from('gangs_invitations')
											->join('users', 'users.id', 'gangs_invitations.id_user_invit')
											->join('gangs', 'gangs.id', 'gangs_invitations.id_gang_invit')
											->where( 'id_user_invit', $id )
											->get();
	
		return $query->count() ? $query : false;
	}
	
	/**
	* Méthode : 
	* @return
	*/
	public function invitation_detail( $id )
	{	
		$query = $this->db->select('id_gang_invit')->from('gangs_invitations')->where( 'id', $id )->limit(1)->get();
	
		return $query->count() ? $query->current()->id_gang_invit : false;
	}
	
	/**
	* Methode : lister les users d'un meme gang
	*/
	public function email( $id ) 
	{	
		$query = $this->db->select('email')->from('users')->where('id', $id)->limit(1)->get();
											
		return $query->count() ? $query->current()->email : false;
	}
	
	/**
	* METHODE : UPDATE UN USER
	**/
	public function change_chef( $id, $id_gang )
	{			
		return $this->db->update('gangs', array('id_user_gang' => $id ) , array( 'id' =>  $id_gang ) );
	}
}
?>