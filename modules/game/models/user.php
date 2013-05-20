<?php defined('SYSPATH') OR die('No direct access allowed.');

class User_Model extends Auth_User_Model {
	
	/**
	* Methode : pour selection un personnage
	*/
	public function selection_id( $id = false, $select = '*', $traitement = true ) 
	{
		$query = $this->db->select($select)->from('users')->where( 'id', $id )->limit(1)->get();
		
		if( $traitement && $query->count() )
		{
			$this->id = $id;
						
			foreach( $query->current() as $key => $val )
				$this->$key = $val;
		}
		
		return $query->count() ? $query->current() : false;
	}
	
	/**
	* Methode : pour verifier si l'email n'existe pas
	*/
	public function verification_mail( $email = false ) 
	{
		return $this->db->select('id')->from('users')->where( 'email', $email )->limit(1)->get()->count();
	}
	
	/**
	* Methode : pour verifier si banni
	*/
	public function verification_banni( $ip ) 
	{
		return $this->db->select('id')->from('users')->where( array( 'ip' => $ip, 'banni' => 1 ) )->limit(1)->get()->count();
	}
	
	/**
	* Methode : modifier le mot de passe
	*/
	public function modifier_mot_de_passe( $email ) 
	{
		$salt = 'abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ0123456789';
		$makepass	= '';
		mt_srand( 10000000 * (double)microtime() );
		
		for ($i = 0; $i < 8; $i++)
			$makepass .= $salt[mt_rand(0,61)];
		
		if( $this->db->update('users', array( 'password' => Auth::instance()->hash_password( $makepass ) ), array( 'email' => $email ) ) )
			return $makepass;
		
		return false;
	}
	
	/**
	* Methode : pour inserer un personnage
	*/
	public function insertion( array $array ) 
	{	
		$array['id_gang'] = 2;
		$array['avatar'] = 'avatar'.rand(1,25).'.jpg';
			
		if( $this->db->select('id_gang')->from('users')->orderby('id', 'DESC')->limit(1)->get()->current()->id_gang != 3 )
			$array['id_gang'] = 3;			
		
		if( $query = $this->db->insert('users', $array ) )
		{
			if( $this->db->insert('roles_users', array('user_id' => $query->insert_id(), 'role_id' => 1 ) ) )
				return true;
		}
		
		return false;
	}
	
	/**
	* METHODE : UPDATE UN USER
	**/
	public function update( array $set )
	{	
		$set['last_activity'] = time();
		
		return $this->db->update('users', $set , array( 'id' =>  $this->id ) );
	}
	
	/**
	* Methode : pour inserer un personnage
	*/
	public function modifier() 
	{	
		if( $this->hp < 0 )
			$this->hp = 0;
			
		if( $this->hp > 100 )
			$this->hp = 100;
			
		if( $this->argent < 0 )
			$this->argent = 0;
			
		if( $this->xp < 0 )
			$this->xp = 0;
			
		if( $this->niveau < 0 )
			$this->niveau = 0;
			
		if( $this->id_gang == 0 )
			$this->id_gang = rand(2,3);
			
		self::increment_niveau();
			
		if( $this->niveau > 100 )
			$this->niveau = 100;
			
		if( $this->x > Kohana::config( 'carte.taille_carte' ) )
			$this->x = Kohana::config( 'carte.taille_carte' );
			
		if( $this->y > Kohana::config( 'carte.taille_carte' ) )
			$this->y = Kohana::config( 'carte.taille_carte' );
				
		foreach( $this->object as $key => $val )
			$array[$key] = $val;
			
		$array['last_activity'] = time();
		$array['planque'] = 0;
		$array['ip'] = $_SERVER['REMOTE_ADDR'];
				
		return $this->db->update('users', $array, array( 'id' => $this->id ) );
	}
	
	/* 
	* Methode : pour le delai de déplacement
	*/
	public function delai_move( $vehicule )
	{
		$temps = $vehicule - ( time() - $this->time_move );
		
		return ( $temps < 0 ) ? 0 : $temps;
	}

	/**
	* Methode : afficher le xp du personnage
	*/
	public function view_xp() 
	{		
		$diviseur = self::niveau_suivant() / 100;
			
		return (int) round($this->xp / $diviseur);
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
	* Methode : pourcentage Niveau suivant
	*/
	public function prison() 
	{
		if($this->prison)
		{
			$lvl = $this->niveau < 1 ? 1 : $this->niveau;
			
			if( ( time() - ( $lvl * 5 * 60 ) ) < $this->prison )
				return date::convertir_date( $this->prison - ( time() - ( $lvl * 5 * 60 ) ) );
			
			$this->prison = 0;
			self::modifier();
			
		}
		return false;
	}
	
	/**
	* Methode : pour la mort
	*/
	public function mort() 
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
		
		$this->db->delete('users_drogues', array('id_user' => $this->id));
		$this->db->update('carte', array( 'id_user' => 0, 'id_gang' => 0, 'proprio' => '' ) , array( 'id_user' =>  $this->id ) );
		$this->db->update('users_mission', array( 'actif' => 0 ) , array( 'id_user' =>  $this->id ) );
		
		$from    = 'Wargang <'.Kohana::config('game.mail_site').'>';
		$subject = 'War gang';
		$message = 'Vous êtes mort.';
		
		email::send($this->email, $from, $subject, $message, true);
		
		Statistiques_Model::instance()->insertion( $this->id, 'game_over' );
		Tchat_Model::instance()->insertion( $this->username, '<blink class="rouge">GAME OVER</blink>', $this->id_gang, 'alert' );
		
		return $this->db->update('users', $array, array( 'id' => $this->id ) );
	}
	
} // End User Model
?>