<?php defined('SYSPATH') or die('No direct access allowed.'); ?>
<div class="closeOverlay">
<img onclick="fermer_carte()" src="<?php echo url::base(); ?>images/icon/close.png" width="30" height="30" alt="Fermer" />
</div>
<div id="Ccarte"><?php echo $tableau; ?></div>
<script language="javascript" type="text/javascript">
var refresh_carte = setInterval(function() { $('#Ccarte').load(url+'actualiser_carte.html');  }, 5000);
histo_txt ( 'ouverture de la carte' );
</script>