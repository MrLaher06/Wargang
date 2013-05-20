<?php defined('SYSPATH') or die('No direct access allowed.'); ?>
<div class="closeOverlay"> <img onclick="closeMessage()" src="<?php echo url::base(); ?>images/icon/close.png" width="30" height="30" alt="Fermer" /> </div>
<div style="padding:5px">
  <h2 style="margin-bottom:5px;">Proposer un article au journal de War Gang</h2>
  <form name="form_proposer_article" id="form_proposer_article" method="post" onsubmit="return false" >
    <div style="float:left; width:55%">
      <textarea name="texte_article" rows="10" class="inputbox" id="texte_article" style="width:420px;"></textarea>
     <h3>Exemple :</h3> 
    <p align="justify">
    Depuis quelque temps, <strong class="jaune">{defense}</strong> trainait près du territoire de <strong class="jaune">{gang_attaque}</strong> afin d'observer les activités de ces derniers. Malheureusement pour <strong class="jaune">{defense}</strong>, il a été repéré par <strong class="jaune">{attaque}</strong> qui n'a pas hésité à sortir son Avenger ! <br />Résulat, <strong class="jaune">{defense}</strong> a pris cinq balles dans le buffet, mais il a réussi à s'échapper on ne sait comment. Nul doute que <strong class="jaune">{defense}</strong> a les boules et prépare avec soin sa vengeance contre <strong class="jaune">{attaque}</strong> quand ce dernier ne sera plus sur ses gardes...
<br /><br />
El Loco
    </p>
    </div>
    <div style="float:right; width:43%">
      <div>
        <h2><img src="<?php echo url::base(); ?>images/admin/icone/Tools.png" width="32" height="32" align="absmiddle" /> Paramètre de l'article</h2>
        <div style="margin-bottom:10px;">
          <label> Titre de l'article :
            <input type="text" class="inputbox" name="titre" id="titre" value="" style="width:220px;" />
          </label>
        </div>
        <div style="margin-bottom:10px;">
          <label> Type de l'article :
            <select class="inputbox" name="type" id="type" style="width:220px;">
              <option value="1">"Attaque" vient de démonter "défense"</option>
              <option value="2">"Attaque" vient de se casser les dents sur "défense"</option>
              <option value="3">"Attaque" a braqué "batiment"</option>
              <option value="4">"Attaque" a loupé le braquage "batiment"</option>
              <option value="5">"Attaque" vient d'acheter un "batiment"</option>
              <option value="6">"Attaque" vient de rouler sur "défense"</option>
              <option value="7">"Attaque" a voulu rouler sur "défense" mais il a loupé</option>
              <option value="8">"Attaque" vient de mettre en prison "défense"</option>
              <option value="9">"Attaque" vient de voler de l'argent</option>
              <option value="10">"Attaque" a loupé le vole d'argent</option>
              <option value="11">"Attaque" vient de dénoncer "défense"</option>
              <option value="11">"Attaque" a voulu dénoncer "défense" mais il a loupé</option>
            </select>
          </label>
        </div>
        <div style="margin-bottom:10px;">
          <label> Langue de l'article :
            <select class="inputbox" name="lang" id="lang">
              <option value="fr_FR">Fance</option>
              <option value="en_EN">English</option>
            </select>
          </label>
        </div>
        <hr/>
        <h2> <img src="<?php echo url::base(); ?>images/admin/icone/Accessibility.png" width="32" height="32"  align="absmiddle" />Aide pour l'insertion</h2>
        <div>{attaque} : nom du lanceur lors de l'action</div>
        <div>{gang_attaque} : nom de la mafia qui attaque</div>
        <div>{defense} : nom de la défense lors de l'action</div>
        <div>{gang_defense} : nom de la mafia qui attaque</div>
        <div>{argent} : argent gagné/perdu lors de l'action</div>
        <div>{position} : position de l'action</div>
        <div>{nombre_attaque} : nombre de joueur attaquant lors de l'action</div>
      </div>
    </div>
    <div class="spacer"></div>
    <div align="right" style="margin-top:10px">
    <input type="button" class="button" value="Envoyer votre article" onclick="creation_article ();" id="proposer_article" />
    </div>
  </form>
</div>
