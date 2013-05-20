<?php defined('SYSPATH') OR die('No direct access allowed.'); ?>
<div class="conteneur_action" style="margin-bottom:10px;">
<h2>:: Vous êtes en planque</h2>
Vous avez été planqué automatique car nous avons détecté aucune action de votre par depuis plus de 10 min.<br /> Veuillez vous re connecter pour continuer à jouer <a href="<?php	echo url::base(TRUE);	?>logout.html"><strong>via ce lien</strong></a>

<?php echo $login; ?>
</div>