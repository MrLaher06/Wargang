<?php defined('SYSPATH') OR die('No direct access allowed.'); ?>
<form method="post" action="<?php	echo url::base(TRUE);	?>admin/carte/enregistrement">
  <div style="float:left; width:60%">
    <?php Fck_Core::editeur('commentaire', isset( $carte->commentaire ) && $carte->commentaire ? $carte->commentaire : '', '420px'); ?>
  </div>
  <div style="float:right; width:38%">
    <div class="bloc_user">
      <h2><img src="<?php echo url::base(); ?>images/admin/icone/Tools.png" width="32" height="32" align="absmiddle" /> Paramètre de la carte</h2>
      <div class="edit_user">
        <?php echo isset( $carte->image ) && $carte->image ? html::image('images/batiments/'.$carte->image, array('align' => 'left', 'class' => 'vignette', 'id' => 'image_carte' ) ) : ''; ?>
        <div><strong>ID</strong> : <?php echo $carte->id; ?></div>
        <div><strong>Propriétaire</strong> : <?php echo $carte->proprio ? $carte->proprio : 'Aucun propriétaire'; ?></div>
     		<div><strong>Dernier braquage</strong> : <?php echo date::convertir_date( time() - $carte->timer ); ?></div>
        <div class="spacer"></div>
      </div>
      <div class="edit_user">
        <label> Nom de la carte :
          <input type="text" class="inputbox" name="nom" id="nom" value="<?php echo $carte->nom; ?>" />
        </label>
      </div>
      <div class="edit_user">
        <label> Option du bâtiment :
          <select class="inputbox" name="type_option" id="type_option">
            <option value="papier" <?php echo $carte->type_option == 'papier' ? 'selected="selected"' : ''; ?>>papier</option>
            <option value="vehicule" <?php echo $carte->type_option == 'vehicule' ? 'selected="selected"' : ''; ?>>vehicule</option>
            <option value="banque" <?php echo $carte->type_option == 'banque' ? 'selected="selected"' : ''; ?>>banque</option>
            <option value="mafia" <?php echo $carte->type_option == 'mafia' ? 'selected="selected"' : ''; ?>>mafia</option>
            <option value="arme" <?php echo $carte->type_option == 'arme' ? 'selected="selected"' : ''; ?>>arme</option>
            <option value="victoire" <?php echo $carte->type_option == 'victoire' ? 'selected="selected"' : ''; ?>>victoire</option>
            <option value="autoroute" <?php echo $carte->type_option == 'autoroute' ? 'selected="selected"' : ''; ?>>autoroute</option>
            <option value="parking" <?php echo $carte->type_option == 'parking' ? 'selected="selected"' : ''; ?>>parking</option>
            <option value="penitencier" <?php echo $carte->type_option == 'penitencier' ? 'selected="selected"' : ''; ?>>penitencier</option>
            <option value="hospital" <?php echo $carte->type_option == 'hospital' ? 'selected="selected"' : ''; ?>>hospital</option>
            <option value="commissariat" <?php echo $carte->type_option == 'commissariat' ? 'selected="selected"' : ''; ?>>commissariat</option>
            <option value="protection" <?php echo $carte->type_option == 'protection' ? 'selected="selected"' : ''; ?>>protection</option>
            <option value="casino" <?php echo $carte->type_option == 'casino' ? 'selected="selected"' : ''; ?>>casino</option>
            <option value="sport" <?php echo $carte->type_option == 'sport' ? 'selected="selected"' : ''; ?>>sport</option>
            <option value="musique" <?php echo $carte->type_option == 'musique' ? 'selected="selected"' : ''; ?>>musique</option>
          </select>
        </label>
      </div>
      <div class="edit_user">
        <label> Position horizontal (x) :
          <select class="inputbox" name="x" id="x">
            <?php for($n=1; $n <= Kohana::config( 'carte.taille_carte' ); $n++) : ?>
            <option value="<?php echo $n; ?>" <?php echo $carte->x == $n ? 'selected="selected"' : ''; ?>><?php echo $n; ?></option>
            <?php endfor ?>
          </select>
        </label>
      </div>
      <div class="edit_user">
        <label> Position vertical (y) :
          <select class="inputbox" name="y" id="y">
            <?php for($n=1; $n <= Kohana::config( 'carte.taille_carte' ); $n++) : ?>
            <option value="<?php echo $n; ?>" <?php echo $carte->y == $n ? 'selected="selected"' : ''; ?>><?php echo chr($n + 64); ?></option>
            <?php endfor ?>
          </select>
        </label>
      </div>
      <div class="edit_user">
        <label> Coffre :
            <input type="text" class="inputbox" name="coffre" id="coffre" value="<?php echo $carte->coffre; ?>" />
        </label>
      </div>
      <div class="edit_user">
        <label> Prix à l'achat :
            <input type="text" class="inputbox" name="prix_achat" id="prix_achat" value="<?php echo $carte->prix_achat; ?>" />
        </label>
      </div>
      <div class="edit_user">
        <label> Protection contre le braquage :
          <input type="text" class="inputbox" name="protection" id="protection" value="<?php echo $carte->protection; ?>" />
        </label>
      </div>
      <div class="edit_user">
        <label> Timer (0 pour tout initialiser) :
           <input type="text" class="inputbox" name="timer" id="timer" value="<?php echo $carte->timer; ?>" />
        </label>
      </div>
       <div class="edit_user">
        <label> Photo :
          <select name="image" id="image" class="inputbox" onchange="change_image( this.value, 'image_carte', 'batiments')">
            <?php
						$dir = DOCROOT.'images/batiments';
						
						if (is_dir($dir) && $dh = opendir($dir)) 
						{
							while (($file = readdir($dh)) !== false) 
							{                                  
								if( $file != '.' && $file != '..' )
								{
									$select = $carte->image == $file ? 'selected="selected"' : '';
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
  <input type="hidden" name="id" id="id" value="<?php echo $carte->id; ?>" />
</form>
<div class="spacer"></div>
