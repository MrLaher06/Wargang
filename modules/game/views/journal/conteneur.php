<?php defined('SYSPATH') OR die('No direct access allowed.'); ?>

<div class="conteneur_action journal">
  <?php if( !isset($home) || $home === false ) : ?>
  <div align="right" class="time_action"><a href="javascript:;" onclick="displayMessage('<?php	echo url::base(TRUE);	?>journal/proposer.html', 800, 350)">Proposer un article</a> - <a href="javascript:;" onclick="paneSplitter.reloadContent('journal');return false;" >Recharger cette page</a>&nbsp;&nbsp;<?php echo html::aide(5); ?></div>
  <h2>:: Journal local de War gang</h2>
  <?php else : ?>
  <h1>:: Journal local de War gang</h1>
  <?php endif ?>
  <?php if( isset($resultat) && $resultat ) : ?>
  <?php foreach( $resultat as $val ) : ?>
  <?php $date = explode(' ',$val['value']->date); ?>
  <div class="article">
    <div class="titre_article"><?php echo $val['value']->titre; ?></div>
    <div class="date_article jaune">Ecrit le : <?php echo date::FormatDate( $val['value']->date ); ?></div>
    <img src="<?php echo url::base(); ?>images/<?php echo $val['value']->image; ?>" alt="vignette" class="vignette" align="left" /> <?php echo $val['text']; ?>
    <?php if( !isset($home) || $home === false ) : ?>
    <div align="right">
      <?php if( $val['value']->youtube ) : ?>
      <a href="javascript:;" onclick="displayMessage('<?php	echo url::base(TRUE);	?>journal/youtube/<?php echo $val['value']->youtube; ?>.html', 425, 344)" title="Voir la vidéo sur You Tube"><img src="<?php echo url::base(); ?>images/journal/youtube.png" width="16" height="16" /></a>&nbsp;
    <?php endif ?>
    <?php if( $val['value']->dailymotion ) : ?>
    <a href="javascript:;" onclick="displayMessage('<?php	echo url::base(TRUE);	?>journal/dailymotion/<?php echo $val['value']->dailymotion; ?>.html', 480, 291)" title="Voir la vidéo sur Dailymotion"><img src="<?php echo url::base(); ?>images/journal/dailymotion.png" width="16" height="16" /></a>&nbsp;
    <?php endif ?>
    <?php endif ?>
    <a href="http://www.facebook.com/share.php?u=<?php	echo url::base(TRUE);	?>archives/detail/<?php echo url::title( utf8::transliterate_to_ascii($date[0])).'/'.url::title( utf8::transliterate_to_ascii($val['value']->titre)).'/'.$val['value']->id; ?>.html" onclick="window.open(this.href, 'FaceBook', 'height=400, width=500, toolbar=no, menubar=no, location=no, resizable=no, scrollbars=no, status=no'); return false;" title="Partager sur facebook"><img src="<?php echo url::base(); ?>images/journal/facebook.png" width="16" height="16" /></a></div>
</div>
<?php echo '<div class="spacer separator"></div>'; ?>
<?php endforeach ?>
<?php endif ?>
</div>
<?php if( !isset($home) || $home === false ) : ?>
<div class="close_windows"><a target="_blank" href="<?php	echo url::base(TRUE);	?>archives/page/1.html">Archives</a> - <a href="javascript:;" onclick="displayMessage('<?php	echo url::base(TRUE);	?>journal/proposer.html', 800, 350)">Proposer un article</a> - <a href="javascript:;" onclick="paneSplitter.reloadContent('journal');return false;" >Recharger cette page</a> - <a href="javascript:;" onclick="paneSplitter.deleteContentById('journal');return false;" >Fermer cette page</a></div>
<?php else : ?>
<div align="right" style="padding:10px;"><a target="_top" href="<?php	echo url::base(TRUE);	?>archives/page/1.html">Archives de tous les articles du journal édités sur War gang</a></div>
<?php endif ?>
