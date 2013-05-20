<?php defined('SYSPATH') or die('No direct access allowed.'); ?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="fr" lang="fr">
<head>
<title><?php echo html::specialchars( Kohana::config( 'config.name_site' ) ) ?></title>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>
<script>
var url = '<?php	echo url::base(TRUE);	?>';
</script>
<?php 
echo isset( $script ) ? $script : '';
echo isset( $css ) ? $css : '';
echo html::meta( array('generator' => 'OpenRPG', 'robots' => 'noindex, nofollow') );
?>
</head>
<body>
<?php echo isset( $menu ) ? $menu : ''; ?>
<div class="menu_right"><?php echo isset( $menu_right ) ? $menu_right : ''; ?></div>
<div class="spacer"></div>
<div class="conteneur_general">
  <?php if (isset( $titre ) ) :  ?>
  <h1>:: <?php echo $titre; ?></h1>
  <?php endif  ?>
  <?php if (isset( $button ) ) :  ?>
  <div class="button_valid"><?php echo $button; ?></div>
  <?php endif  ?>
  <div class="conteneur"><?php echo isset( $contenu ) ? $contenu : ''; ?></div>
</div>
<?php if( isset($debug) ) echo $debug; ?>
</body>
</html>