<?php defined('SYSPATH') OR die('No direct access allowed.'); ?>
<div class="conteneurProduit">
  <div class="conteneurVignette" <?php if($val->couleur_gang) echo 'style="background-color:'.$val->couleur_gang.'"'; ?>> <?php echo html::image('images/avatars/'.$val->avatar, array( 'width' => 60, 'height' => 60 ) ); ?>
  <?php if( $flic ) : ?>
  <img src="<?php echo url::base(); ?>images/icon/policeman.png" class="iconPolice" />
<?php endif ?>
   </div>
  <?php if($val->id_vehicule) : ?>
  <div class="conteneurVignette">
    <div class="infoVignette"><?php echo graphisme::barre_simple( $val->etat_vehicule ); ?></div>
    <?php echo html::image('images/voitures/'.$val->image_vehicule, array( 'width' => 60, 'height' => 60 ) ); ?> </div>
  <?php endif ?>
  <div class="conteneurTitreProduitDrogue"> <span class="titreProduitDrogue"><span class="name_tchat"><?php echo $val->username; ?></span> <small>(lvl <?php echo number_format( $val->niveau );?>)</small> <a href="javascript:;" onclick="displayMessage('<?php	echo url::base(TRUE);	?>users/detail/<?php echo $val->id; ?>.html', 300, 250)"><small>détail</small></a></span></div>
  
  <?php if( $val->recherche && $id_gang == 1 ) : ?>
  <p><strong class="jaune">Ce gangster est recherché par la police !</strong></p>
  
  <?php elseif( $val->recherche ) : ?>
  <p><strong class="jaune">Ce gangster est recherché, tu peux le dénoncer !</strong></p>
  <?php endif ?>
  <p>
    <?php 
	if(!$val->id_gang)
		echo '<b class="rouge">Il ne fait pas parti d\'un gang.</b>';
	else
	{
		echo '<img src="<?php echo url::base(); ?>images/gang/'.$val->image_gang.'" class="vignette30" style="margin-right:5px;" align="left" /> ';
		if($val->id_gang == 1 )
			echo '<b style="color:'.$val->couleur_gang.'">Il est policier tout comme toi</b>';
		else
			echo '<b style="color:'.$val->couleur_gang.'">Il fait parti du gang : '.$val->nom_gang.'</b>'; 
		echo '<p style="margin-bottom:10px;">'.text::limit_chars(strip_tags($val->commentaire_gang), 150, '...', true).'</p>'; 
	}
	?>
  </p>
  <p>
    <?php 
	if(!$val->id_vehicule)
		echo '<b class="rouge">Il n\'est pas en voiture.</b>';
	else
		echo '<b class="vert">Il est en '.$val->name_vehicule.' qui vaut environs '.number_format($val->prix_vehicule).' $. (lvl '.number_format($val->niveau_vehicule).')</b>'; 
	?>
  </p>
  <?php if( !$desactive ) : ?>
  <div class="button_action">
  	<?php if( $id_gang == 1 && !$val->id_combat && !$en_combat ) : ?>
			<?php if( $val->recherche ) : ?>
      <input type="button" name="<?php echo $val->id; ?>" value="Prison" class="button prison_user" /> 
      <?php endif ?>
    <input type="button" name="<?php echo $val->id; ?>" value="Contrôle de routine" class="button control_user" />
    <?php elseif( $val->recherche && $id_gang != 1 && $val->id_gang != 1 && $id_gang != $val->id_gang && !$en_combat )  : ?>
    <input type="button" name="<?php echo $val->id; ?>" value="Dénoncer" class="button denoncer_user" />
    <?php endif ?>
    <?php if($val->id_combat && !$en_combat ) : ?>
    <input type="button" name="<?php echo $val->id_combat; ?>" value="Lancer l'attaque" class="button lancer_combat_user" />
    <input type="button" name="<?php echo $val->id_combat; ?>" value="Annuler l'attaque" class="button annuler_combat" />
    <?php elseif($id_gang != $val->id_gangs && !$en_combat) : ?>
    <input type="button" name="<?php echo $val->id; ?>" value="Pr&eacute;parer une attaque" class="button prepare_combat_user" />
    <input id="last_login_<?php echo $val->id; ?>" type="hidden" value="<?php echo $val->last_login; ?>" />
    <?php elseif($id_gang != $val->id_gangs && $en_combat) : ?>
    <div class="rouge">Vous êtes en combat</div>
    <?php else : ?>
    <div class="rouge">Ce gangster fait parti de ton <span class="name_tchat">gang</span></div>
    <?php endif ?>
  </div>
  <?php endif ?>
  <div class="spacer"></div>
</div>
<input id="last_login" type="hidden" value="<?php echo $time_login; ?>" />
