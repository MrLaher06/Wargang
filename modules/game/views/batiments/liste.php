<?php defined('SYSPATH') OR die('No direct access allowed.'); ?>

<div class="conteneur_action">
  <h2>:: Liste des bâtiments</h2>
  <img src="<?php echo url::base(); ?>images/aide/aide.png" width="60" align="left" />
  <p align="justify">Cette page vous guidera sur les différentes positions des bâtiments actifs sur le jeu.</p>
  <div class="spacer"></div>
  <?php if( isset($resultat) && $resultat ) : ?>
  <table border="0" cellspacing="1" cellpadding="2" width="99%" align="center" class="tableau_score">
    <?php $n = 1; ?>
    <?php foreach( $resultat as $val ) : ?>
    <tr valign="middle" align="center" class="tableau_<?php echo ($n%2 == 0) ? 'pair' : 'impair' ?>" >
      <td align="left" class="orange"><strong><?php echo $val->nom; ?></strong></td>
      <td width="80" <?php echo $val->couleur_gang ? 'style="background-color:'.$val->couleur_gang.'"' : ''; ?>><?php echo $val->username ? $val->username : 'Aucun proprio'; ?></td>
      <td width="40" class="vert"><?php echo chr( $val->y+64 ); ?></td>
      <td width="40" class="vert"><?php echo $val->x; ?></td>
      <td width="80" class="bleu"><?php echo $val->type_option; ?></td>
    </tr>
    <?php $n++; ?>
    <?php endforeach ?>
  </table>
  <?php endif ?>
</div>
<div class="close_windows"><a href="javascript:;" onclick="paneSplitter.loadContent('regles','<?php	echo url::base(TRUE);	?>aide.html');" >Revenir au sommaire</a> - <a href="javascript:;" onclick="paneSplitter.deleteContentById('regles');" >Fermer cette page</a></div>
