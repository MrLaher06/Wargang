<?php defined('SYSPATH') OR die('No direct access allowed.'); ?>
<div class="conteneurProduit">
  <div class="conteneurVignette" <?php if($val->couleur_gang) echo 'style="background-color:'.$val->couleur_gang.'"'; ?>>
    <div class="infoVignette"><?php echo graphisme::barre_simple( $val->protection * 100 / $val->protection_max );?></div>
    <?php echo html::image('images/batiments/'.$val->image, array( 'width' => 60, 'height' => 60 ) ); ?> </div>
    
  <div class="conteneurTitreProduitDrogue"> <span class="titreProduitDrogue"><?php echo $val->nom; ?> :</span> <?php echo number_format( $val->prix_achat );?> $</div>
  <p class="orange">Action sur la case : <strong><?php echo chr( $val->y+64 ); ?> - <?php echo $val->x; ?></strong></p>
  <?php
	$class_proprio = ( isset($id_user) && $id_user == $val->id_user ) ? 'vert' : 'rouge';
	if($val->id_user)
		echo '<span class="rouge">Ce b&acirc;timent a un propri&eacute;taire connu sous le pseudo de : <b class="'.$class_proprio.'"><span class="name_tchat">'.$val->proprio.'</span></b></span>';
	else
		echo '<span class="vert">Aucun propri&eacute;taire pour ce b&acirc;timent</span>'; 
	?>
  <p class="vert">
  Liste des participants : 
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
    <input type="button" name="<?php echo $val->id_combat; ?>" value="Participer à ce braquage" class="button participer_combat_batiment" />
  <?php elseif( isset($participer) && $participer && $participer != $val->id_attaque && isset($liste_participant[$participer]) ) : ?>
    <input type="button" name="<?php echo $liste_participant[$participer]->id_combat_particpant; ?>" value="Annuler le braquage" class="button annuler_combat" />
  <?php elseif( isset($participer) && $participer && $participer == $val->id_attaque ) : ?>
    <input type="button" name="<?php echo $val->id_combat; ?>" value="Lancer le braquage" class="button lancer_combat_batiment" />
    <input type="button" name="<?php echo $val->id_combat; ?>" value="Annuler le braquage" class="button annuler_combat" />
  <?php endif ?>
  <?php else : ?>
  Vous êtes trop loin pour participer à cette action
  <?php endif ?>
  </div>
  <div class="spacer"></div>
</div>
