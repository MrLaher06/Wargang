<?php defined('SYSPATH') OR die('No direct access allowed.'); ?>

<div class="conteneur_action">
<h2>:: Pénitensier de War City</h2>
<div class="conteneurProduit"> <img src="<?php echo url::base(); ?>images/batiments_option/prison.png" width="100" align="left" style="margin: 0 10px 10px 0" />
  <div>Vous trouverez ici la liste des gangsters qui ont été arrêté par les forces de police qui surveillent War City.</div>
  <div style="margin:10px 0 10px 0;"> <i class="jaune">Actuellement il y a <?php echo number_format($nbr_prisonniers); ?> gangster(s) enfermé(s)</i> </div>
</div>
<div class="spacer"></div>
<?php echo isset($prisonniers) ? $prisonniers : false; ?>
