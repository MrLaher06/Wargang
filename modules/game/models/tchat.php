<?php
defined('SYSPATH') or die('Access non autoris&eacute;.');

class Tchat_Model extends Model
{
	protected static $instance;
	 
	public static function instance()
	{
		if (Tchat_Model::$instance == NULL)
			new Tchat_Model;

		return Tchat_Model::$instance;
	}
	
	public function __construct()
	{
		parent::__construct();
		Tchat_Model::$instance = $this;
	}
	
	/**
	* Methode : pour selection le contenu du tchat
	*/
	public function selection( $type = false ) 
	{
		$this->db->from('tchat')->where('timer >=', ( time() - 600 ) );
		
		if( $type )
			$this->db->where('type', $type );
			
		$query = $this->db->limit(100)->orderby('id', 'DESC')->get();
		
		return $query->count() ? $query : false;
	}
	
	/**
	* Methode : pour connaitre le monde de joueur sortie
	*/
	public function online() 
	{
		$query = $this->db->select('COUNT(id) as nbr')->from('users')->where('planque', 0)->get();
		
		return $query->count() ? $query->current()->nbr : false;
	}
	
	/**
	* Methode : insertion d'une ligne dans le tchat
	*/
	public function insertion( $name, $txt, $id_gang = false, $type = false ) 
	{	
		$name = strtolower($name);
		$type = strtolower($type);
	
		$this->db->delete('tchat', array('timer < ' => ( time() - 600 )));
		
		return $this->db->insert('tchat', array( 'name' => $name, 'texte' => self::bbCode( $txt ), 'id_gang' => $id_gang, 'timer' => time(), 'type' => $type ) );
	}
	
