<?php defined('SYSPATH') OR die('No direct access allowed.'); ?>
<div class="conteneurProduit">
  <div class="conteneurVignette" <?php if($val->couleur_gang) echo 'style="background-color:'.$val->couleur_gang.'"'; ?>>
    <div class="infoVignette"><?php echo graphisme::barre_simple( $val->protection * 100 / $val->protection_max );?></div>
    <?php echo html::image('images/batiments/'.$val->image, array( 'width' => 60, 'height' => 60 ) ); ?> </div>
    
  <div class="conteneurTitreProduitDrogue"> <span class="titreProduitDrogue"><?php echo $val->nom; ?> :</span> <?php echo number_format( $val->prix_achat );?> $</div>
  <div class="jaune">Il doit avoir une protection de <?php echo round($val->protection * 100 / $val->protection_max); ?>% comparé au bâtiment le mieux protégé (<?php echo round($val->protection_max); ?> pts)</div>
	<?php
	$class_proprio = ( isset($id_user) && $id_user == $val->id_user ) ? 'vert' : 'rouge';
	if($val->id_user 
		&& $val->type_option != 'mafia' 
		&& $val->type_option != 'arme' 
		&& $val->type_option != 'vehicule')
		echo '<span class="rouge">Ce b&acirc;timent a un propri&eacute;taire connu sous le pseudo de : <b class="'.$class_proprio.'"><span class="name_tchat">'.$val->proprio.'</span></b></span>';
	else
		echo '<span class="vert">Aucun propri&eacute;taire pour ce b&acirc;timent</span>'; 
	?>
  <p><?php echo $val->commentaire; ?></p>
 <?php if( !isset($no_button) ) : ?>
  <div class="button_action">
  <?php if( $val->timer > time() - 3600 ) : ?>
  <div class="orange">Le bâtiment est en travaux.<br />Il ouvrira dans <strong><?php echo date::convertir_date( 3600 - ( time() - $val->timer ) ); ?></strong></div>
  <?php elseif($val->id_combat && !$en_combat ) : ?>
  <input type="button" name="<?php echo $val->id_combat; ?>" value="Lancer le braquage" class="button lancer_combat_batiment" />
  <input type="button" name="<?php echo $val->id_combat; ?>" value="Annuler le braquage" class="button annuler_combat" />
  <?php elseif( !$en_combat ) : ?>
		<?php if( $val->timer < time() - 3600 && $val->type_option != 'mafia' && !$flic ) : ?>
    <input type="button" name="<?php echo $val->id; ?>" value="Pr&eacute;parer le braquage" class="button prepare_combat_batiment" />
    <?php endif ?>
    <?php if( ( ( isset($id_user) && $id_user != $val->id_user ) || !isset($id_user) ) 
							&& !$flic 
							&& $val->type_option != 'mafia' 
							&& $val->type_option != 'arme' 
							&& $val->type_option != 'vehicule' ) : ?>
    <input type="button" value="Acheter" id="acheter_batiment" class="button" />
    <?php endif ?>
    <input type="button" value="Visiter" id="visite_batiment" class="button" />
  <?php endif ?>
  </div>
  <?php endif ?>
  <div class="spacer"></div>
</div>
