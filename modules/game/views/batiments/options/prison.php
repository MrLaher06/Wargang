<?php defined('SYSPATH') OR die('No direct access allowed.'); ?>
<div class="conteneur_action" style="margin-bottom:10px;">
<h2>:: Vous êtes en prison</h2>
Tu es en prison, il te reste encore <?php echo $delai; ?> min à tirer.
</div>
<?php echo isset($prisonniers) ? $prisonniers : false; ?>