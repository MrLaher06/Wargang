<?php defined('SYSPATH') OR die('No direct access allowed.'); ?>
<script language="javascript" type="text/javascript">
$(document).ready(function() {
<?php if($alerte_attaque) : ?>
	$('title').html('On vous attaque');
	$('#DHTMLSuite_paneContentwest').css('background-color', '#470a0a');
<?php else : ?>
	$('#DHTMLSuite_paneContentwest').css('background-color', '#000');
	if($('title').html() == 'On vous attaque')
		$('title').html('War Gang');
<?php endif ?>
});
</script>
<?php if($alerte_attaque) : ?>

<div class="alerte_attaque"><img src="<?php echo url::base(); ?>images/combat/alert.png" width="30" /></div>
<?php endif ?>
<div id="detailUserPrincipal">
  <table width="100%" border="0" cellspacing="5" cellpadding="0">
    <tr valign="top">
      <td width="30" align="center"><img src="<?php echo url::base(); ?>images/avatars/<?php echo $user->avatar; ?>" width="30" alt="img" class="vignetteInfo" style="background-color:<?php echo $gang->couleur_gang; ?>;" />
<a href="javascript:;" onclick="displayMessage('<?php	echo url::base(TRUE);	?>modifier.html', 350, 370)"><small>Modifier</small></a></td>
      <td>
        <div class="name"><?php echo $user->username; ?></div>
        <?php echo graphisme::barre( $user->hp, 'hp :' ); ?> <?php echo graphisme::barre( $user->view_xp(), 'xp :', $user->xp, $user->niveau_suivant() ); ?></td>
    </tr>
    <?php if($user->id_arme) : ?>
    <tr valign="top">
      <td width="30"><img src="<?php echo url::base(); ?>images/armes/<?php echo $arme->image_arme; ?>" width="30" alt="img" class="vignetteInfo" /></td>
      <td>
        <div class="name"><?php echo $arme->name_arme; ?> : <?php echo $user->munition; ?>/<?php echo $arme->munition_arme; ?> M</div>
        <?php echo graphisme::barre( $arme->attaque, 'Attaque :' ); ?> <?php echo graphisme::barre( $arme->precision, 'Precision :' ); ?></td>
    </tr>
    <?php endif ?>
    <?php if($user->id_protection) : ?>
    <tr valign="top">
      <td width="30"><img src="<?php echo url::base(); ?>images/protections/<?php echo $protection->image_protection; ?>" width="30" alt="img" class="vignetteInfo" /></td>
      <td>
        <div class="name"><?php echo $protection->name_protection; ?></div>
        <?php echo graphisme::barre( $protection->defense, 'Defense :' ); ?> <?php echo graphisme::barre( $user->etat_protection, 'Etat :' ); ?></td>
    </tr>
    <?php endif ?>
    <?php if($user->id_vehicule) : ?>
    <tr valign="top">
      <td width="30"><img src="<?php echo url::base(); ?>images/voitures/<?php echo $vehicule->image_vehicule; ?>" width="30" alt="img" class="vignetteInfo" /></td>
      <td>
        <div class="name"><?php echo $vehicule->name_vehicule; ?> : <?php echo $user->reservoir_vehicule; ?>/<?php echo $vehicule->reservoir; ?> L</div>
        <?php echo graphisme::barre( $user->etat_vehicule, 'Etat :' ); ?>
        <div class="deplacement">D&eacute;placement <strong>
				<?php 
				$temps = $vehicule->deplacement($user->etat_vehicule, $user->reservoir_vehicule) - ( time() - $user->time_move ); 
				echo $temps > 0 ? 'dans '.$temps.' s' : 'possible';
				?>
        </strong></div>
      </td>
    </tr>
    <?php endif ?>
  </table>
  <div id="detailUserSecondaire">
    <div><?php if( $user->id_gang != 1 ) echo '<strong>Gang</strong> : '; else echo '<strong>Vous êtes</strong> : ' ?><?php echo $gang->nom_gang; ?></div>
    <div><strong>Niveau</strong> : <?php echo $user->niveau; ?> lvl <small>(<?php echo $user->view_xp(); ?>%)</small></div>
    <div><strong>Argent</strong> : <span id="argent_user"><?php echo number_format( $user->argent ); ?></span> $</div>
    <div><strong>Recherché</strong> : <?php echo $user->recherche ? '<span class="rouge"><blink>oui</blink></span>' : '<span class="vert">non</span>'; ?></div>
  </div>
</div>
