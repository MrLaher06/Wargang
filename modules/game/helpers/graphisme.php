<?php defined('SYSPATH') or die('No direct access allowed.');
class graphisme_Core 
{
	/**
	* Methode : affiche une barre graphique selon les valeurs
	*/
	public static function barre( $valeur = 0, $txt = false, $valeur_repl = false, $diviseur = 100 )
	{
		$valeur_repl = (!$valeur_repl) ? $valeur : $valeur_repl;
		return '<div class="ContenuChiffre">' .$txt.' '. $valeur_repl . '/'.$diviseur.'</div><div class="Cparent"><div class="Cenfant" style="width:' . round($valeur) . '%;"></div></div>';
	}

	/**
	* Methode : affiche une barre graphique réduite selon une valeur
	*/
	public static function barre_simple( $valeur = 0 )
	{
		return '<div class="Cparent_simple"><div class="Cenfant_simple" style="width:' . round($valeur) . '%;"></div></div>';
	}
}
?>
	