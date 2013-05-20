<?php defined('SYSPATH') or die('No direct access allowed.'); ?>

<div class="closeOverlay"> <img onclick="closeMessage()" src="<?php echo url::base(); ?>images/icon/close.png" width="30" height="30" alt="Fermer" /> </div>
<object width="480" height="291">
  <param name="movie" value="http://www.dailymotion.com/swf/<?php echo $id; ?>">
  </param>
  <param name="allowFullScreen" value="true">
  </param>
  <param name="allowScriptAccess" value="always">
  </param>
  <embed type="application/x-shockwave-flash" src="http://www.dailymotion.com/swf/<?php echo $id; ?>" width="480" height="291" allowfullscreen="true" allowscriptaccess="always"></embed>
</object>