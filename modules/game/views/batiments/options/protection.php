<?php defined('SYSPATH') OR die('No direct access allowed.'); ?>
<div align="right" class="time_action"><?php echo html::aide(4); ?></div>
<div class="conteneur_action">
  <h2>:: Liste des protections disponibles dans ce b&acirc;timent</h2>
  <p> La liste se modifie selon la disponibilit&eacute; des protections, de l'argent que vous avez sur vous et du niveau que vous avez pour pouvoir vous procurer la protection.</p>
  <?php if( $liste_protection ) : ?>
  <?php foreach($liste_protection as $val ) : ?>
  <div class="conteneurProduit">
    <div class="conteneurVignette">
      <div class="infoVignette"><?php echo graphisme::barre_simple( $val->defense ); ?></div>
      <?php echo html::image('images/protections/'.$val->image_protection, array( 'width' => 60, 'height' => 60 ) ); ?> </div>
    <div class="conteneurTitreProduitDrogue"> <span class="titreProduitDrogue"><?php echo $val->name_protection; ?></span> <small class="orange">(lvl : <?php echo $val->niveau_protection; ?>)</small> <?php echo number_format( $val->prix_protection );?> $ </div>
    <p>En circulation : <?php echo $val->nb_utiliser ? $val->nb_utiliser : 0; ?>/<?php echo $val->quantite ? $val->quantite : 0; ?></p>
    <p><a href="javascript:;" id="desc_<?php echo $val->id; ?>" class="description_detail">Afficher la description</a></p>
    <p id="bloc_desc_<?php echo $val->id; ?>" style="display:none"><?php echo $val->commentaire_protection; ?></p>
    <div class="spacer"></div>
    <?php if( $val->nb_utiliser < $val->quantite && $niveau >= $val->niveau_protection ) : ?>
    <div class="button_action">
      <input type="button" value="Acheter" class="button acheter_protection" name="<?php echo $val->id; ?>" />
    </div>
    <?php endif ?>
    <div class="spacer"></div>
  </div>
  <?php endforeach ?>
  <?php endif ?>
</div>
