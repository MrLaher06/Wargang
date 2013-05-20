<?php defined('SYSPATH') OR die('No direct access allowed.'); ?>

<form method="post" action="<?php	echo url::base(TRUE);	?>admin/armes/enregistrement">
  <div style="float:left; width:60%">
    <?php Fck_Core::editeur('commentaire_arme', isset( $arme->commentaire_arme ) && $arme->commentaire_arme ? $arme->commentaire_arme : '', '420px'); ?>
  </div>
  <div style="float:right; width:38%">
    <div class="bloc_user">
      <h2><img src="<?php echo url::base(); ?>images/admin/icone/Tools.png" width="32" height="32" align="absmiddle" /> Paramètre de l'arme</h2>
      <div class="edit_user"> <?php echo isset( $arme->image_arme ) && $arme->image_arme ? html::image('images/armes/'.$arme->image_arme, array('align' => 'left', 'class' => 'vignette', 'id' => 'image_arme' ) ) : ''; ?>
        <div><strong>ID</strong> : <?php echo $arme->id; ?></div>
        <div><strong>Propriétaire de l'arme</strong> : <?php echo $proprietaire ? html::anchor('admin/users/detail/'.$proprietaire->id ,$proprietaire->username) : 'Aucun propriétaire'; ?></div>
        
        <div class="spacer"></div>
      </div>
      <div class="edit_user">
        <label> Nom de l'arme :
          <input type="text" class="inputbox" name="name_arme" id="name_arme" value="<?php echo $arme->name_arme; ?>" />
        </label>
      </div>
      <div class="edit_user">
        <label> Attaque de l'arme :
          <select class="inputbox" name="attaque" id="attaque">
            <?php for($n=0; $n <= 100; $n++) : ?>
            <option value="<?php echo $n; ?>" <?php echo $arme->attaque == $n ? 'selected="selected"' : ''; ?>><?php echo $n; ?></option>
            <?php endfor ?>
          </select>
        </label>
      </div>
      <div class="edit_user">
        <label> Précision de l'arme :
          <select class="inputbox" name="precision" id="precision">
            <?php for($n=0; $n <= 100; $n++) : ?>
            <option value="<?php echo $n; ?>" <?php echo $arme->precision == $n ? 'selected="selected"' : ''; ?>><?php echo $n; ?></option>
            <?php endfor ?>
          </select>
        </label>
      </div>
      <div class="edit_user">
        <label> Prix de vente :
          <input type="text" class="inputbox" name="prix_arme" id="prix_arme" value="<?php echo $arme->prix_arme; ?>" />
        </label>
      </div>
      <div class="edit_user">
        <label> Niveau minimum pour l'achat :
          <select class="inputbox" name="niveau_arme" id="niveau_arme">
            <?php for($n=0; $n <= 100; $n++) : ?>
            <option value="<?php echo $n; ?>" <?php echo $arme->niveau_arme == $n ? 'selected="selected"' : ''; ?>><?php echo $n; ?></option>
            <?php endfor ?>
          </select>
        </label>
      </div>
      <div class="edit_user">
        <label> Munitions de l'arme :
          <select class="inputbox" name="munition_arme" id="munition_arme">
            <?php for($n=0; $n <= 100; $n++) : ?>
            <option value="<?php echo $n; ?>" <?php echo $arme->munition_arme == $n ? 'selected="selected"' : ''; ?>><?php echo $n; ?></option>
            <?php endfor ?>
          </select>
        </label>
      </div>
      <div class="edit_user">
        <label> Prix des munitions :
          <input type="text" class="inputbox" name="prix_munition" id="prix_munition" value="<?php echo $arme->prix_munition; ?>" />
        </label>
      </div>
      <div class="edit_user">
        <label> Quantité d'arme disponible :
          <select class="inputbox" name="quantite" id="quantite">
            <?php for($n=0; $n <= 15; $n++) : ?>
            <option value="<?php echo $n; ?>" <?php echo $arme->quantite == $n ? 'selected="selected"' : ''; ?>><?php echo $n; ?></option>
            <?php endfor ?>
          </select>
        </label>
      </div>
      <div class="edit_user">
        <label> Photo :
          <select name="image_arme" id="image_arme" style="width:240px" class="inputbox" onchange="change_image( this.value, 'image_arme', 'armes')">
            <?php
						$dir = DOCROOT.'images/armes';
						
						if (is_dir($dir) && $dh = opendir($dir)) 
						{
							while (($file = readdir($dh)) !== false) 
							{                                  
								if( $file != '.' && $file != '..' )
								{
									$select = $arme->image_arme == $file ? 'selected="selected"' : '';
									echo '<option '.$select.' value="'.$file.'">'.$file.'</option>'."\n";
								}
							}
							closedir($dh);
						}
						?>
          </select>
        </label>
      </div>
    </div>
  </div>
  <input type="hidden" name="id" id="id" value="<?php echo $arme->id; ?>" />
</form>
<div class="spacer"></div>
