<?php defined('SYSPATH') OR die('No direct access allowed.'); ?>

<div class="conteneur_action">
  <h2>:: Les règles du jeu</h2>
  <img src="<?php echo url::base(); ?>images/aide/aide.png" width="60" align="left" />
  <p align="justify">Cette page vous guidera sur les différentes explications de chaque élément du jeu.<br />Pour mieux connaitre War gang, <a href="javascript:;" onclick="paneSplitter.loadContent('regles',''<?php	echo url::base(TRUE);	?>aide.html');">l'histoire du jeu</a> permettra de vous aider.</p>
  <div class="spacer"></div>
  <table width="100%" border="0" cellspacing="0" cellpadding="0">
    <tr>
      <td align="left" valign="top">
        <ul>
          <li><a href="javascript:;" onclick="paneSplitter.loadContent('regles','<?php	echo url::base(TRUE);	?>aide/detail/journal.html');">Comment fonctionne le journal</a></li>
          <li><a href="javascript:;" onclick="paneSplitter.loadContent('regles','<?php	echo url::base(TRUE);	?>aide/detail/armes.html');">Comment fonctionne les armes</a></li>
          <li><a href="javascript:;" onclick="paneSplitter.loadContent('regles','<?php	echo url::base(TRUE);	?>aide/detail/protections.html');">Comment fonctionne les protections</a></li>
          <li><a href="javascript:;" onclick="paneSplitter.loadContent('regles','<?php	echo url::base(TRUE);	?>aide/detail/vehicules.html');">Comment fonctionne les véhicules</a></li>
          <li><a href="javascript:;" onclick="paneSplitter.loadContent('regles','<?php	echo url::base(TRUE);	?>aide/detail/victoire.html');">Comment finir le jeu</a></li>
          <li><a href="javascript:;" onclick="paneSplitter.loadContent('regles','<?php	echo url::base(TRUE);	?>aide/detail/tchat.html');">Comment fonction le tchat</a></li>
        </ul>
      </td>
      <td align="left" valign="top">
        <ul>
          <li><a href="javascript:;" onclick="paneSplitter.loadContent('regles','<?php	echo url::base(TRUE);	?>aide/detail/actions.html');">Comment fonctionne les actions du jeu</a></li>
          <li><a href="javascript:;" onclick="paneSplitter.loadContent('regles','<?php	echo url::base(TRUE);	?>aide/detail/batiments.html');">Comment les bâtiment et leurs options</a></li>
          <li><a href="javascript:;" onclick="paneSplitter.loadContent('regles','<?php	echo url::base(TRUE);	?>aide/detail/combats.html');">Comment fonctionne les combats et les calculs</a></li>
          <li><a href="javascript:;" onclick="paneSplitter.loadContent('regles','<?php	echo url::base(TRUE);	?>aide/detail/deal.html');">Comment fonctionne les deals (drogues)</a></li>
          <li><a href="javascript:;" onclick="paneSplitter.loadContent('regles','<?php	echo url::base(TRUE);	?>aide/detail/carte.html');">Comment fonctionne la carte et les déplacements</a></li>
          <li><a href="javascript:;" onclick="paneSplitter.loadContent('regles','<?php	echo url::base(TRUE);	?>aide/detail/gang.html');">Comment fonctionne la partie gang</a></li>
        </ul>
      </td>
    </tr>
  </table>
</div>
<div class="close_windows"><a href="javascript:;" onclick="paneSplitter.deleteContentById('regles');" >Fermer cette page</a></div>
