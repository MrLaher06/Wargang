<?php defined('SYSPATH') OR die('No direct access allowed.'); ?>

<div class="conteneur_action">
  <div align="right" class="time_action">Il y a <strong><?php echo number_format($nbr_actions); ?></strong> possibilité(s) pour le gang. (<?php echo date('H:i:s'); ?>)&nbsp;&nbsp;<?php echo html::aide(6); ?></div>
  <h2>:: Action(s) du gang possible(s)</h2>
  <?php if( isset( $bots ) && $bots ) : ?>
  <?php echo $bots; ?>
  <?php endif ?>
  <?php if( isset( $users ) && $users ) : ?>
  <?php echo $users; ?>
  <?php endif ?>
  <?php if( isset( $batiments ) && $batiments ) : ?>
  <?php echo $batiments; ?>
  <?php endif ?>
  <?php if( !isset( $nbr_actions ) || !$nbr_actions ) : ?>
  <h3>:: Aucune action pour le moment</h3>
  <p style="margin-bottom:5px;">
     Pensez aussi à regarder la carte pour voir si personne ne s'approche. 
    <?php if( isset( $crea_gang ) && $crea_gang ) : ?>
    <br />
    Vous pouvez créer votre propre gang car votre niveau vous le permet. Cela vous coûtera <strong class="orange"><?php echo number_format(Kohana::config( 'gang.argent_crea' )); ?> $</strong>
    <div style="padding:5px 10px 10px 10px;" align="center">
    <input type="button" onclick="displayMessage('<?php	echo url::base(TRUE);	?>gang/creation.html', 330, 420)" value="Créer votre propre gang" class="button" />
    </div>
    <?php endif ?>
  </p>
  <?php endif ?>
  <div class="spacer"></div>
  <?php if( isset( $boss_gang ) && $boss_gang ) : ?>
  <h3 class="vert">:: Tu es le boss du <span class="name_tchat">gang</span></h3>
  <?php 
	$en_cours = array();
	if( isset($list_invite_en_cours) && $list_invite_en_cours )
		foreach( $list_invite_en_cours as $v )
			$en_cours[$v->id_user] = true;
	?>
  
  <?php if( isset($list_invite) && $list_invite && count($en_cours) != $list_invite->count() ) : ?>
  Liset des gangsters que vous pouvez inviter dans votre gang : 
  <select name="user_invit" id="user_invit" class="inputbox">
    <?php foreach( $list_invite as $val ) : ?>
			<?php if(!isset($en_cours[$val->id])) : ?>
      <option value="<?php echo $val->id; ?>" style="background-color:<?php echo $val->couleur_gang; ?>"><?php echo $val->username; ?></option>
      <?php endif ?>
    <?php endforeach ?>
  </select>
  <input type="button" class="button" value="Inviter" id="lancer_invitation" />
  <?php endif ?>
  
  <?php if( isset($list_invite_en_cours) && $list_invite_en_cours ) : ?>
  <h3 style="margin-bottom:10px;" class="jaune">:: Liste des invitations en cours</h3>
  <table border="0" cellspacing="1" cellpadding="2" width="99%" align="center" class="tableau_score">
    <?php $n = 1; ?>
    <?php foreach( $list_invite_en_cours as $val ) : ?>
    <tr valign="middle" align="center" class="tableau_<?php echo ($n%2 == 0) ? 'pair' : 'impair' ?>" >
      <td width="25"><img src="<?php echo url::base(); ?>images/avatars/<?php echo $val->avatar; ?>" alt="Img" class="vignette30" <?php if($val->couleur_gang) echo 'style="background-color:'.$val->couleur_gang.'"'; ?>/></td>
      <td align="left"><span class="name_score name_tchat"><?php echo $val->username; ?></span></td>
      <td width="50"><?php echo chr( $val->y+64 ).' - '.$val->x; ?></td>
      <td width="60"><?php echo $val->recherche ? '<strong class="rouge">recherch&eacute;</strong>' : '<strong class="vert">tranquille</strong>'; ?></td>
      <td width="30" align="left">lvl <?php echo $val->niveau; ?></td>
      <td width="80" align="right"><span class="argent_score"><?php echo number_format($val->argent); ?> $</span></td>
      <td width="50" align="right"><input type="button" class="button supprimer_invite" name="<?php echo $val->id; ?>" value="Annuler" /></td>
    </tr>
    <?php $n++; endforeach ?>
  </table>
  <div class="spacer separator"></div>
  <?php endif ?>
  <?php endif ?>
  <?php if( isset($list_invite_demande) && $list_invite_demande ) : ?>
  <h3 style="margin-bottom:10px;" class="jaune">:: Liste des invitations venant d'un autre gang</h3>
  <table border="0" cellspacing="1" cellpadding="2" width="99%" align="center" class="tableau_score">
    <?php $n = 1; ?>
    <?php foreach( $list_invite_demande as $val ) : ?>
    <tr valign="middle" align="center" class="tableau_<?php echo ($n%2 == 0) ? 'pair' : 'impair' ?>" >
      <td width="25"><img src="<?php echo url::base(); ?>images/gang/<?php echo $val->image_gang; ?>" alt="Img" class="vignette30" <?php if($val->couleur_gang) echo 'style="background-color:'.$val->couleur_gang.'"'; ?>/></td>
      <td align="left"><span class="name_score"><?php echo $val->nom_gang; ?></span></td>
      <td width="125" align="center"><?php echo date::FormatDate( $val->date_invit ); ?></td>
      <td width="80" align="right"><input type="button" class="button valider_invite" name="<?php echo $val->id; ?>" value="Entrer dans le gang" /></td>
      <td width="50" align="right"><input type="button" class="button supprimer_invite" name="<?php echo $val->id; ?>" value="Annuler" /></td>
    </tr>
    <?php $n++; endforeach ?>
  </table>
  <div class="spacer separator"></div>
  <?php endif ?>
  <?php if( isset($liste_users) && $liste_users ) : ?>
  <h3 style="margin-bottom:10px;" class="jaune">:: Liste de tous les membres de votre <span class="name_tchat">gang</span></h3>
  <table border="0" cellspacing="1" cellpadding="2" width="99%" align="center" class="tableau_score">
    <?php $n = 1; ?>
    <?php foreach( $liste_users as $val ) : ?>
    <tr valign="middle" align="center" class="tableau_<?php echo ($n%2 == 0) ? 'pair' : 'impair' ?>" >
      <td width="10" class="<?php echo ( $n <= 10 ) ? 'rouge bold' : 'vert'; ?>"><?php echo $n; ?></td>
      <td align="left" width="25">
       <a href="javascript:;" onclick="displayMessage('<?php	echo url::base(TRUE);	?>users/detail/<?php echo $val->id; ?>.html', 300, 250)"><small>détail</small></a>
      </td>
      <td width="25"><img src="<?php echo url::base(); ?>images/avatars/<?php echo $val->avatar; ?>" alt="Img" class="vignette30" <?php if($val->couleur_gang) echo 'style="background-color:'.$val->couleur_gang.'"'; ?>/></td>
      <td align="left"><span class="name_score name_tchat"><?php echo $val->username; ?></span></td>
      <td width="50"><?php echo chr( $val->y+64 ).' - '.$val->x; ?></td>
      <td width="60"><?php echo $val->recherche ? '<strong class="rouge">recherch&eacute;</strong>' : '<strong class="vert">tranquille</strong>'; ?></td>
      <td width="30" align="left">lvl <?php echo $val->niveau; ?></td>
      <td width="80" align="right"><span class="argent_score"><?php echo number_format($val->argent); ?> $</span></td>
      <td width="50">
        <?php 
			if( $val->prison )
				echo '<strong class="bleu">Prison</strong>';
			elseif( $val->planque )
				echo '<strong class="rouge">planque</strong>';
			else
				echo '<strong class="vert">dehors</strong>'; ?>
      </td>
      <?php if( isset( $boss_gang ) && $boss_gang ) : ?>
      <?php if( $my_id != $val->id && $my_niveau <= $val->niveau ) : ?>
      <td width="50" align="right"><input type="button" class="button update_boss_invite" name="<?php echo $val->id; ?>" value="Passer les pouvoirs" /></td>
      <?php elseif( $my_niveau > $val->niveau ) : ?>
      <td width="50" align="right" class="rouge">Il n'a pas le niveau</td>
      <?php else : ?>
      <td width="50" align="center" class="rouge">Vous êtes le <strong>BOSS</strong></td>
      <?php endif ?>
      <?php endif ?>
    </tr>
    <?php $n++; endforeach ?>
  </table>
  <?php endif ?>
</div>
