<?php defined('SYSPATH') OR die('No direct access allowed.'); ?>
<div align="right" class="time_action">
  <?php if( $recharge ) : ?>
  <input type="button" value="Faire le plein : <?php echo number_format( round( $niveau * 100 ) + 10 ); ?> $" id="recharge_vehicule" class="button" />
  &nbsp;&nbsp;
  <?php endif ?>
  <?php echo html::aide(2); ?> </div>
<div class="conteneur_action">
  <h2>:: Liste de v&eacute;hicule disponible dans ce b&acirc;timent</h2>
  <p> La liste se modifie selon la disponibilit&eacute; des v&eacute;hicules, de l'argent que vous avez sur vous et du niveau que vous avez pour pouvoir vous procurer le v&eacute;hicule.</p>
  <?php if( $liste_vehicule ) : ?>
  <?php foreach($liste_vehicule as $val ) : ?>
  <?php if( ( $flic && $val->police  ) || ( !$flic && !$val->police ) ) : ?>
  <div class="conteneurProduit">
    <div class="conteneurVignette">
      <div class="infoVignette"><?php echo graphisme::barre_simple( $val->etat_vehicule ); ?></div>
      <?php echo html::image('images/voitures/'.$val->image_vehicule, array( 'width' => 60, 'height' => 60 ) ); ?> </div>
    <div class="conteneurTitreProduitDrogue"> <span class="titreProduitDrogue"><?php echo $val->name_vehicule; ?></span> <small class="orange">(lvl : <?php echo $val->niveau_vehicule; ?>)</small> <?php echo number_format( $val->prix_vehicule );?> $ </div>
    <p>En circulation : <?php echo ($val->nb_utiliser + $val->nb_parking) ? $val->nb_utiliser + $val->nb_parking : 0; ?>/<?php echo $val->quantite ? $val->quantite : 0; ?> <?php echo $val->nb_parking ? '<em class="bleu">dont '.$val->nb_parking.' dans les parkings</em>' : false; ?></p>
    <p>R&eacute;servoir : <?php echo $val->reservoir; ?> L</p>
    <p>D&eacute;placement en <?php echo $val->deplacement; ?> s</p>
    <p><a href="javascript:;" id="desc_<?php echo $val->id; ?>" class="description_detail">Afficher la description</a></p>
    <div class="spacer"></div>
    <p id="bloc_desc_<?php echo $val->id; ?>" style="display:none"><?php echo $val->commentaire_vehicule; ?></p>
    <?php if( ($val->nb_utiliser + $val->nb_parking) < $val->quantite && $niveau >= $val->niveau_vehicule ) : ?>
    <div class="button_action">
      <input type="button" value="Acheter" class="button acheter_vehicule" name="<?php echo $val->id; ?>" />
    </div>
    <?php endif ?>
    <div class="spacer"></div>
  </div>
  <?php endif ?>
  <?php endforeach ?>
  <?php endif ?>
</div>
