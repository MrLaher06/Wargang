<?php defined('SYSPATH') OR die('No direct access allowed.'); ?>
<div class="conteneur_action">
  <h2>:: Commissariat</h2>
  <div class="conteneurProduit"> <img src="<?php echo url::base(); ?>images/batiments_option/police.png" width="100" align="left" style="margin: 0 10px 10px 0" /> <i class="orange">A l'heure actuel, il y a <?php echo $nbr_flic_actuel; ?> policier(s) en jeu et il reste <span class="<?php echo $nbr_flic_actuel < $nbr_total_flic_possible ? 'vert' : 'rouge'; ?>"><?php echo $nbr_total_flic_possible - $nbr_flic_actuel; ?> place(s)</span> sur <?php echo $nbr_total_flic_possible; ?> à postuler.</i>
    <p style="margin-top:10px;">Liste des policier déjà présent sur le jeu : <?php echo $liste_flic; ?></p>
    <?php if( $user->recherche) : ?>
    <strong class="rouge"><blink>Vous ne pouvez pas postuler car vous êtes recherché!</blink></strong>
    <?php endif ?>
  </div>
  <?php if( !$user->recherche && $user->id_gang != 1 && $nbr_flic_actuel < $nbr_total_flic_possible ) : ?>
  <div align="right" style="padding-right:5px;">
    <input type="button" id="commissariat" class="button" value="Postuler au poste de policier" name="<?php echo $bat->id; ?>" />
  </div>
  <?php elseif( $user->id_gang == 1) : ?>
  <div align="right" style="padding-right:5px;">
    <input type="button" id="demissionner_commissariat" class="button" value="Démissionner du poste de policier ( moins 5 niveaux )" name="<?php echo $bat->id; ?>" />
  </div>
  <?php endif ?>
</div>
