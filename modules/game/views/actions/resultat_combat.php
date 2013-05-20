<?php defined('SYSPATH') OR die('No direct access allowed.'); ?>
<div class="conteneur_action">
<?php if($type == 'batiment') : ?>
<h3>:: Victoire, vous venez de braquer un bâtiment !!!</h3>
<?php if(rand(0,1)) : ?>
<h3>Votre butin s'élève à la haute de <font size="+6" style="margin-left:10px;">xxxxx$</font></h3>
<div align="center"><img src="<?php echo url::base(); ?>images/combat/victoire_argent.png"/></div>
<?php else : ?>
<h3>Vous n'avez pas réussi à braquer ce bâtiment</h3>
<div align="center"><img src="<?php echo url::base(); ?>images/combat/defaite_argent.png"/></div>
<?php endif ?>
<?php endif ?>
</div>
