<?php defined('SYSPATH') OR die('No direct access allowed.'); ?>
<img src="<?php echo url::base(); ?>images/combat/no_action.png" align="left" width="100" />
<p style="margin-top:10px;">Prenez le temps de vous occuper de vos drogues pour vous permettre de vous faire de l'argent.<br />
<?php echo html::aide(7); ?>&nbsp;&nbsp;<a href="javascript:;" id="gestion_drogue">Gestion de vos drogues</a></p>
<p>
Pensez aussi à regarder la carte pour voir si personne ne s'approche.
<?php if( $deplacement ) : ?>
<br />
<?php echo html::aide(9); ?>&nbsp;&nbsp;<a href="javascript:;" onclick="displayMessage('<?php	echo url::base(TRUE);	?>carte.html', 672, 550)">Vous pouvez vous d&eacute;placer</a></p>
<?php endif ?>
<div class="spacer"></div>