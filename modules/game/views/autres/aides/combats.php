<?php defined('SYSPATH') OR die('No direct access allowed.'); ?>

<div class="conteneur_action">
<h2>:: Explication sur les combats</h2>
<img src="<?php echo url::base(); ?>images/aide/fight.png" width="60" align="left" />
<p align="justify">Vous avez la possibilité de combat divers éléments du jeu tel que  d'autres gangsters, des bots qui circule sur divers cases de la carte. Le combats peuvent s'effectuer soit en solo ou avec la participations d'autres gangsters de votre équipe et qu'ils soient à porté de cette actions (porté = visibilité sur la carte).</p>
<div class="spacer"></div>
<h2>:: Calcul de l'attaque</h2>
<h3>Statistiques prisent en compte</h3>
<p>Pendant un combat seul l'arme est prise en compte pour le calcul</p>
<ul>
  <li class="vert">Avec des munitions : attaque de l'arme - ( attaque de l'arme / précision de l'arme )</li>
  <li class="rouge">Sinon votre attaque est égale à un score de 0,25 pt.</li>
</ul>
<h2>:: Calcul de la défense</h2>
<h3>Statistiques prisent en compte</h3>
<p>Pendant un combat seul la protection est prise en compte pour le calcul</p>
<ul>
  <li class="vert">Avec un bon état de protection : défense de la protection - ( défense de la protection / état de la protection )</li>
  <li class="rouge">Sinon votre défense est égale à un score de 0,25 pt.</li>
</ul>
<div class="close_windows"><a href="javascript:;" onclick="paneSplitter.loadContent('regles','<?php	echo url::base(TRUE);	?>aide.html');" >Revenir au sommaire</a> - <a href="javascript:;" onclick="paneSplitter.deleteContentById('regles');" >Fermer cette page</a></div>
