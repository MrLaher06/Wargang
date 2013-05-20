<?php defined('SYSPATH') OR die('No direct access allowed.'); ?>

<form method="post" action="<?php	echo url::base(TRUE);	?>admin/football/enregistrement">
  <div class="content_edit_user" style="float:left;">
    <div class="bloc_user">
      <h2><img src="<?php echo url::base(); ?>images/admin/icone/Information.png" width="32" height="32" align="absmiddle" /> Informations générale</h2>
      <div class="edit_user">
        <label> Attaque de l'équipe :
          <select class="inputbox" name="attaque" id="attaque">
            <?php for($n=1; $n <= 100; $n++) : ?>
            <option value="<?php echo $n; ?>" <?php echo $bots->attaque == $n ? 'selected="selected"' : ''; ?>><?php echo $n; ?></option>
            <?php endfor ?>
          </select>
        </label>
      </div>
      <div class="edit_user">
        <label> Défense de l'équipe :
          <select class="inputbox" name="defense" id="defense">
            <?php for($n=1; $n <= 100; $n++) : ?>
            <option value="<?php echo $n; ?>" <?php echo $bots->defense == $n ? 'selected="selected"' : ''; ?>><?php echo $n; ?></option>
            <?php endfor ?>
          </select>
        </label>
      </div>
      <div class="edit_user">
        <label> Equilibre  de l'équipe :
          <select class="inputbox" name="equilibre" id="equilibre">
            <?php for($n=1; $n <= 100; $n++) : ?>
            <option value="<?php echo $n; ?>" <?php echo $bots->equilibre == $n ? 'selected="selected"' : ''; ?>><?php echo $n; ?></option>
            <?php endfor ?>
          </select>
        </label>
      </div>
      <div class="edit_user">
        <label> Etat physique de l'équipe :
          <select class="inputbox" name="physique" id="physique">
            <?php for($n=1; $n <= 100; $n++) : ?>
            <option value="<?php echo $n; ?>" <?php echo $bots->physique == $n ? 'selected="selected"' : ''; ?>><?php echo $n; ?></option>
            <?php endfor ?>
          </select>
        </label>
      </div>
      <div class="edit_user">
        <label> Vitesse de déplacement de l'équipe :
          <select class="inputbox" name="vitesse" id="vitesse">
            <?php for($n=1; $n <= 100; $n++) : ?>
            <option value="<?php echo $n; ?>" <?php echo $bots->vitesse == $n ? 'selected="selected"' : ''; ?>><?php echo $n; ?></option>
            <?php endfor ?>
          </select>
        </label>
      </div>
      <div class="edit_user">
        <label> Accélération des joueurs de l'équipe :
          <select class="inputbox" name="acceleration" id="acceleration">
            <?php for($n=1; $n <= 100; $n++) : ?>
            <option value="<?php echo $n; ?>" <?php echo $bots->acceleration == $n ? 'selected="selected"' : ''; ?>><?php echo $n; ?></option>
            <?php endfor ?>
          </select>
        </label>
      </div>
      <div class="edit_user">
        <label> Régularité de l'équipe :
          <select class="inputbox" name="regularite" id="regularite">
            <?php for($n=1; $n <= 100; $n++) : ?>
            <option value="<?php echo $n; ?>" <?php echo $bots->regularite == $n ? 'selected="selected"' : ''; ?>><?php echo $n; ?></option>
            <?php endfor ?>
          </select>
        </label>
      </div>
      <div class="edit_user">
        <label> Réaction sur le jeu :
          <select class="inputbox" name="reaction" id="reaction">
            <?php for($n=1; $n <= 100; $n++) : ?>
            <option value="<?php echo $n; ?>" <?php echo $bots->reaction == $n ? 'selected="selected"' : ''; ?>><?php echo $n; ?></option>
            <?php endfor ?>
          </select>
        </label>
      </div>
      <div class="edit_user">
        <label> Jeu d'équipe :
          <select class="inputbox" name="jeu_equipe" id="jeu_equipe">
            <?php for($n=1; $n <= 100; $n++) : ?>
            <option value="<?php echo $n; ?>" <?php echo $bots->jeu_equipe == $n ? 'selected="selected"' : ''; ?>><?php echo $n; ?></option>
            <?php endfor ?>
          </select>
        </label>
      </div>
      <div class="edit_user">
        <label> Agilité des joueurs :
          <select class="inputbox" name="agilite" id="agilite">
            <?php for($n=1; $n <= 100; $n++) : ?>
            <option value="<?php echo $n; ?>" <?php echo $bots->agilite == $n ? 'selected="selected"' : ''; ?>><?php echo $n; ?></option>
            <?php endfor ?>
          </select>
        </label>
      </div>
      <div class="edit_user">
        <label> Précision des dribbles :
          <select class="inputbox" name="precision_dribble" id="precision_dribble">
            <?php for($n=1; $n <= 100; $n++) : ?>
            <option value="<?php echo $n; ?>" <?php echo $bots->precision_dribble == $n ? 'selected="selected"' : ''; ?>><?php echo $n; ?></option>
            <?php endfor ?>
          </select>
        </label>
      </div>
      <div class="edit_user">
        <label> Précision des passes courtes :
          <select class="inputbox" name="precision_passe_court" id="precision_passe_court">
            <?php for($n=1; $n <= 100; $n++) : ?>
            <option value="<?php echo $n; ?>" <?php echo $bots->precision_passe_court == $n ? 'selected="selected"' : ''; ?>><?php echo $n; ?></option>
            <?php endfor ?>
          </select>
        </label>
      </div>
      <div class="edit_user">
        <label> Vitesse des passes courtes :
          <select class="inputbox" name="vitesse_passe_court" id="vitesse_passe_court">
            <?php for($n=1; $n <= 100; $n++) : ?>
            <option value="<?php echo $n; ?>" <?php echo $bots->vitesse_passe_court == $n ? 'selected="selected"' : ''; ?>><?php echo $n; ?></option>
            <?php endfor ?>
          </select>
        </label>
      </div>
      <div class="edit_user">
        <label> Précision des passes longues :
          <select class="inputbox" name="precision_passe_long" id="precision_passe_long">
            <?php for($n=1; $n <= 100; $n++) : ?>
            <option value="<?php echo $n; ?>" <?php echo $bots->precision_passe_long == $n ? 'selected="selected"' : ''; ?>><?php echo $n; ?></option>
            <?php endfor ?>
          </select>
        </label>
      </div>
      <div class="edit_user">
        <label> Vitesse des passes longueurs :
          <select class="inputbox" name="vitesse_passe_long" id="vitesse_passe_long">
            <?php for($n=1; $n <= 100; $n++) : ?>
            <option value="<?php echo $n; ?>" <?php echo $bots->vitesse_passe_long == $n ? 'selected="selected"' : ''; ?>><?php echo $n; ?></option>
            <?php endfor ?>
          </select>
        </label>
      </div>
      <div class="edit_user">
        <label> Précision des buteurs :
          <select class="inputbox" name="precision_tir" id="precision_tir">
            <?php for($n=1; $n <= 100; $n++) : ?>
            <option value="<?php echo $n; ?>" <?php echo $bots->precision_tir == $n ? 'selected="selected"' : ''; ?>><?php echo $n; ?></option>
            <?php endfor ?>
          </select>
        </label>
      </div>
      <div class="edit_user">
        <label> Puissance des buteurs :
          <select class="inputbox" name="puissance_tir" id="puissance_tir">
            <?php for($n=1; $n <= 100; $n++) : ?>
            <option value="<?php echo $n; ?>" <?php echo $bots->puissance_tir == $n ? 'selected="selected"' : ''; ?>><?php echo $n; ?></option>
            <?php endfor ?>
          </select>
        </label>
      </div>
      <div class="edit_user">
        <label> Technique des buteurs :
          <select class="inputbox" name="technique_tir" id="technique_tir">
            <?php for($n=1; $n <= 100; $n++) : ?>
            <option value="<?php echo $n; ?>" <?php echo $bots->technique_tir == $n ? 'selected="selected"' : ''; ?>><?php echo $n; ?></option>
            <?php endfor ?>
          </select>
        </label>
      </div>
      <div class="edit_user">
        <label> Détente des joueurs :
          <select class="inputbox" name="detente" id="detente">
            <?php for($n=1; $n <= 100; $n++) : ?>
            <option value="<?php echo $n; ?>" <?php echo $bots->detente == $n ? 'selected="selected"' : ''; ?>><?php echo $n; ?></option>
            <?php endfor ?>
          </select>
        </label>
      </div>
      <div class="edit_user">
        <label> Téchniques des joueurs :
          <select class="inputbox" name="technique" id="technique">
            <?php for($n=1; $n <= 100; $n++) : ?>
            <option value="<?php echo $n; ?>" <?php echo $bots->technique == $n ? 'selected="selected"' : ''; ?>><?php echo $n; ?></option>
            <?php endfor ?>
          </select>
        </label>
      </div>
      <div class="edit_user">
        <label> Agressivité des joueurs :
          <select class="inputbox" name="agressivite" id="agressivite">
            <?php for($n=1; $n <= 100; $n++) : ?>
            <option value="<?php echo $n; ?>" <?php echo $bots->agressivite == $n ? 'selected="selected"' : ''; ?>><?php echo $n; ?></option>
            <?php endfor ?>
          </select>
        </label>
      </div>
      <div class="edit_user">
        <label> Mentalité des joueurs :
          <select class="inputbox" name="mentalite" id="mentalite">
            <?php for($n=1; $n <= 100; $n++) : ?>
            <option value="<?php echo $n; ?>" <?php echo $bots->mentalite == $n ? 'selected="selected"' : ''; ?>><?php echo $n; ?></option>
            <?php endfor ?>
          </select>
        </label>
      </div>
      <div class="edit_user">
        <label> Endurance des joueurs :
          <select class="inputbox" name="endurance" id="endurance">
            <?php for($n=1; $n <= 100; $n++) : ?>
            <option value="<?php echo $n; ?>" <?php echo $bots->endurance == $n ? 'selected="selected"' : ''; ?>><?php echo $n; ?></option>
            <?php endfor ?>
          </select>
        </label>
      </div>
    </div>
  </div>
  <div class="content_edit_user" style="float:right;">
    <div class="bloc_user">
      <h2><img src="<?php echo url::base(); ?>images/admin/icone/Information.png" width="32" height="32" align="absmiddle" /> Informations générale</h2>
      <table border="0" cellspacing="0" cellpadding="0" width="100%">
        <tr>
          <td width="80" align="left" valign="top"> <img id="image_football" src="<?php echo url::base(); ?>images/football/<?php echo $bots->image; ?>" class="vignette" style="margin-top:5px;"/></td>
          <td>
            <div class="edit_user"><strong>ID</strong> : <?php echo $bots->id; ?></div>
            <div class="edit_user">
              <label> Nom de l'équipe :
                <input type="text" class="inputbox" name="name" id="name" value="<?php echo $bots->name; ?>" style="width:240px;" />
              </label>
            </div>
             <div class="edit_user">
              <label> Nom de l'équipe (US) :
                <input type="text" class="inputbox" name="name_us" id="name_us" value="<?php echo $bots->name_us; ?>" style="width:240px;" />
              </label>
            </div>
            <div class="edit_user">
              <label> Image :
                <select name="image" id="image" class="inputbox" style="width:240px" onchange="change_image( this.value, 'image_football', 'football')">
                <option value="">Sélectionnez un drapeau</option>
                  <?php
									$dir = DOCROOT.'images/football';
									
									if (is_dir($dir) && $dh = opendir($dir)) 
									{
										while (($file = readdir($dh)) !== false) 
										{                                  
											if( $file != '.' && $file != '..' )
											$array[] = $file;
										}
										closedir($dh);
										sort($array);
										foreach( $array as $file ) 
										{                                  
											$select = $bots->image == $file ? 'selected="selected"' : '';
											echo '<option '.$select.' value="'.$file.'">'.$file.'</option>'."\n";
										}
									}
									?>
                </select>
              </label>
            </div>
            <div class="edit_user">
              <label> Nombre de joueur :
                <select class="inputbox" name="nbr_joueur" id="nbr_joueur">
                  <?php for($n=1; $n <= 20; $n++) : ?>
                  <option value="<?php echo $n; ?>" <?php echo $bots->nbr_joueur == $n ? 'selected="selected"' : ''; ?>><?php echo $n; ?></option>
                  <?php endfor ?>
                </select>
              </label>
            </div>
            <div class="edit_user">
              <label> Nombre de victoire :
                <select class="inputbox" name="victoire" id="victoire">
                  <?php for($n=1; $n <= 300; $n++) : ?>
                  <option value="<?php echo $n; ?>" <?php echo $bots->victoire == $n ? 'selected="selected"' : ''; ?>><?php echo $n; ?></option>
                  <?php endfor ?>
                </select>
              </label>
            </div>
            <div class="edit_user">
              <label> Nombre de défaite :
                <select class="inputbox" name="defaite" id="defaite">
                  <?php for($n=1; $n <= 300; $n++) : ?>
                  <option value="<?php echo $n; ?>" <?php echo $bots->defaite == $n ? 'selected="selected"' : ''; ?>><?php echo $n; ?></option>
                  <?php endfor ?>
                </select>
              </label>
            </div>
            <div class="edit_user">
              <label> Nombre de égalité :
                <select class="inputbox" name="egalite" id="egalite">
                  <?php for($n=1; $n <= 300; $n++) : ?>
                  <option value="<?php echo $n; ?>" <?php echo $bots->egalite == $n ? 'selected="selected"' : ''; ?>><?php echo $n; ?></option>
                  <?php endfor ?>
                </select>
              </label>
            </div>
          </td>
        </tr>
      </table>
    </div>
  </div>
  <div class="spacer"></div>
  <input type="hidden" name="id" id="id" value="<?php echo $bots->id; ?>" />
</form>
