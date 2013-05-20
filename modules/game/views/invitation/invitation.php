<?php defined('SYSPATH') or die('Access non autoris&eacute;.'); ?>

<h3>:: Formulaire d'invitation</h3>
<fb:request-form action="<?php echo $url; ?>" method="POST" invite="true" type="<?php echo Kohana::config( 'config.name_site' ); ?>" content="<?php echo $contenu; ?> <?php echo htmlentities('<fb:req-choice url="'.$url.'" label="Autoriser '.Kohana::config( 'config.name_site' ).'"') ?>">
  <fb:multi-friend-selector cols="<?php echo $cols; ?>" rows="<?php echo $rows; ?>" actiontext="<?php echo $titre; ?>" showborder="false" />
</fb:request-form>
test