<?php defined('SYSPATH') OR die('No direct access allowed.'); ?>

<form method="post" action="<?php	echo url::base(TRUE);	?>admin/vehicules/enregistrement">
  <div style="float:left; width:60%">
    <?php Fck_Core::editeur('commentaire_vehicule', isset( $vehicule->commentaire_vehicule ) && $vehicule->commentaire_vehicule ? $vehicule->commentaire_vehicule : '', '420px'); ?>
  </div>
  <div style="float:right; width:38%">
    <div class="bloc_user">
      <h3>Paramètre du véhicule</h3>
      <div class="edit_user"> <?php echo isset( $vehicule->image_vehicule ) && $vehicule->image_vehicule ? html::image('images/voitures/'.$vehicule->image_vehicule, array('align' => 'left', 'class' => 'vignette', 'id' => 'image_vehicule' ) ) : ''; ?>
        <div><strong>ID</strong> : <?php echo $vehicule->id; ?></div>
        <div><strong>Propriétaire de l'arme</strong> : <?php echo $proprietaire ? html::anchor('admin/users/detail/'.$proprietaire->id ,$proprietaire->username) : 'Aucun propriétaire'; ?></div>
        <div class="spacer"></div>
      </div>
      <div class="edit_user">
        <label> Nom de l'vehicule :
          <input type="text" class="inputbox" name="name_vehicule" id="name_vehicule" value="<?php echo $vehicule->name_vehicule; ?>" />
        </label>
      </div>
      <div class="edit_user">
        <label> Réservoir du l'vehicule :
          <select class="inputbox" name="reservoir" id="reservoir">
            <?php for($n=0; $n <= 100; $n++) : ?>
            <option value="<?php echo $n; ?>" <?php echo $vehicule->reservoir == $n ? 'selected="selected"' : ''; ?>><?php echo $n; ?></option>
            <?php endfor ?>
          </select>
        </label>
      </div>
      <div class="edit_user">
        <label> Déplacement du l'vehicule :
          <select class="inputbox" name="deplacement" id="deplacement">
            <?php for($n=10; $n <= 120; $n++) : ?>
            <option value="<?php echo $n; ?>" <?php echo $vehicule->deplacement == $n ? 'selected="selected"' : ''; ?>><?php echo $n; ?></option>
            <?php endfor ?>
          </select>
        </label>
      </div>
      <div class="edit_user">
        <label> Etat du l'vehicule :
          <select class="inputbox" name="etat_vehicule" id="etat_vehicule">
            <?php for($n=0; $n <= 100; $n++) : ?>
            <option value="<?php echo $n; ?>" <?php echo $vehicule->etat_vehicule == $n ? 'selected="selected"' : ''; ?>><?php echo $n; ?></option>
            <?php endfor ?>
          </select>
        </label>
      </div>
      <div class="edit_user">
        <label> Prix de vente :
          <input type="text" class="inputbox" name="prix_vehicule" id="prix_vehicule" value="<?php echo $vehicule->prix_vehicule; ?>" />
        </label>
      </div>
      <div class="edit_user">
        <label> Niveau minimum pour l'achat :
          <select class="inputbox" name="niveau_vehicule" id="niveau_vehicule">
            <?php for($n=0; $n <= 100; $n++) : ?>
            <option value="<?php echo $n; ?>" <?php echo $vehicule->niveau_vehicule == $n ? 'selected="selected"' : ''; ?>><?php echo $n; ?></option>
            <?php endfor ?>
          </select>
        </label>
      </div>
      <div class="edit_user">
        <label> Quantité de véhicule disponible :
          <select class="inputbox" name="quantite" id="quantite">
            <?php for($n=0; $n <= 15; $n++) : ?>
            <option value="<?php echo $n; ?>" <?php echo $vehicule->quantite == $n ? 'selected="selected"' : ''; ?>><?php echo $n; ?></option>
            <?php endfor ?>
          </select>
        </label>
      </div>
      <div class="edit_user">
        <label> Disponible dans le bâtiment :
          <select class="inputbox" name="id_batiment" id="id_batiment">
            <option value="0" >Aucun bâtiment</option>
            <?php foreach($batiments as $val) : ?>
            <option value="<?php echo $val->id; ?>" <?php echo $vehicule->id_batiment == $val->id ? 'selected="selected"' : ''; ?>><?php echo $val->nom; ?></option>
            <?php endforeach ?>
          </select>
        </label>
      </div>
      <div class="edit_user">
        <label> Uniquement pour la police
          <select class="inputbox" name="police" id="police">
            <option value="0" >Non</option>
            <option value="1" <?php echo $vehicule->police ? 'selected="selected"' : ''; ?>>Oui</option>
          </select>
        </label>
      </div>
      <div class="edit_user">
        <label> Photo :
          <select name="image_vehicule" style="width:240px" id="image_vehicule" class="inputbox" onchange="change_image( this.value, 'image_vehicule', 'voitures')">
            <?php
						$dir = DOCROOT.'images/voitures';
						
						if (is_dir($dir) && $dh = opendir($dir)) 
						{
							while (($file = readdir($dh)) !== false) 
							{                                  
								if( $file != '.' && $file != '..' )
								{
									$select = $vehicule->image_vehicule == $file ? 'selected="selected"' : '';
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
  <input type="hidden" name="id" id="id" value="<?php echo $vehicule->id; ?>" />
</form>
<div class="spacer"></div>
