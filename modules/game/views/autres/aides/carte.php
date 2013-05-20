<?php defined('SYSPATH') OR die('No direct access allowed.'); ?>

<div class="conteneur_action">
  <h2>:: Explication sur la carte et les déplacement</h2>
  <img src="<?php echo url::base(); ?>images/aide/carte.png" width="60" align="left" />
  <p align="justify">La carte vous permet de vous déplacer et de voir ce qu'il se passe autour de vous. Votre champ de vision sur celle ci sera augmenter tout le long du jeu selon le niveau que votre gangster aura acquit. Sur cette carte vous pourrez aussi voir ou se trouvent les différents bâtiments qui constitut le jeu.
  Les autres gangsters seront afficher selon différentes possibilitées :
  </p>
  <ul>
  <li>Un gangster seul sur une case</li>
  <li>Plusieurs gangsters sur une même carte représenté par un point d'interrogation.</li>
  <li>Un gangster dans un bâtiment</li>
  <li>Plusieurs gangsters sur un même bâtiment.</li>
  </ul>
  <div class="spacer"></div>
<div class="close_windows"><a href="javascript:;" onclick="paneSplitter.loadContent('regles','<?php	echo url::base(TRUE);	?>aide.html');" >Revenir au sommaire</a> - <a href="javascript:;" onclick="paneSplitter.deleteContentById('regles');" >Fermer cette page</a></div>
