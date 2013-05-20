<?php defined('SYSPATH') OR die('No direct access allowed.'); ?>

<form method="post" action="<?php	echo url::base(TRUE);	?>admin/drogues/enregistrement">
  <div style="float:left; width:60%">
    <?php Fck_Core::editeur('description', isset( $drogue->description ) && $drogue->description ? $drogue->description : '', '340px'); ?>
  </div>
  <div style="float:right; width:38%">
    <div class="bloc_user">
      <h2><img src="<?php echo url::base(); ?>images/admin/icone/Tools.png" width="32" height="32" align="absmiddle" /> Paramètre de la drogue</h2>
      <div class="edit_user">
        <?php echo isset( $drogue->image ) && $drogue->image ? html::image('images/drogues/'.$drogue->image, array('align' => 'left', 'class' => 'vignette', 'id' => 'image_drogue' ) ) : ''; ?>
        <div><strong>ID</strong> : <?php echo $drogue->id; ?></div>
        <div><strong>Nombre en circulation</strong> : <?php echo $nbr_en_vente; ?></div>
        <div class="spacer"></div>
      </div>
      <div class="edit_user">
        <label> Nom de la drogue :
          <input type="text" class="inputbox" name="name" id="name" value="<?php echo $drogue->name; ?>" />
        </label>
      </div>
      <div class="edit_user">
        <label> Prix de vente :
            <input type="text" class="inputbox" name="prix" id="prix" value="<?php echo $drogue->prix; ?>" />
        </label>
      </div>
      <div class="edit_user">
        <label> Niveau pour acheter :
          <select class="inputbox" name="niveau" id="niveau">
            <?php for($n=0; $n <= 100; $n++) : ?>
            <option value="<?php echo $n; ?>" <?php echo $drogue->niveau == $n ? 'selected="selected"' : ''; ?>><?php echo $n; ?></option>
            <?php endfor ?>
          </select>
        </label>
      </div>
      
      <div class="edit_user">
        <label> Autorisé par la Loi :
          <select class="inputbox" name="autoriser" id="autoriser">
            <option value="0" class="rouge" >Non</option>
            <option value="1" class="vert" <?php echo $drogue->autoriser ? 'selected="selected"' : ''; ?>>Oui</option>
          </select>
        </label>
      </div>
       <div class="edit_user">
        <label> Photo :
          <select name="image" id="image" class="inputbox" onchange="change_image( this.value, 'image_drogue', 'drogues')">
            <?php
						$dir = DOCROOT.'images/drogues';
						
						if (is_dir($dir) && $dh = opendir($dir)) 
						{
							while (($file = readdir($dh)) !== false) 
							{                                  
								if( $file != '.' && $file != '..' )
								{
									$select = $drogue->image == $file ? 'selected="selected"' : '';
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
  <input type="hidden" name="id" id="id" value="<?php echo $drogue->id; ?>" />
</form>
<div class="spacer"></div>
