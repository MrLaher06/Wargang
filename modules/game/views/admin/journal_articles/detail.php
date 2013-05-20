<?php defined('SYSPATH') OR die('No direct access allowed.'); ?>

<form method="post" action="<?php	echo url::base(TRUE);	?>admin/journal/enregistrement">
  <div style="float:left; width:60%">
    <?php Fck_Core::editeur('texte', isset( $journal_articles->texte ) && $journal_articles->texte ? $journal_articles->texte : '', '420px'); ?>
  </div>
  <div style="float:right; width:38%">
    <div class="bloc_user">
      <h2><img src="<?php echo url::base(); ?>images/admin/icone/Tools.png" width="32" height="32" align="absmiddle" /> Paramètre de l'article</h2>
      <div class="edit_user"><strong>ID</strong> : <?php echo $journal_articles->id; ?></div>
      <div class="edit_user">
        <label> Titre de l'article :
          <input type="text" class="inputbox" name="titre" id="titre" value="<?php echo $journal_articles->titre; ?>" style="width:210px;" />
        </label>
      </div>
      <div class="edit_user">
        <label> Type de l'article :
          <select class="inputbox" name="type" id="type" style="width:210px;">
            <option value="1" <?php echo $journal_articles->type == 1 ? 'selected="selected"' : ''; ?>>"Attaque" vient de démonter "défense"</option>
            <option value="2" <?php echo $journal_articles->type == 2 ? 'selected="selected"' : ''; ?>>"Attaque" vient de se casser les dents sur "défense"</option>
            <option value="3" <?php echo $journal_articles->type == 3 ? 'selected="selected"' : ''; ?>>"Attaque" a braqué "batiment"</option>
            <option value="4" <?php echo $journal_articles->type == 4 ? 'selected="selected"' : ''; ?>>"Attaque" a loupé le braquage "batiment"</option>
            <option value="5" <?php echo $journal_articles->type == 5 ? 'selected="selected"' : ''; ?>>"Attaque" vient d'acheter un "batiment"</option>
            <option value="6" <?php echo $journal_articles->type == 6 ? 'selected="selected"' : ''; ?>>"Attaque" vient de rouler sur "défense"</option>
            <option value="7" <?php echo $journal_articles->type == 7 ? 'selected="selected"' : ''; ?>>"Attaque" a voulu rouler sur "défense" mais il a loupé</option>
            <option value="8" <?php echo $journal_articles->type == 8 ? 'selected="selected"' : ''; ?>>"Attaque" vient de mettre en prison "défense"</option>
            <option value="9" <?php echo $journal_articles->type == 9 ? 'selected="selected"' : ''; ?>>"Attaque" vient de voler de l'argent</option>
            <option value="10" <?php echo $journal_articles->type == 10 ? 'selected="selected"' : ''; ?>>"Attaque" a loupé le vole d'argent</option>
            <option value="11" <?php echo $journal_articles->type == 11 ? 'selected="selected"' : ''; ?>>"Attaque" vient de dénoncer "défense"</option>
            <option value="11" <?php echo $journal_articles->type == 11 ? 'selected="selected"' : ''; ?>>"Attaque" a voulu dénoncer "défense" mais il a loupé</option>
          </select>
        </label>
      </div>
      <div class="edit_user">
        <label> Actif :
          <select class="inputbox" name="actif" id="actif">
            <option value="0" >Non</option>
            <option value="1" <?php echo $journal_articles->actif ? 'selected="selected"' : ''; ?>>Oui</option>
          </select>
        </label>
      </div>
      <div class="edit_user">
        <label> ID <strong>You Tube</strong> :
          <input type="text" class="inputbox" name="youtube" id="youtube" value="<?php echo $journal_articles->youtube; ?>" style="width:150px;" />
        </label>
      </div>
      <div class="edit_user">
        <label> ID <strong>Dailymotion</strong> :
          <input type="text" class="inputbox" name="dailymotion" id="dailymotion" value="<?php echo $journal_articles->dailymotion; ?>" style="width:150px;" />
        </label>
      </div>
      <div class="edit_user">
        <label> Langue de l'article :
          <select class="inputbox" name="lang" id="lang">
            <option value="fr_FR" <?php echo $journal_articles->lang == 'fr_FR' ? 'selected="selected"' : ''; ?>>Fance</option>
            <option value="en_EN" <?php echo $journal_articles->lang == 'en_EN' ? 'selected="selected"' : ''; ?>>English</option>
          </select>
        </label>
      </div>
      <hr/>
      <h2>
      <img src="<?php echo url::base(); ?>images/admin/icone/Accessibility.png" width="32" height="32"  align="absmiddle" />Aide pour l'insertion</h2>
      <div class="edit_user">{attaque} : nom du lanceur lors de l'action</div>
      <div class="edit_user">{gang_attaque} : nom de la mafia qui attaque</div>
      <div class="edit_user">{defense} : nom de la défense lors de l'action</div>
      <div class="edit_user">{gang_defense} : nom de la mafia qui attaque</div>
      <div class="edit_user">{argent} : argent gagné/perdu lors de l'action</div>
      <div class="edit_user">{position} : position de l'action</div>
      <div class="edit_user">{nombre_attaque} : nombre de joueur attaquant lors de l'action</div>
    </div>
  </div>
  <input type="hidden" name="id" id="id" value="<?php echo $journal_articles->id; ?>" />
</form>
<div class="spacer"></div>
