<?php defined('SYSPATH') OR die('No direct access allowed.'); ?>

<div class="conteneur_action">
  <h2>:: Les règles du jeu</h2>
  <img src="<?php echo url::base(); ?>images/aide/aide.png" width="60" align="left" />
  <p align="justify">Cette page vous guidera sur les différentes explications de chaque élément du jeu.<br />Pour mieux connaitre War gang, l'histoire du jeu permettra de vous aider.</p>
  <div class="spacer"></div>
  <table width="100%" border="0" cellspacing="0" cellpadding="0">
    <tr>
      <td align="left" valign="top">
        <ul>
        	<li><a href="javascript:;" onclick="paneSplitter.loadContent('regles','<?php	echo url::base(TRUE);	?>batiments/liste.html');">Liste des bâtiments</a></li>
          <?php echo $left; ?>
        </ul>
      </td>
      <td align="left" valign="top">
        <ul>
        	<li><a href="javascript:;" onclick="paneSplitter.loadContent('regles','<?php	echo url::base(TRUE);	?>allopass/tarif/regle.html');">Tableau sur les prix Allopass</a></li>
        	<li><a href="javascript:;" onclick="paneSplitter.loadContent('regles','<?php	echo url::base(TRUE);	?>pub.html');">Faire connaitre War Gang</a></li>
          <?php echo $right; ?>
        </ul>
      </td>
    </tr>
  </table>
</div>
<div class="close_windows"><a href="javascript:;" onclick="paneSplitter.deleteContentById('regles');" >Fermer cette page</a></div>
