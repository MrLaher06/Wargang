<?php defined('SYSPATH') or die('No direct access allowed.'); ?>
<div class="closeOverlay"> <img onclick="closeMessage()" src="<?php echo url::base(); ?>images/icon/close.png" width="30" height="30" alt="Fermer" /> </div>
<object style="height: 344px; width: 425px">
  <param name="movie" value="http://www.youtube.com/v/<?php echo $id; ?>?version=3&color1=0xb1b1b1&color2=0xcfcfcf&feature=player_embedded">
  <param name="allowFullScreen" value="true">
  <param name="allowScriptAccess" value="always">
  <embed src="http://www.youtube.com/v/<?php echo $id; ?>?version=3&color1=0xb1b1b1&color2=0xcfcfcf&feature=player_embedded" type="application/x-shockwave-flash" allowfullscreen="true" allowScriptAccess="always" width="425" height="344">
</object>
