<?php defined('SYSPATH') OR die('No direct access allowed.'); ?>
<div class="conteneur_action">
<h2>:: Pour gagner la partie</h2>
<table border="0" cellspacing="5" cellpadding="5">
  <tr>
    <td><img src="<?php echo url::base(); ?>images/options_batiment/victoire.jpg" height="100" /></td>
    <td><h3>Pour gagner la partie vous devez :</h3> 
<ul>
<li>Avoir votre propre gang</li>
<li>Etre le chef du gang pour lancer la validation</li>
<li>Le chef doit avoir un niveau sup&eacute;rieur ou &eacute;gale &agrave; <strong class="jaune"><?php echo number_format(Kohana::config( 'partie.level_chef_victoire' )); ?> lvl</strong></li>
<li>Avoir au minimum <strong class="jaune"><?php echo number_format(Kohana::config( 'partie.batiment_victoire' )); ?> b&acirc;timent(s)</strong> qui appartiennent &agrave; votre gang</li>
<li>Avoir au minimum <strong class="jaune"><?php echo number_format(Kohana::config( 'partie.user_total_case_victoire' )); ?> joueur(s) actif(s)</strong> de votre gang sur cette case</li>
<li>Que la somme d'argent des joueurs actif sur cette case soit sup&eacute;rieur ou &eacute;gale &agrave; <strong class="jaune"><?php echo number_format(Kohana::config( 'partie.argent_victoire' )); ?> $</strong></li>
</ul></td>
  </tr>
</table>

<h4 align="center" class="<?php echo $valide_niveau; ?>">Vous avez un niveau de <?php echo number_format($niveau); ?></h4>
<h4 align="center" class="<?php echo $valide_argent; ?>">Votre gang possède la somme de <?php echo number_format($argent); ?> $ </h4>
<h4 align="center" class="<?php echo $valide_batiment; ?>">Votre gang possède <?php echo number_format($batiment); ?> b&acirc;timent(s)</h4>
<h4 align="center" class="<?php echo $valide_user; ?>">Vous &ecirc;tes <?php echo number_format($nbr); ?> joueur(s) sur cette case</h4>
<h4 align="center" class="<?php echo $valide_gang; ?>">Vous &ecirc;tes dans un gang qui a &eacute;t&eacute; cr&eacute;&eacute;</h4>
<h4 align="center" class="<?php echo $valide_chef; ?>">Vous &ecirc;tes le chef du gang pour lancer la validation</h4>
<?php if( $valide_button ) : ?>
<div align="right">
<input type="button" id="valide_partie" value="Valider votre victoire sur War Gang" name="<?php echo $bat->id; ?>" class="button" />
</div>
<?php endif ?>
</div>