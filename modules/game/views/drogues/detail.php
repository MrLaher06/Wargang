<?php defined('SYSPATH') or die('No direct access allowed.'); ?>
<div class="closeOverlay"> <img onclick="closeMessage()" src="<?php echo url::base(); ?>images/icon/close.png" width="30" height="30" alt="Fermer" /> </div>
<?php 
if(!$val->autoriser)
	echo '<h3 class="jaune">Ce produit est interdit par la loi fran&ccedil;aise</h3>';
else
	echo '<h3 class="vert">Ce produit n\'est pas interdit par la loi fran&ccedil;aise</h3>'; 
?>
<div align="justify" style="padding:5px; color:#FFF; height:170px; overflow:auto;"><?php echo $val->description; ?></div>
