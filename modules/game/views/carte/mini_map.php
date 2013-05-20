<?php defined('SYSPATH') or die('No direct access allowed.'); ?>
<table cellspacing="0" cellpadding="0" align="center">
  <tr>
    <td class="td_letter"></td>
    <?php for( $x = 1; $x <= Kohana::config( 'carte.taille_carte' ); $x++ ) : ?>
    <td align="center" valign="middle" class="td_letter" style="padding-bottom:5px;"><?php echo $x > 0 && $x < Kohana::config( 'carte.taille_carte' )+1 ? $x : false; ?></td>
    <?php endfor ?>
  </tr>
  <?php for( $y = 1; $y <= Kohana::config( 'carte.taille_carte' ); $y++ ) : ?>
  <td align="center" valign="middle" class="td_letter" style="padding-right:5px;"><?php echo $y > 0 && $y <= Kohana::config( 'carte.taille_carte' )+1 ? chr( $y+64 ) : false; ?></td>
    <?php for( $x = 1; $x <= Kohana::config( 'carte.taille_carte' ); $x++ ) : ?>
    <td width="15" height="15" class="no_passage" <?php echo isset( $data[$x.'-'.$y] ) ? 'style="background-color:#33CC33;"' : ''; ?>></td>
    <?php endfor ?>
  </tr>
  <?php endfor ?>
</table>