<?php defined('SYSPATH') OR die('No direct access allowed.'); ?>

<div class="conteneur_action">
  <h2>:: Bienvenue sur notre reseau d'autoroute</h2>
  <div class="conteneurProduit"> <img src="<?php echo url::base(); ?>images/batiments_option/autoroute.png" width="100" align="left" style="margin: 0 10px 10px 0" /> <i class="orange">Si vous souhaitez vous rendre à la sortie d'autoroute veuillez payer la somme de 100 $ pour l'utiliser.</i>
  
  <?php if( $passage ) : ?>
  <strong class="rouge">Tu n'as pas de véhicule pour traverser l'autoroute</strong>
  <?php endif ?>
    <select id="tunnel" class="inputbox" style="width:150px" >
			<?php if( $liste_tunnel ) : ?>
        <?php foreach( $liste_tunnel as $val ) : ?>
        <option value="<?php echo $val->id; ?>"><?php echo $val->nom; ?></option>
        <?php endforeach ?>
      <?php endif ?>
     </select>
  </div>
  <?php if( $passage ) : ?>
  <div align="right">
    <input type="button" id="prendre_tunnel" class="button" value="Traverser le tunnel pour 100 $" name="<?php echo $bat->id; ?>" />
  </div>
  <?php endif ?>
</div>
