<?php defined('SYSPATH') OR die('No direct access allowed.'); ?>
<div class="conteneurProduit"> <img src="<?php echo url::base(); ?>images/bots/<?php echo $val->image; ?>" alt="Img" class="vignette" align="left" />
  <div class="conteneurTitreProduitDrogue"> <span class="titreProduitDrogue"><?php echo $val->nom; ?></span> </div>
  <p class="rouge">Attaque organisée par : <strong><?php echo $val->username; ?></strong></p>
  <p class="orange">Action sur la case : <strong><?php echo chr( $val->y+64 ); ?> - <?php echo $val->x; ?></strong></p>
  <p><?php echo $val->commentaire; ?></p>
  <p class="vert"> Liste des participants :
    <?php 
	if($liste_participant)
	{
		foreach($liste_participant as $v) 
			$liste[] = $v->username; 
		
		echo implode(', ', $liste); 
	}
	else
		echo 'Aucun participant';
	?>
  </p>
  <div class="button_action">
    <?php if( $possible ) : ?>
    <?php if( isset($participer) && $participer && $participer != $val->id_attaque && !isset($liste_participant[$participer]) && !$desactive ) : ?>
    <input type="button" name="<?php echo $val->id_combat; ?>" value="Participer à cette attaque" class="button participer_combat_bot" />
    <?php elseif( isset($participer) && $participer && $participer != $val->id_attaque && isset($liste_participant[$participer]) ) : ?>
    <input type="button" name="<?php echo $liste_participant[$participer]->id_combat_particpant; ?>" value="Annuler l'attaque" class="button annuler_combat" />
    <?php elseif( isset($participer) && $participer && $participer == $val->id_attaque ) : ?>
    <input type="button" name="<?php echo $val->id_combat; ?>" value="Lancer l'attaque" class="button lancer_combat_bot" />
    <input type="button" name="<?php echo $val->id_combat; ?>" value="Annuler l'attaque" class="button annuler_combat" />
    <?php endif ?>
    <?php else : ?>
    Vous êtes trop loin pour participer à cette action
    <?php endif ?>
  </div>
  <div class="spacer"></div>
</div>
