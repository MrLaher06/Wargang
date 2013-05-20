<?php defined('SYSPATH') OR die('No direct access allowed.'); ?>

<form method="post" action="<?php	echo url::base(TRUE);	?>admin/partie/enregistrement">
  <h2><img src="<?php echo url::base(); ?>images/admin/icone/Tools.png" width="32" height="32" align="absmiddle" /> Paramètre de la partie</h2>
  <div style="float:left; width:50%">
    <div class="edit_user">
      <label> Slogan des vainqueurs :
        <textarea name="slogan_gang" rows="7" class="inputbox" id="slogan_gang" style="width:300px;"><?php echo $partie->slogan_gang; ?></textarea>
      </label>
    </div>
    <div class="edit_user">
      <label> Joueur dehors lors de la victoire :
        <input type="text" class="inputbox" name="user_actif" id="user_actif" value="<?php echo $partie->user_actif; ?>" style="width:100px;" />
      </label>
    </div>
    <div class="edit_user">
      <label> Nombre d'inscrits lors de la victoire :
        <input type="text" class="inputbox" name="total_user" id="total_user" value="<?php echo $partie->total_user; ?>" style="width:100px;" />
      </label>
    </div>
    <div class="edit_user">
      <label> Argent total sur War Gang lors de la victoire :
        <input type="text" class="inputbox" name="argent_total" id="argent_total" value="<?php echo $partie->argent_total; ?>" style="width:100px;" />
      </label>
    </div>
    <div class="edit_user">
      <label> Drogue total en circulation sur War Gang lors de la victoire :
        <input type="text" class="inputbox" name="drogue_total" id="drogue_total" value="<?php echo $partie->drogue_total; ?>" style="width:100px;" />
      </label>
    </div>
    <div class="edit_user">
      <label> Nombre de flic pendant la partie :
        <input type="text" class="inputbox" name="flic_total" id="flic_total" value="<?php echo $partie->flic_total; ?>" style="width:100px;" />
      </label>
    </div>
  </div>
  <div style="float:right; width:48%">
    <div class="edit_user">
    <?php echo isset( $partie->image_gang ) && $partie->image_gang ? html::image('images/gang/'.$partie->image_gang, array('align' => 'left', 'class' => 'vignette', 'id' => 'image_gang' ) ) : ''; ?> 
    <strong>ID</strong> : <?php echo $partie->id; ?></div>
    <div  class="edit_user">
      <label> En cours :
        <select class="inputbox" name="en_cours_partie" id="en_cours_partie">
          <option value="0" >Non</option>
          <option value="1" <?php echo $partie->en_cours_partie ? 'selected="selected"' : ''; ?>>Oui</option>
        </select>
      </label>
    </div>
    <div  class="edit_user">
      <label> Blason du gang :
        <select name="image_gang" id="image_gang" class="inputbox" onchange="change_image( this.value, 'image_gang', 'gang')" >
          <?php
						$dir = DOCROOT.'images/gang';
						
						if (is_dir($dir) && $dh = opendir($dir)) 
						{
							while (($file = readdir($dh)) !== false) 
							{                                  
								if( $file != '.' && $file != '..' )
								{
									$select = $partie->image_gang == $file ? 'selected="selected"' : '';
									echo '<option '.$select.' value="'.$file.'">'.$file.'</option>'."\n";
								}
							}
							closedir($dh);
						}
						?>
        </select>
      </label>
    </div>
    <div class="edit_user">
      <label> Date de début :
        <input type="text" class="inputbox" name="date_debut_partie" id="date_debut_partie" value="<?php echo $partie->date_debut_partie; ?>" style="width:200px;" />
      </label>
    </div>
    <div class="edit_user">
      <label> Date de fin :
        <input type="text" class="inputbox" name="date_fin_partie" id="date_fin_partie" value="<?php echo $partie->date_fin_partie; ?>" style="width:200px;" />
      </label>
    </div>
    <div class="edit_user">
      <label> Liste des vainqueurs :
        <input type="text" class="inputbox" name="liste_users_victoire" id="liste_users_victoire" value="<?php echo $partie->liste_users_victoire; ?>" style="width:300px;" />
      </label>
    </div>
    <div class="edit_user">
      <label> Gang des vainqueurs :
        <input type="text" class="inputbox" name="gang_victoire" id="gang_victoire" value="<?php echo $partie->gang_victoire; ?>" style="width:100px;" />
      </label>
    </div>
    <div class="edit_user">
      <label> Argent des vainqueurs :
        <input type="text" class="inputbox" name="argent_victoire" id="argent_victoire" value="<?php echo $partie->argent_victoire; ?>" style="width:100px;" />
      </label>
    </div>
    <input type="hidden" name="id" id="id" value="<?php echo $partie->id; ?>" />
  </div>
</form>
<div class="spacer"></div>
