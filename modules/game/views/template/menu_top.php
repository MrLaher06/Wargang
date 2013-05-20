<?php defined('SYSPATH') or die('No direct access allowed.'); ?>
<div id="menuTop">
  <div id="menuBarContainer">
    <div id="innerDiv"></div>
    <div id="rightDiv"></div>
  </div>
</div>
<ul id="menuModel" style="display:none">
  <li id="00000" class="liDeconnec"><a href="logout.html" id="planquer_logout"><span class="deconnec">Se planquer</span></a></li>
  <li id="10000" jsFunction="panelAfficher('center','contenu')"><a href="#">Actions</a></li>
  <?php if(!$facebook) : ?>
  <li id="20000" jsFunction="displayMessage('carte.html', 683, 563)"><a href="#">Carte</a></li>
  <?php else : ?>
  <li id="20000" jsFunction="displayMessage('carte.html', 560, 440)"><a href="#">Carte</a></li>
  <?php endif ?>
  <li id="30000" jsFunction="panelAfficher('center','drogues')"><a href="#">Deal</a></li>
  <li id="40000" jsFunction="panelAfficher('center','gang')"><a href="#">Gang</a></li>
  <li id="50000" jsFunction="displayMessage('mission.html', 340, 250)"><a href="#">Mission</a></li>
  <li id="60000" jsFunction="panelAfficher('center','statistiques','statistiques.html','Vos statistiques du jour','Statistiques')"><a href="#">Statistiques</a></li>
  <li id="70000" jsFunction="panelAfficher('center','journal','journal.html','Journal','Journal')"><a href="#">Journal</a></li>
  <li id="80000" jsFunction="panelAfficher('center','score','score.html','Score','score')"><a href="#">Score</a></li>
  <li id="90000" jsFunction="openUrl('http://www.openrpg.fr/forums/wargang')"><a href="#">Forum</a></li>
  <li id="100000" jsFunction="panelAfficher('center','regles','aide.html','Les règles du jeu','Règles')"><a href="#">R&egrave;gles</a></li>
	<?php if($facebook) : ?>
  <li id="110000" jsFunction="openUrl('http://www.wargang.com')"><a href="#"><b class="vert">Site officiel</b></a></li>
	<?php endif ?>
	<?php if($role) : ?>
  <li id="110000" jsFunction="openUrl('admin.html')"><a href="#"><span style="color:#F60">Administration</span></a></li>
	<?php endif ?>
</ul>