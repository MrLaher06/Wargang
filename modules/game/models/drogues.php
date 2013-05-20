<?php
defined('SYSPATH') or die('Access non autoris&eacute;.');

class Drogues_Model extends Model
{
	protected static $instance;
	 
	public static function instance()
	{
		if (Drogues_Model::$instance == NULL)
			new Drogues_Model;

		return Drogues_Model::$instance;
	}
	
	public function __construct()
	{
		parent::__construct();
		Drogues_Model::$instance = $this;
	}
	
	/**
	* Methode : pour selection un personnage
	*/
	public function select_liste( $niveau = 100 ) 
	{
		$query = $this->db->from('drogues')->orderby('prix', 'ASC')->get();	
		
		if($query->count())
		{
			foreach( $query as $val )
					$resultat[] = $val;
					
			return $resultat;
		}
		
		return false;
	}
	
	/**
	* Methode : detail de la drogue selon ID
	*/
	public function detail_drogue( $id ) 
	{
		$query = $this->db->from('drogues')->where('id',$id)->limit(1)->get();
		
		return $query->count() ? $query->current() : false;
	}
	
	/**
	* Methode : drogue par personnage
	*/
	public function drogue_user( $id = false ) 
	{
		$liste_drogue = array();
		
		$donnees = $this->db->from('users_drogues')->where( 'id_user', $id )->get();
		
		if( $donnees->count() )
		{
			foreach( $donnees as $val )
				$liste_drogue[$val->id_drogue][] = $val;
				
			return $liste_drogue;
		}
					
		return $liste_drogue;
	}
	
	/**
	* Methode : drogue par personnage
	*/
	public function vente_drogue ()
	{
		$vente_drogue = $this->_cache->get( 'ventre_auto_drogue' );
		
		if( is_null( $vente_drogue ) )
		{
			$minute = rand(2,15);
			
			$stock_vente = false;
			
			$vente_drogue = date("H:i:s");
			
			$this->_cache->set( 'ventre_auto_drogue', $vente_drogue, array( 'drogues' ), $minute * 60 );
			
			$query = $this->db->select('*, users_drogues.id as id')->from('users_drogues')->join('drogues', 'drogues.id', 'users_drogues.id_drogue')->get();
			
			if($query->count())
			{
				foreach($query as $val)
				{
					if( !isset( $stock_vente[$val->id_user][$val->id_drogue] ) )
					{
						$this->db->delete('users_drogues', array('id' => $val->id));
						$stock_vente[$val->id_user][$val->id_drogue] = $val->prix;
					}
				}
				
				if( $stock_vente )
				{
					foreach($stock_vente as $key => $val )
					{
						$perso = new User_Model;
						
						$perso->selection_id( $key, 'argent, xp, vente_drogue, username, id_gang' );
						
						$argent = 0;
						foreach($val as $arg)
						{
							$argent += $perso->prison ? round( $arg /2 ) : $arg;
							$perso->xp++;
							$perso->vente_drogue++;
						}
						
						Tchat_Model::instance()->insertion( $perso->username, 'Vente de '.count($val).' drogue(s) pour : '.number_format( $argent + round( $argent * ( 20 / 100) ) ) .' $', $perso->id_gang, 'alert' );
						
						$perso->argent += $argent + round( $argent * ( 20 / 100) );
						
						if(!$perso->recherche)
							$perso->recherche = rand(0,1);
						
						$perso->update( array('argent' => $perso->argent, 'xp' => $perso->xp, 'vente_drogue' => $perso->vente_drogue, 'recherche' => $perso->recherche ) );
					}
				}
			}
		}
		
		return $vente_drogue;
	}
	
	/**
	* Methode : drogue par personnage
	*/
	public function insert_achat( $id_user = false, $id_drogue = false, $quantite = false  ) 
	{
		for($n=0; $n < $quantite; $n++)
			self::insertion( $id_user, $id_drogue ) ;
	}
	
	/**
	* Methode : insertion d'une ligne dans user drogue
	*/
	public function insertion( $id_user, $id_drogue ) 
	{					
		return $this->db->insert('users_drogues', array( 'id_user' => $id_user, 'id_drogue' => $id_drogue ) );
	}
}
?>