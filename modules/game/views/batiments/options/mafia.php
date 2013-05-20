<?php defined('SYSPATH') OR die('No direct access allowed.'); ?>

<div class="conteneur_action">
<h2>:: Mafia qui donne les ordres sur War City</h2>
<div class="conteneurProduit"> <img src="<?php echo url::base(); ?>images/batiments_option/mission.png" width="100" align="left" style="margin: 0 10px 10px 0" /> <i class="orange">A l'heure actuel, vous avez <?php echo number_format($mission_en_cour); ?> missions en cours sur les <?php echo number_format($mission_total); ?> effectuée(s).</i>
  <div class="jaune"> ( gangster(s) : <?php echo number_format($mission_user); ?> - Habitant(s) : <?php echo number_format($mission_bot); ?> - Braquage(s) : <?php echo number_format($mission_batiment); ?> - Véhicule(s) : <?php echo number_format($mission_vehicule); ?> )</div>
  <p style="margin-top:10px;">
  <?php if( $liste_en_cours ) : ?>
  <h3>:: Liste des mission en cours <small>&nbsp;&nbsp;<a href="javascript:;" class="orange" onclick="displayMessage('mission.html', 340, 250)" title="Détail">Voir le détail</a></small></h3>
  <?php foreach( $liste_en_cours as $val ) : ?>
  <div style="margin-top:5px;" ><?php echo $val; ?></div>
  <?php endforeach ?>
  <?php endif ?>
  </p>
  <?php if( $gang ) : ?>
  <div align="right" style="padding-right:5px; margin-top:10px;">
    <?php if( $mission_en_cour < 3 ) : ?>
    <input type="button" id="mission_use_demander" class="button" value="Je souhaite demander une mission" name="<?php echo $bat->id; ?>" />
    <?php endif ?>
    <?php if( $mission_en_cour ) : ?>
    <input type="button" id="mission_user_valide" class="button" value="Je souhaite valider mes missions" name="<?php echo $bat->id; ?>" />
    <?php endif ?>
  </div>
  <?php endif ?>
</div>
