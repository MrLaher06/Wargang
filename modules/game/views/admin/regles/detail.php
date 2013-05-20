<?php defined('SYSPATH') OR die('No direct access allowed.'); ?>

<form method="post" action="<?php	echo url::base(TRUE);	?>admin/regles/enregistrement">
  <div style="float:left; width:60%">
    <?php Fck_Core::editeur('texte', isset( $regles->texte ) && $regles->texte ? $regles->texte : '', '420px'); ?>
  </div>
  <div style="float:right; width:38%">
    <div class="bloc_user">
      <h2><img src="<?php echo url::base(); ?>images/admin/icone/Tools.png" width="32" height="32" align="absmiddle" /> Paramètre de la règle</h2>
      <div class="edit_user"><?php echo isset( $regles->image ) && $regles->image ? html::image('images/aide/'.$regles->image, array('align' => 'left', 'class' => 'vignette', 'id' => 'image_regle' ) ) : ''; ?><strong>ID</strong> : <?php echo $regles->id; ?></div>
      <div class="edit_user">
        <label> Titre de la règle :
          <input type="text" class="inputbox" name="titre" id="titre" value="<?php echo $regles->titre; ?>" style="width:245px;" />
        </label>
      </div>
      <div class="edit_user">
        <label> Langue de la règle :
          <select class="inputbox" name="lang" id="lang">
            <option value="fr_FR" <?php echo $regles->lang == 'fr_FR' ? 'selected="selected"' : ''; ?>>Fance</option>
            <option value="en_EN" <?php echo $regles->lang == 'en_EN' ? 'selected="selected"' : ''; ?>>English</option>
          </select>
        </label>
      </div>
      <div class="edit_user">
        <label> Icone de la règle :
          <select name="image" id="image" class="inputbox" onchange="change_image( this.value, 'image_regle', 'aide')">
            <?php
						$dir = DOCROOT.'images/aide';
						
						if (is_dir($dir) && $dh = opendir($dir)) 
						{
							while (($file = readdir($dh)) !== false) 
							{                                  
								if( $file != '.' && $file != '..' )
								{
									$select = $regles->image == $file ? 'selected="selected"' : '';
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
  <input type="hidden" name="id" id="id" value="<?php echo $regles->id; ?>" />
  <input type="hidden" name="date" id="date" value="<?php echo date::NOW(); ?>" />
</form>
<div class="spacer"></div>
