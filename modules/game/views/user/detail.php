<?php defined('SYSPATH') or die('No direct access allowed.'); ?>
<div class="closeOverlay"> <img onclick="closeMessage()" src="<?php echo url::base(); ?>images/icon/close.png" width="30" height="30" alt="Fermer" /> </div>
<?php
$sexe = Kohana::config( 'users.sexe' );
$humeur = Kohana::config( 'users.humeur' );
$comportement = Kohana::config( 'users.comportement' );
$connaissance = Kohana::config( 'users.connaissance' );
?>
<h2>Informations sur le gangster</h2>
<table width="100%" border="0" cellpadding="5" cellspacing="5">
  <tr>
    <td valign="top"><strong class="orange">Commentaire : </strong></td>
    <td align="right" valign="top"><?php echo $info->commentaire ? $info->commentaire : 'Aucun commentaire pour le moment'; ?></td>
  </tr>
  <tr>
    <td valign="top"><strong class="orange">Sexe : </strong></td>
    <td align="right" valign="top"><?php echo $sexe[$info->sexe]; ?></td>
  </tr>
  <tr>
    <td valign="top"><strong class="orange">Age : </strong></td>
    <td align="right" valign="top"><?php echo $info->age; ?> ans</td>
  </tr>
  <tr>
    <td valign="top"><strong class="orange">Humeur : </strong></td>
    <td align="right" valign="top"><?php echo $humeur[$info->humeur]; ?></td>
  </tr>
  <tr>
    <td valign="top"><strong class="orange">Comportement : </strong></td>
    <td align="right" valign="top"><?php echo $comportement[$info->comportement]; ?></td>
  </tr>
  <tr>
    <td valign="top"><strong class="orange">Niveau de jeu : </strong></td>
    <td align="right" valign="top"><?php echo $connaissance[$info->connaissance]; ?></td>
  </tr>
</table>
