<?php defined('SYSPATH') OR die('No direct access allowed.'); ?>

<form method="post" action="<?php	echo url::base(TRUE);	?>admin/gangs/enregistrement">
  <div style="float:left; width:60%">
    <?php Fck_Core::editeur('commentaire_gang', isset( $gang->commentaire_gang ) && $gang->commentaire_gang ? $gang->commentaire_gang : '', '490px'); ?>
  </div>
  <div style="float:right; width:38%">
    <div class="bloc_user">
      <h2><img src="<?php echo url::base(); ?>images/admin/icone/Tools.png" width="32" height="32" align="absmiddle" /> Paramètre du gang</h2>
      <div class="edit_user"> <?php echo isset( $gang->image_gang ) && $gang->image_gang ? html::image('images/gang/'.$gang->image_gang, array('align' => 'left', 'class' => 'vignette', 'id' => 'image_gang' ) ) : ''; ?>
        <div><strong>ID</strong> : <?php echo $gang->id; ?></div>
        <div><strong>Argent</strong> : <?php echo isset( $argent ) && $argent ? number_format( $argent ) : 0; ?> $</div>
        <div><strong>Chef du gang</strong> : <?php echo isset( $chef ) ? $chef : 'Aucun chef'; ?></div>
        <div><strong>Nombre de gangster</strong> : <?php echo isset( $nbr_users ) ? number_format( $nbr_users ) : 0; ?></div>
        <div class="spacer"></div>
      </div>
      <div class="edit_user">
        <label> Nom du gang :
          <input type="text" class="inputbox" name="nom_gang" id="nom_gang" value="<?php echo $gang->nom_gang; ?>" style="width:245px;" />
        </label>
      </div>
      <div class="edit_user">
        <label> Blason du gang :
          <select name="image_gang" id="image_gang" class="inputbox" onchange="change_image( this.value, 'image_gang', 'gang')">
            <?php
						$dir = DOCROOT.'images/gang';
						
						if (is_dir($dir) && $dh = opendir($dir)) 
						{
							while (($file = readdir($dh)) !== false) 
							{                                  
								if( $file != '.' && $file != '..' )
								{
									$select = $gang->image_gang == $file ? 'selected="selected"' : '';
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
        <label> Couleur :
          <input type="text" id="couleur_gang" name="couleur_gang" class="inputbox" value="<?php echo $gang->couleur_gang; ?>" />
        </label>
      </div>
      <div class="edit_user">
        <div id="colorpicker"></div>
      </div>
    </div>
  </div>
  <input type="hidden" name="id" id="id" value="<?php echo $gang->id; ?>" />
</form>
<div class="spacer"></div>
<h2><img src="<?php echo url::base(); ?>images/admin/icone/User.png" width="32" height="32" align="absmiddle" /> Liste des joueurs qui font partie du gang</h2>
<?php echo isset( $users ) && $users ? $users : 'Aucun joueur'; ?> 