<?php defined('SYSPATH') OR die('No direct access allowed.'); ?>
<div class="conteneurProduit"> <img src="<?php echo url::base(); ?>images/bots/<?php echo $val->image; ?>" alt="Img" class="vignette" align="left" />
  <?php if($val->id_vehicule) : ?>
  <div class="conteneurVignette">
    <div class="infoVignette"><?php echo graphisme::barre_simple( $val->etat_vehicule ); ?></div>
    <?php echo html::image('images/voitures/'.$val->image_vehicule, array( 'width' => 60, 'height' => 60 ) ); ?> </div>
  <?php endif ?>
  <div class="conteneurTitreProduitDrogue"> <span class="titreProduitDrogue"><?php echo $val->nom; ?></span> </div>
  <p>
    <?php if(!$val->deal) : ?>
    <b class="rouge">Ce n'est pas un dealer</b>
    <?php else : ?>
    <b class="vert">C'est un dealer</b>
    <?php endif ?>
  </p>
  <p>
    <?php if(!$val->id_vehicule) : ?>
    <b class="rouge">Il n'est pas en voiture.</b>
    <?php else : ?>
    <b class="vert">Il est en <?php  echo $val->name_vehicule; ?> qui vaut environs
    <?php  echo number_format($val->prix_vehicule); ?> $. (lvl <?php  echo number_format($val->niveau_vehicule); ?> )</b>
    <?php endif ?>
  </p>
  <p><?php echo $val->commentaire; ?></p>
  <?php if( !$desactive ) : ?>
  <div class="button_action">
    <?php if($val->id_combat && !$en_combat ) : ?>
    <input type="button" name="<?php echo $val->id_combat; ?>" value="Lancer l'attaque" class="button lancer_combat_bot" />
    <input type="button" name="<?php echo $val->id_combat; ?>" value="Annuler l'attaque" class="button annuler_combat" />
    <?php elseif( !$en_combat ) : ?>
    <input type="button" name="<?php echo $val->id; ?>" value="Pr&eacute;parer une attaque" class="button prepare_combat_bot" />
    <?php elseif( $en_combat ) : ?>
    <div class="rouge">Vous êtes en combat</div>
    <?php endif ?>
  </div>
	<?php endif ?>
  <div class="spacer"></div>
</div>