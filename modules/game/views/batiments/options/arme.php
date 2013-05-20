<?php defined('SYSPATH') OR die('No direct access allowed.'); ?>

<div align="right" class="time_action">
  <?php if( $recharge ) : ?>
  <input type="button" value="Recharger votre arme : <?php echo number_format($recharge->prix_munition); ?>$" id="recharge_arme" class="button" />
  &nbsp;&nbsp;
  <?php endif ?>
  <?php echo html::aide(11); ?> </div>
<div class="conteneur_action">
  <h2>:: Liste des armes disponible</h2>
  <p> La liste se modifie selon la disponibilit&eacute; des armes, de l'argent que vous avez sur vous et du niveau que vous avez pour pouvoir vous procurer l'arme.</p>
  <?php if( $liste_arme ) : ?>
  <?php foreach($liste_arme as $val ) : ?>
  <div class="conteneurProduit">
    <div class="conteneurVignette">
      <div class="infoVignette"><?php echo graphisme::barre_simple( $val->attaque ); ?></div>
      <?php echo html::image('images/armes/'.$val->image_arme, array( 'width' => 60, 'height' => 60 ) ); ?> </div>
    <div class="conteneurTitreProduitDrogue"> <span class="titreProduitDrogue"><?php echo $val->name_arme; ?></span> <small class="orange">(lvl : <?php echo $val->niveau_arme; ?>)</small> <?php echo number_format( $val->prix_arme );?> $ </div>
    <p>En circulation : <?php echo $val->nb_utiliser ? $val->nb_utiliser : 0; ?>/<?php echo $val->quantite ? $val->quantite : 0; ?></p>
    <p>Pr&eacute;cision : <?php echo $val->precision; ?></p>
    <p>Munition(s) : <?php echo $val->munition_arme; ?></p>
    <p><a href="javascript:;" id="desc_<?php echo $val->id; ?>" class="description_detail">Afficher la description</a></p>
    <div class="spacer"></div>
    <p id="bloc_desc_<?php echo $val->id; ?>" style="display:none"><?php echo $val->commentaire_arme; ?></p>
    <?php if( $val->nb_utiliser < $val->quantite && $niveau >= $val->niveau_arme ) : ?>
    <div class="button_action">
      <input type="button" value="Acheter" class="button acheter_arme" name="<?php echo $val->id; ?>" />
    </div>
    <?php endif ?>
    <div class="spacer"></div>
  </div>
  <?php endforeach ?>
  <?php endif ?>
</div>
