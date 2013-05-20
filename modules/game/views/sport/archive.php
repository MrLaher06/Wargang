<?php defined('SYSPATH') OR die('No direct access allowed.'); ?>

<div class="conteneur_action">
  <div align="right" class="time_action"><a href="javascript:;" id="visite_batiment" >Revenir dans le bar</a>&nbsp;&nbsp;<?php echo html::aide(16); ?></div>
  <h2>:: Archives de la journée des matchs</h2>
  <p style="margin-bottom:10px;">Liste de tous les matchs qui ont eu lieu dans la journée.</p>
  <table border="0" align="center" cellpadding="5" cellspacing="5">
  <?php if( isset($equipe) && $equipe ) : ?>
  <?php foreach( $equipe as $val ) : ?>
  <tr title="<?php echo date::FormatDate ($val->date) ; ?>">
    <td align="center" width="200"><a href="javascript:;" class="equipe_foot" id="<?php echo $val->equipe_domicile; ?>" style="color:#FFF;"><?php echo $val->equipe_domicile_name ; ?></a></td>
    <td align="center"><?php echo $val->but_domicile ; ?> - <?php echo $val->but_visiteur ; ?></td>
    <td align="center" width="200"><a href="javascript:;" class="equipe_foot" id="<?php echo $val->equipe_visiteur; ?>" style="color:#FFF;"><?php echo $val->equipe_visiteur_name ; ?></a></td>
  </tr>
  <?php endforeach ?>
  <?php endif ?>
</table>
</div>
