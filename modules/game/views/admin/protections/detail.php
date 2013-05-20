<?php defined('SYSPATH') OR die('No direct access allowed.'); ?>

<form method="post" action="<?php	echo url::base(TRUE);	?>admin/protections/enregistrement">
  <div style="float:left; width:60%">
    <?php Fck_Core::editeur('commentaire_protection', isset( $protection->commentaire_protection ) && $protection->commentaire_protection ? $protection->commentaire_protection : '', '340px'); ?>
  </div>
  <div style="float:right; width:38%">
    <div class="bloc_user">
      <h2><img src="<?php echo url::base(); ?>images/admin/icone/Tools.png" width="32" height="32" align="absmiddle" /> Paramètre de la protection</h2>
      <div class="edit_user"> <?php echo isset( $protection->image_protection ) && $protection->image_protection ? html::image('images/protections/'.$protection->image_protection, array('align' => 'left', 'class' => 'vignette', 'id' => 'image_protection' ) ) : ''; ?>
        <div><strong>ID</strong> : <?php echo $protection->id; ?></div>
        <div><strong>Propriétaire de la protection</strong> : <?php echo $proprietaire ? html::anchor('admin/users/detail/'.$proprietaire->id ,$proprietaire->username) : 'Aucun propriétaire'; ?></div>
        <div class="spacer"></div>
      </div>
      <div class="edit_user">
        <label> Nom du protection :
          <input type="text" class="inputbox" name="name_protection" id="name_protection" value="<?php echo $protection->name_protection; ?>" />
        </label>
      </div>
      <div class="edit_user">
        <label> Défense de la protection :
          <select class="inputbox" name="defense" id="defense">
            <?php for($n=0; $n <= 100; $n++) : ?>
            <option value="<?php echo $n; ?>" <?php echo $protection->defense == $n ? 'selected="selected"' : ''; ?>><?php echo $n; ?></option>
            <?php endfor ?>
          </select>
        </label>
      </div>
      <div class="edit_user">
        <label> Prix de vente :
          <input type="text" class="inputbox" name="prix_protection" id="prix_protection" value="<?php echo $protection->prix_protection; ?>" />
        </label>
      </div>
      <div class="edit_user">
        <label> Niveau minimum pour l'achat :
          <select class="inputbox" name="niveau_protection" id="niveau_protection">
            <?php for($n=0; $n <= 100; $n++) : ?>
            <option value="<?php echo $n; ?>" <?php echo $protection->niveau_protection == $n ? 'selected="selected"' : ''; ?>><?php echo $n; ?></option>
            <?php endfor ?>
          </select>
        </label>
      </div>
      <div class="edit_user">
        <label> Quantité de protection disponible :
          <select class="inputbox" name="quantite" id="quantite">
            <?php for($n=0; $n <= 15; $n++) : ?>
            <option value="<?php echo $n; ?>" <?php echo $protection->quantite == $n ? 'selected="selected"' : ''; ?>><?php echo $n; ?></option>
            <?php endfor ?>
          </select>
        </label>
      </div>
      <div class="edit_user">
        <label> Photo :
          <select name="image_protection" style="width:240px" id="image_protection" class="inputbox" onchange="change_image( this.value, 'image_protection', 'protections')">
            <?php
						$dir = DOCROOT.'images/protections';
						
						if (is_dir($dir) && $dh = opendir($dir)) 
						{
							while (($file = readdir($dh)) !== false) 
							{                                  
								if( $file != '.' && $file != '..' )
								{
									$select = $protection->image_protection == $file ? 'selected="selected"' : '';
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
  <input type="hidden" name="id" id="id" value="<?php echo $protection->id; ?>" />
</form>
<div class="spacer"></div>
