<?php defined('SYSPATH') OR die('No direct access allowed.'); ?>
<?php if( isset($alert) && $alert !== false ) : ?>
<div class="closeOverlay"> <img onclick="closeMessage()" src="<?php echo url::base(); ?>images/icon/close.png" width="30" height="30" alt="Fermer" /> </div>
<?php endif ?>
<div class="conteneur_action" <?php echo isset($alert) && $alert !== false ? 'style="height:290px; overflow:auto; padding:5px; background-color:#222; color:#fff;"' : false; ?> >
  <h2>:: <?php echo $content->titre; ?></h2>
  <img src="<?php echo url::base(); ?>images/aide/<?php echo $content->image; ?>" width="60" align="left" style="margin: 0 10px 10px 0;" />
  <div class="jaune" style="margin-bottom:5px;"><i>Modifier le : <?php echo date::FormatDate( $content->date.' 00:00:00', '%d %B %Y' ); ?></i> </div>
  <div align="justify"><?php echo $content->texte; ?></div>
  <div class="spacer"></div>
</div>
<?php if( !isset($alert) || $alert === false ) : ?>
<div class="close_windows"><a href="javascript:;" onclick="paneSplitter.loadContent('regles','<?php	echo url::base(TRUE);	?>aide.html');" >Revenir au sommaire</a> - <a href="javascript:;" onclick="paneSplitter.deleteContentById('regles');" >Fermer cette page</a></div>
<?php endif ?>