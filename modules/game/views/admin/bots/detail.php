<?php defined('SYSPATH') OR die('No direct access allowed.'); ?>

<form method="post" action="<?php	echo url::base(TRUE);	?>admin/bots/enregistrement">
  <div class="content_edit_user" style="float:left;">
    <div class="bloc_user">
      <h2><img src="<?php echo url::base(); ?>images/admin/icone/Information.png" width="32" height="32" align="absmiddle" /> Informations générale</h2>
      <table border="0" cellspacing="0" cellpadding="0" width="100%">
        <tr>
          <td width="80"> <img id="image_bot" src="<?php echo url::base(); ?>images/bots/<?php echo $bots->image; ?>" class="vignette" style="margin-top:5px;"/></td>
          <td>
            <div class="edit_user"><strong>ID</strong> : <?php echo $bots->id; ?></div>
            <div class="edit_user">
              <label> Nom :
                <input type="text" class="inputbox" name="nom" id="nom" value="<?php echo $bots->nom; ?>" style="width:240px;" />
              </label>
            </div>
            <div class="edit_user">
              <label> Sa photo :
                <select name="image" id="image" style="width:240px" class="inputbox" onchange="change_image( this.value, 'image_bot', 'bots')">
                  <?php
									$dir = DOCROOT.'images/bots';
									
									if (is_dir($dir) && $dh = opendir($dir)) 
									{
										while (($file = readdir($dh)) !== false) 
										{                                  
											if( $file != '.' && $file != '..' )
											{
												$select = $bots->image == $file ? 'selected="selected"' : '';
												echo '<option '.$select.' value="'.$file.'">'.$file.'</option>'."\n";
											}
										}
										closedir($dh);
									}
									?>
                </select>
              </label>
            </div>
          </td>
        </tr>
      </table>
      <div class="edit_user">
        <label> Sexe
          <select class="inputbox" name="sexe" id="sexe">
            <option value="Femme" <?php echo $bots->sexe == 'Femme' ? 'selected="selected"' : ''; ?>>Femme</option>
            <option value="Homme" <?php echo $bots->sexe == 'Homme' ? 'selected="selected"' : ''; ?>>Homme</option>
          </select>
        </label>
      </div>
      <div class="edit_user">
        <label> Commentaire :
          <textarea name="commentaire"  id="commentaire" class="inputbox" rows="5" cols="40"><?php echo $bots->commentaire; ?></textarea>
        </label>
      </div>
      <div class="edit_user">
        <label> Position horizontal (x) :
          <select class="inputbox" name="x" id="x">
            <?php for($n=0; $n <= Kohana::config( 'carte.taille_carte' ); $n++) : ?>
            <option value="<?php echo $n; ?>" <?php echo $bots->x == $n ? 'selected="selected"' : ''; ?>><?php echo $n; ?></option>
            <?php endfor ?>
          </select>
        </label>
      </div>
      <div class="edit_user">
        <label> Position vertical (y) :
          <select class="inputbox" name="y" id="y">
            <?php for($n=0; $n <= Kohana::config( 'carte.taille_carte' ); $n++) : ?>
            <option value="<?php echo $n; ?>" <?php echo $bots->y == $n ? 'selected="selected"' : ''; ?>><?php echo $n; ?></option>
            <?php endfor ?>
          </select>
        </label>
      </div>
      <div class="edit_user">
        <label> Nombre de HP :
          <select class="inputbox" name="hp" id="hp">
            <?php for($n=0; $n <= 100; $n++) : ?>
            <option value="<?php echo $n; ?>" <?php echo $bots->hp == $n ? 'selected="selected"' : ''; ?>><?php echo $n; ?></option>
            <?php endfor ?>
          </select>
        </label>
      </div>
      <div class="edit_user">
        <label> Niveau :
          <select class="inputbox" name="niveau" id="niveau">
            <?php for($n=0; $n <= 100; $n++) : ?>
            <option value="<?php echo $n; ?>" <?php echo $bots->niveau == $n ? 'selected="selected"' : ''; ?>><?php echo $n; ?></option>
            <?php endfor ?>
          </select>
        </label>
      </div>
      <div class="edit_user">
        <label> Nombre de XP :
          <input type="text" class="inputbox" name="xp" id="xp" value="<?php echo $bots->xp; ?>" />
        </label>
      </div>
      <div class="edit_user">
        <label> Argent en poche :
          <input type="text" class="inputbox" name="argent" id="argent" value="<?php echo $bots->argent; ?>" />
        </label>
      </div>
    </div>
  </div>
  <div class="content_edit_user" style="float:right;">
    <div class="bloc_user">
      <h2><img src="<?php echo url::base(); ?>images/admin/icone/Bomb.png" width="32" height="32" align="absmiddle" /> Arme <div class="lien"> <div class="lien"><?php echo html::anchor('admin/armes/detail/'.$bots->id_arme, '(Voir la fiche)'); ?></div></div></h2>
      <?php $bots->image_arme = $bots->image_arme ? $bots->image_arme : 'aucune.jpg'; ?>
      <table border="0" cellspacing="0" cellpadding="0" width="100%">
        <tr valign="top">
          <td width="60"><img id="image_arme" src="<?php echo url::base(); ?>images/armes/<?php echo $bots->image_arme; ?>" class="vignette" style="height:40px; margin-top:5px;"/></td>
          <td>
            <div class="edit_user">
              <label> Nom de l'arme :
                <select class="inputbox" name="id_arme" id="id_arme">
                  <option value="0">Aucune</option>
                  <?php foreach( $armes as $val ) : ?>
                  <option value="<?php echo $val->id; ?>" <?php echo $bots->id_arme == $val->id ? 'selected="selected"' : ''; ?>><?php echo $val->name_arme; ?> (<?php echo $val->munition_arme; ?>)</option>
                  <?php endforeach ?>
                </select>
              </label>
            </div>
            <div class="edit_user">
              <label> Munition de l'arme :
                <select class="inputbox" name="munition" id="munition">
                  <?php for($n=0; $n <= 100; $n++) : ?>
                  <option value="<?php echo $n; ?>" <?php echo $bots->munition == $n ? 'selected="selected"' : ''; ?>><?php echo $n; ?></option>
                  <?php endfor ?>
                </select>
              </label>
            </div>
          </td>
        </tr>
      </table>
      <hr/>
      <h2><img src="<?php echo url::base(); ?>images/admin/icone/Toxic.png" width="32" height="32"  align="absmiddle" /> Protection <div class="lien"> <div class="lien"><?php echo html::anchor('admin/protections/detail/'.$bots->id_protection, '(Voir la fiche)'); ?></div></div></h2>
      <?php $bots->image_protection = $bots->image_protection ? $bots->image_protection : 'aucune.jpg'; ?>
      <table border="0" cellspacing="0" cellpadding="0" width="100%">
        <tr valign="top">
          <td width="60"><img id="image_protection" src="<?php echo url::base(); ?>images/protections/<?php echo $bots->image_protection; ?>" class="vignette" style="height:40px; margin-top:5px;"/></td>
          <td>
            <div class="edit_user">
              <label> Nom de la protection :
                <select class="inputbox" name="id_protection" id="id_protection">
                  <option value="0">Aucune</option>
                  <?php foreach( $protections as $val ) : ?>
                  <option value="<?php echo $val->id; ?>" <?php echo $bots->id_protection == $val->id ? 'selected="selected"' : ''; ?>><?php echo $val->name_protection; ?></option>
                  <?php endforeach ?>
                </select>
              </label>
            </div>
            <div class="edit_user">
              <label> Etat de la protection :
                <select class="inputbox" name="etat_protection" id="etat_protection">
                  <?php for($n=0; $n <= 100; $n++) : ?>
                  <option value="<?php echo $n; ?>" <?php echo $bots->etat_protection == $n ? 'selected="selected"' : ''; ?>><?php echo $n; ?></option>
                  <?php endfor ?>
                </select>
              </label>
            </div>
          </td>
        </tr>
      </table>
      <hr/>
      <h2><img src="<?php echo url::base(); ?>images/admin/icone/Car.png" width="32" height="32"  align="absmiddle" /> Véhicule <div class="lien"><?php echo html::anchor('admin/vehicules/detail/'.$bots->id_vehicule, '(Voir la fiche)'); ?></div></h2>
      <?php $bots->image_vehicule = $bots->image_vehicule ? $bots->image_vehicule : 'aucune.jpg'; ?>
      <table border="0" cellspacing="0" cellpadding="0" width="100%">
        <tr valign="top">
          <td width="60"><img id="image_vehicule" src="<?php echo url::base(); ?>images/voitures/<?php echo $bots->image_vehicule; ?>" class="vignette" style="height:40px; margin-top:5px;"/></td>
          <td>
            <div class="edit_user">
              <label> Nom du véhicule :
                <select class="inputbox" name="id_vehicule" id="id_vehicule">
                  <option value="0">Aucun</option>
                  <?php foreach( $vehicules as $val ) : ?>
                  <option value="<?php echo $val->id; ?>" <?php echo $bots->id_vehicule == $val->id ? 'selected="selected"' : ''; ?>><?php echo $val->name_vehicule; ?></option>
                  <?php endforeach ?>
                </select>
              </label>
            </div>
            <div class="edit_user">
              <label> Réservoir du véhicule :
                <select class="inputbox" name="reservoir" id="reservoir">
                  <?php for($n=0; $n <= 200; $n++) : ?>
                  <option value="<?php echo $n; ?>" <?php echo $bots->reservoir == $n ? 'selected="selected"' : ''; ?>><?php echo $n; ?></option>
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