	/**
	* Methode : pour mettre en gras, italique... dans le texte du tchat
	*/
	public static function bbCode( $t )
	{	
		$t=str_replace("[b]", "<strong>", $t);
		$t=str_replace("[/b]", "</strong>", $t);
		$t=str_replace("[i]", "<em>", $t);
		$t=str_replace("[/i]", "</em>", $t);
		$t=str_replace("[u]", "<u>", $t);
		$t=str_replace("[/u]", "</u>", $t);
		
		
		$cheminSmiley = '/images/smiley';
		
		$t = str_replace( ':-)', '<img class="icon_tchat" src="'.$cheminSmiley.'/1.gif" title=":-)">', $t );
		$t = str_replace( ':)', '<img class="icon_tchat" src="'.$cheminSmiley.'/1.gif" title=":)">', $t );
		$t = str_replace( ':-O', '<img class="icon_tchat" src="'.$cheminSmiley.'/2.gif" title=":-O">', $t );
		$t = str_replace( ':o', '<img class="icon_tchat" src="'.$cheminSmiley.'/2.gif" title=":o">', $t );
		$t = str_replace( ';-)', '<img class="icon_tchat" src="'.$cheminSmiley.'/3.gif" title=";-)">', $t );
		$t = str_replace( ';)', '<img class="icon_tchat" src="'.$cheminSmiley.'/3.gif" title=";)">', $t );
		$t = str_replace( ':-S', '<img class="icon_tchat" src="'.$cheminSmiley.'/4.gif" title=":-S">', $t );
		$t = str_replace( ':s', '<img class="icon_tchat" src="'.$cheminSmiley.'/4.gif" title=":s">', $t );
		$t = str_replace( ':\'(', '<img class="icon_tchat" src="'.$cheminSmiley.'/5.gif" title=":\'(">', $t );
		$t = str_replace( '(H)', '<img class="icon_tchat" src="'.$cheminSmiley.'/6.gif" title="(H)">', $t );
		$t = str_replace( '(h)', '<img class="icon_tchat" src="'.$cheminSmiley.'/6.gif" title="(h)">', $t );
		$t = str_replace( '(A)', '<img class="icon_tchat" src="'.$cheminSmiley.'/7.gif" title="(A)">', $t );
		$t = str_replace( '(a)', '<img class="icon_tchat" src="'.$cheminSmiley.'/7.gif" title="(a)">', $t );
		$t = str_replace( ':-#', '<img class="icon_tchat" src="'.$cheminSmiley.'/8.gif" title=":-#">', $t );
		$t = str_replace( '8-|', '<img class="icon_tchat" src="'.$cheminSmiley.'/9.gif" title="8-|">', $t );
		$t = str_replace( ':-*', '<img class="icon_tchat" src="'.$cheminSmiley.'/010.gif" title=":-*">', $t );
		$t = str_replace( ':^)', '<img class="icon_tchat" src="'.$cheminSmiley.'/011.gif" title=":^)">', $t );
		$t = str_replace( '<:o)', '<img class="icon_tchat" src="'.$cheminSmiley.'/012.gif" title="<:o)">', $t );
		$t = str_replace( '|-)', '<img class="icon_tchat" src="'.$cheminSmiley.'/013.gif" title="|-)">', $t );
		$t = str_replace( '(Y)', '<img class="icon_tchat" src="'.$cheminSmiley.'/014.gif" title="(Y)">', $t );
		$t = str_replace( '(y)', '<img class="icon_tchat" src="'.$cheminSmiley.'/014.gif" title="(y)">', $t );
		$t = str_replace( '(B)', '<img class="icon_tchat" src="'.$cheminSmiley.'/015.gif" title="(B)">', $t );
		$t = str_replace( '(b)', '<img class="icon_tchat" src="'.$cheminSmiley.'/015.gif" title="(b)">', $t );
		$t = str_replace( '(X)', '<img class="icon_tchat" src="'.$cheminSmiley.'/016.gif" title="(X)">', $t );
		$t = str_replace( '(x)', '<img class="icon_tchat" src="'.$cheminSmiley.'/016.gif" title="(x)">', $t );
		$t = str_replace( '({)', '<img class="icon_tchat" src="'.$cheminSmiley.'/017.gif" title="({)">', $t );
		$t = str_replace( ':-[', '<img class="icon_tchat" src="'.$cheminSmiley.'/018.gif" title=":-[">', $t );
		$t = str_replace( ':[', '<img class="icon_tchat" src="'.$cheminSmiley.'/018.gif" title=":[">', $t );
		$t = str_replace( '(L)', '<img class="icon_tchat" src="'.$cheminSmiley.'/019.gif" title="(L)">', $t );
		$t = str_replace( '(l)', '<img class="icon_tchat" src="'.$cheminSmiley.'/019.gif" title="(l)">', $t );
		$t = str_replace( '(K)', '<img class="icon_tchat" src="'.$cheminSmiley.'/020.gif" title="(K)">', $t );
		$t = str_replace( '(k)', '<img class="icon_tchat" src="'.$cheminSmiley.'/020.gif" title="(k)">', $t );
		$t = str_replace( '(F)', '<img class="icon_tchat" src="'.$cheminSmiley.'/021.gif" title="(F)">', $t );
		$t = str_replace( '(f)', '<img class="icon_tchat" src="'.$cheminSmiley.'/021.gif" title="(f)">', $t );
		$t = str_replace( '(P)', '<img class="icon_tchat" src="'.$cheminSmiley.'/022.gif" title="(P)">', $t );
		$t = str_replace( '(p)', '<img class="icon_tchat" src="'.$cheminSmiley.'/022.gif" title="(p)">', $t );
		$t = str_replace( '(@)', '<img class="icon_tchat" src="'.$cheminSmiley.'/023.gif" title="(@)">', $t );
		$t = str_replace( '(T)', '<img class="icon_tchat" src="'.$cheminSmiley.'/024.gif" title="(T)">', $t );
		$t = str_replace( '(t)', '<img class="icon_tchat" src="'.$cheminSmiley.'/024.gif" title="(t)">', $t );
		$t = str_replace( '(8)', '<img class="icon_tchat" src="'.$cheminSmiley.'/025.gif" title="(8)">', $t );
		$t = str_replace( '(*)', '<img class="icon_tchat" src="'.$cheminSmiley.'/026.gif" title="(*)">', $t );
		$t = str_replace( '(sn)', '<img class="icon_tchat" src="'.$cheminSmiley.'/027.gif" title="(sn)">', $t );
		$t = str_replace( '(pl)', '<img class="icon_tchat" src="'.$cheminSmiley.'/028.gif" title="(pl)">', $t );
		$t = str_replace( '(pi)', '<img class="icon_tchat" src="'.$cheminSmiley.'/029.gif" title="(pi)">', $t );
		$t = str_replace( '(au)', '<img class="icon_tchat" src="'.$cheminSmiley.'/030.gif" title="(au)">', $t );
		$t = str_replace( '(um)', '<img class="icon_tchat" src="'.$cheminSmiley.'/031.gif" title="(um)">', $t );
		$t = str_replace( '(co)', '<img class="icon_tchat" src="'.$cheminSmiley.'/032.gif" title="(co)">', $t );
		$t = str_replace( '(st)', '<img class="icon_tchat" src="'.$cheminSmiley.'/033.gif" title="(st)">', $t );
		$t = str_replace( '(mo)', '<img class="icon_tchat" src="'.$cheminSmiley.'/034.gif" title="(mo)">', $t );
		$t = str_replace( ':-D', '<img class="icon_tchat" src="'.$cheminSmiley.'/035.gif" title=":-D">', $t );
		$t = str_replace( ':d', '<img class="icon_tchat" src="'.$cheminSmiley.'/035.gif" title=":d">', $t );
		$t = str_replace( ':-P', '<img class="icon_tchat" src="'.$cheminSmiley.'/036.gif" title=":-P">', $t );
		$t = str_replace( ':p', '<img class="icon_tchat" src="'.$cheminSmiley.'/036.gif" title=":p">', $t );
		$t = str_replace( ':-(', '<img class="icon_tchat" src="'.$cheminSmiley.'/037.gif" title=":-(">', $t );
		$t = str_replace( ':(', '<img class="icon_tchat" src="'.$cheminSmiley.'/037.gif" title=":(">', $t );
		$t = str_replace( ':-|', '<img class="icon_tchat" src="'.$cheminSmiley.'/038.gif" title=":-|">', $t );
		$t = str_replace( ':|', '<img class="icon_tchat" src="'.$cheminSmiley.'/038.gif" title=":|">', $t );
		$t = str_replace( ':-$', '<img class="icon_tchat" src="'.$cheminSmiley.'/039.gif" title=":-$">', $t );
		$t = str_replace( ':$', '<img class="icon_tchat" src="'.$cheminSmiley.'/039.gif" title=":$">', $t );
		$t = str_replace( ':-@', '<img class="icon_tchat" src="'.$cheminSmiley.'/040.gif" title=":-@">', $t );
		$t = str_replace( ':@', '<img class="icon_tchat" src="'.$cheminSmiley.'/040.gif" title=":@">', $t );
		$t = str_replace( '(6)', '<img class="icon_tchat" src="'.$cheminSmiley.'/041.gif" title="(6)">', $t );
		$t = str_replace( '8o|', '<img class="icon_tchat" src="'.$cheminSmiley.'/042.gif" title="8o|">', $t );
		$t = str_replace( '^o)', '<img class="icon_tchat" src="'.$cheminSmiley.'/043.gif" title="^o)">', $t );
		$t = str_replace( '+o(', '<img class="icon_tchat" src="'.$cheminSmiley.'/044.gif" title="+o(">', $t );
		$t = str_replace( '*-)', '<img class="icon_tchat" src="'.$cheminSmiley.'/045.gif" title="*-)">', $t );
		$t = str_replace( '8-)', '<img class="icon_tchat" src="'.$cheminSmiley.'/046.gif" title="8-)">', $t );
		$t = str_replace( '(C)', '<img class="icon_tchat" src="'.$cheminSmiley.'/047.gif" title="(C)">', $t );
		$t = str_replace( '(c)', '<img class="icon_tchat" src="'.$cheminSmiley.'/047.gif" title="(c)">', $t );
		$t = str_replace( '(N)', '<img class="icon_tchat" src="'.$cheminSmiley.'/048.gif" title="(N)">', $t );
		$t = str_replace( '(n)', '<img class="icon_tchat" src="'.$cheminSmiley.'/048.gif" title="(n)">', $t );
		$t = str_replace( '(D)', '<img class="icon_tchat" src="'.$cheminSmiley.'/049.gif" title="(D)">', $t );
		$t = str_replace( '(d)', '<img class="icon_tchat" src="'.$cheminSmiley.'/049.gif" title="(d)">', $t );
		$t = str_replace( '(Z)', '<img class="icon_tchat" src="'.$cheminSmiley.'/050.gif" title="(Z)">', $t );
		$t = str_replace( '(z)', '<img class="icon_tchat" src="'.$cheminSmiley.'/050.gif" title="(z)">', $t );
		$t = str_replace( '(})', '<img class="icon_tchat" src="'.$cheminSmiley.'/051.gif" title="(})">', $t );
		$t = str_replace( '(^)', '<img class="icon_tchat" src="'.$cheminSmiley.'/052.gif" title="(^)">', $t );
		$t = str_replace( '(U)', '<img class="icon_tchat" src="'.$cheminSmiley.'/053.gif" title="(U)">', $t );
		$t = str_replace( '(u)', '<img class="icon_tchat" src="'.$cheminSmiley.'/053.gif" title="(u)">', $t );
		$t = str_replace( '(G)', '<img class="icon_tchat" src="'.$cheminSmiley.'/054.gif" title="(G)">', $t );
		$t = str_replace( '(g)', '<img class="icon_tchat" src="'.$cheminSmiley.'/054.gif" title="(g)">', $t );
		$t = str_replace( '(W)', '<img class="icon_tchat" src="'.$cheminSmiley.'/055.gif" title="(W)">', $t );
		$t = str_replace( '(w)', '<img class="icon_tchat" src="'.$cheminSmiley.'/055.gif" title="(w)">', $t );
		$t = str_replace( '(~)', '<img class="icon_tchat" src="'.$cheminSmiley.'/056.gif" title="(~)">', $t );
		$t = str_replace( '(&)', '<img class="icon_tchat" src="'.$cheminSmiley.'/057.gif" title="(&)">', $t );
		$t = str_replace( '(I)', '<img class="icon_tchat" src="'.$cheminSmiley.'/058.gif" title="(I)">', $t );
		$t = str_replace( '(i)', '<img class="icon_tchat" src="'.$cheminSmiley.'/058.gif" title="(i)">', $t );
		$t = str_replace( '(S)', '<img class="icon_tchat" src="'.$cheminSmiley.'/059.gif" title="(S)">', $t );
		$t = str_replace( '(E)', '<img class="icon_tchat" src="'.$cheminSmiley.'/060.gif" title="(E)">', $t );
		$t = str_replace( '(e)', '<img class="icon_tchat" src="'.$cheminSmiley.'/060.gif" title="(e)">', $t );
		$t = str_replace( '(M)', '<img class="icon_tchat" src="'.$cheminSmiley.'/061.gif" title="(M)">', $t );
		$t = str_replace( '(m)', '<img class="icon_tchat" src="'.$cheminSmiley.'/061.gif" title="(m)">', $t );
		$t = str_replace( '(bah)', '<img class="icon_tchat" src="'.$cheminSmiley.'/062.gif" title="(bah)">', $t );
		$t = str_replace( '(||)', '<img class="icon_tchat" src="'.$cheminSmiley.'/063.gif" title="(||)">', $t );
		$t = str_replace( '(so)', '<img class="icon_tchat" src="'.$cheminSmiley.'/064.gif" title="(so)">', $t );
		$t = str_replace( '(ap)', '<img class="icon_tchat" src="'.$cheminSmiley.'/065.gif" title="(ap)">', $t );
		$t = str_replace( '(ip)', '<img class="icon_tchat" src="'.$cheminSmiley.'/066.gif" title="(ip)">', $t );
		$t = str_replace( '(mp)', '<img class="icon_tchat" src="'.$cheminSmiley.'/067.gif" title="(mp)">', $t );
		$t = str_replace( '(li)', '<img class="icon_tchat" src="'.$cheminSmiley.'/068.gif" title="(li)">', $t );
		
		return self::autolink($t, array('target' => '_blank'));
	}
	
	private static function autolink( $str, $attributes = array() )
	{
		$attrs = '';
		
		foreach($attributes as $attribute => $value)
			$attrs .= ' '.$attribute.'="'.$value.'"';
	
		$str = preg_replace( '`(\s?)((http|https|ftp)://[^\s<]+[^\s<\.)])`i', '\\1<a href="\\2"'.$attrs.'>\\2</a>', $str );
		
		return $str;
	}
}
?>