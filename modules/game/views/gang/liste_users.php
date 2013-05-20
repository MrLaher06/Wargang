<?php defined('SYSPATH') OR die('No direct access allowed.'); ?>
<div class="conteneurProduit">
  <div class="conteneurVignette" <?php if($val->couleur_gang) echo 'style="background-color:'.$val->couleur_gang.'"'; ?>> <?php echo html::image('images/avatars/'.$val->avatar, array( 'width' => 60, 'height' => 60 ) ); ?> </div>

  <div class="conteneurTitreProduitDrogue"> <span class="titreProduitDrogue"><span class="name_tchat"><?php echo $val->username; ?></span> <small>(lvl <?php echo number_format( $val->niveau );?>)</small></span></div>
  <p class="orange">Action sur la case : <strong><?php echo chr( $val->y+64 ); ?> - <?php echo $val->x; ?></strong></p>
  <p>
    <?php 
	if(!$val->id_gang)
		echo '<b class="rouge">Il ne fait pas parti d\'un gang.</b>';
	else
	{
		echo '<img src="<?php echo url::base(); ?>images/gang/'.$val->image_gang.'" class="vignette30" style="margin-right:5px;" align="left" /> ';
		echo '<b style="color:'.$val->couleur_gang.'">Il fait parti du gang : '.$val->nom_gang.'</b>'; 
		echo '<p style="margin-bottom:10px;">'.text::limit_chars(strip_tags($val->commentaire_gang), 150, '...', true).'</p>'; 
	}
	?>
  </p>
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
    <input type="button" name="<?php echo $val->id_combat; ?>" value="Participer à cette attaque" class="button participer_combat_user" />
  <?php elseif( isset($participer) && $participer && $participer != $val->id_attaque && isset($liste_participant[$participer]) ) : ?>
    <input type="button" name="<?php echo $liste_participant[$participer]->id_combat_particpant; ?>" value="Annuler l'attaque" class="button annuler_combat" />
  <?php elseif( isset($participer) && $participer && $participer == $val->id_attaque ) : ?>
    <input type="button" name="<?php echo $val->id_combat; ?>" value="Lancer l'attaque" class="button lancer_combat_user" />
    <input type="button" name="<?php echo $val->id_combat; ?>" value="Annuler l'attaque" class="button annuler_combat" />
  <?php endif ?>
  <?php else : ?>
  Vous êtes trop loin pour participer à cette action
  <?php endif ?>
  </div>
  <div class="spacer"></div>
</div>