<?php defined('SYSPATH') OR die('No direct access allowed.'); ?>

<div class="conteneur_action" style="margin-bottom:10px;">
  <div align="right" class="time_action"><?php echo html::aide(16); ?></div>
  <h2>:: Café des sports</h2>
  <div>Dans ce bâtiment vous avez la possibilité de faire des paris sur des matchs de football. Ces paris sont ici pour le jeu et seulement pour le jeu.</div>
  <div>Si vous souhaitez <a href="javascript:;" id="voir_equipe_monde">voir toutes les équipe de football</a></div>
  <div>Vous avez aussi la possibilité de voir les archives des match qui se sont déroulés <a href="javascript:;" id="voir_archive_match">via ce lien</a></div>
  <div id="match_en_cours">
    <h2>:: Le Match en cours de jeu</h2>
    <p>Le match à commencé le <strong class="vert"><?php echo date::FormatDate ($match_en_cours->date); ?></strong> pour une durée de 30 min ce qui laisse encore <strong class="vert"><?php echo date::convertir_date ( ( 30 * 60 ) - ( time() - $match_en_cours->timer ) ); ?></strong> de jeu</p>
    <?php if( isset($match_en_cours) && $match_en_cours ) : ?>
    <table width="100%" border="0" cellspacing="3" cellpadding="3">
      <tr>
        <td align="center" valign="middle">
          <h3 class="bleu">Equipe à domicile</h3>
        </td>
        <td rowspan="3" align="center" valign="middle" style="font-size:24px;" class="jaune"><strong>Vs</strong></td>
        <td align="center" valign="middle">
          <h3 class="bleu">Equipe visiteur</h3>
        </td>
      </tr>
      <tr align="center" valign="middle">
        <td><img src="<?php echo url::base(); ?>images/football/<?php echo $equipe_domicile->image ? $equipe_domicile->image : 'frlarge.gif'; ?>" height="80"/></td>
        <td><img src="<?php echo url::base(); ?>images/football/<?php echo $equipe_visiteur->image ? $equipe_visiteur->image : 'frlarge.gif'; ?>" height="80"/></td>
      </tr>
      <tr align="center" valign="middle">
        <td><?php echo $equipe_domicile->name; ?></td>
        <td><?php echo $equipe_visiteur->name; ?></td>
      </tr>
      <tr align="center" valign="middle">
        <td>
            <input type="text" name="paris_equipe_domicile" id="paris_equipe_domicile" class="inputbox" />
        </td>
        <td align="center" valign="middle"><input type="button" id="lancer_paris" value="parier sur le match" class="button" /></td>
        <td><input type="text" name="paris_equipe_visiteur" id="paris_equipe_visiteur" class="inputbox" /></td>
      </tr>
    </table>
    <?php else : ?>
    Il n'y a aucun match pour le moment.
    <?php endif ?>
  </div>
  <div id="liste_equipe_monde" style="display:none">
    <h2>:: Liste de toutes les équipes</h2>
    <?php if( isset($equipes) && $equipes ) : ?>
    <?php foreach( $equipes as $val ) : ?>
    <div style="float:left; width:33%;">
      <div style="border:1px solid #888; background-color:#444; padding:5px; margin:5px; cursor:pointer;" align="center"> <a href="javascript:;" class="equipe_foot" id="<?php echo $val->id; ?>" style="color:#FFF;"><?php echo text::limit_chars( $val->name, 28, '...', false) ?></a> </div>
    </div>
    <?php endforeach ?>
    <?php endif ?>
    <div class="spacer"></div>
  </div>
</div>
