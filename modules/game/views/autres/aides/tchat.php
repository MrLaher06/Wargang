<?php defined('SYSPATH') OR die('No direct access allowed.'); ?>
<div class="conteneur_action">
  <h2>:: Explication sur le tchat</h2>
  <img src="<?php echo url::base(); ?>images/aide/tel.png" width="60" align="left" />
  <p>Voici la liste des raccourcis à taper dans le tchat pour avoir des informations supplémentaires ou discuter avec certaines personnes. Si vous n'utilisez pas le symbole &quot; <span class="orange">/</span> &quot; Tout le monde pourra lire votre message.<br />
    Le tchat peut aussi vous permettre d'avoir des renseignements sur des actions vous concernant.
  </p>
  <div class="spacer"></div>
  <h2>:: Liste des raccourcis du tchat</h2>
  <ul class="li_aide_tchat">
    <li>Ne pas utiliser <strong class="rouge">/</strong> vous permet de parler à tout le monde<br />
      <input type="text" disabled value="Bonjour tout le monde" class="inputbox" size="50" />
      <input type="button" value="Envoyer le message" disabled class="button" />
    </li>
    <li><strong class="rouge">/nom_gangster</strong> : permet d'envoyer un message privé à un autre gangster<br />
      <input type="text" disabled value="/alban Salut alban je te parle en privé" class="inputbox" size="50" />
      <input type="button" value="Envoyer le message" disabled class="button" />
    </li>
    <li><strong class="rouge">/gang</strong> : permet d'écrire à tous les membres du gang<br />
      <input type="text" disabled value="/gang Je discute que avec mon gang" class="inputbox" size="50" />
      <input type="button" value="Envoyer le message" disabled class="button" />
    </li>
    <li><strong class="rouge">/attaque</strong> : permet de connaitre ses points d'attaque<br />
      <input type="text" disabled value="/attaque" class="inputbox" size="50" />
      <input type="button" value="Envoyer le message" disabled class="button" />
    </li>
    <li><strong class="rouge">/defense</strong> : permet de connaitre ses points défense<br />
      <input type="text" disabled value="/defense" class="inputbox" size="50" />
      <input type="button" value="Envoyer le message" disabled class="button" />
    </li>
    <li><strong class="rouge">/online</strong> : connaitre le nombre de gangsters qui sont de sortie<br />
      <input type="text" disabled value="/online" class="inputbox" size="50" />
      <input type="button" value="Envoyer le message" disabled class="button" />
    </li>
    <li><strong class="rouge">/crier</strong> : mettre en avant un phrase sur le tchat<br />
      <input type="text" disabled value="/crier Je veux me faire entendre !!!!" class="inputbox" size="50" />
      <input type="button" value="Envoyer le message" disabled class="button" />
    </li>
  </ul>
</div>
<div class="close_windows"><a href="javascript:;" onclick="paneSplitter.loadContent('regles','<?php	echo url::base(TRUE);	?>aide.html');" >Revenir au sommaire</a> - <a href="javascript:;" onclick="paneSplitter.deleteContentById('regles');" >Fermer cette page</a></div>
