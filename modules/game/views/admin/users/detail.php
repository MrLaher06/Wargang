<?php defined('SYSPATH') OR die('No direct access allowed.'); ?>
<script src="<?php echo $api_url ?>" type="text/javascript" language="javascript"></script>
<script type="text/javascript" language="javascript">
<?php echo $map ?>
</script>
<form method="post" action="<?php	echo url::base(TRUE);	?>admin/users/enregistrement">
  <div class="content_edit_user" style="float:left;">
    <div class="bloc_user">
      <h2><img src="<?php echo url::base(); ?>images/admin/icone/Information.png" width="32" height="32" align="absmiddle" /> Informations générale</h2>
      <table border="0" cellspacing="0" cellpadding="0" width="100%">
        <tr>
          <td width="80"> <img id="image_avatar" src="<?php echo url::base(); ?>images/avatars/<?php echo $users->avatar; ?>" class="vignette" style="margin-top:5px;"/></td>
          <td>
            <div class="edit_user"><strong>ID</strong> : <?php echo $users->id; ?></div>
            <div class="edit_user">
              <label> E-mail :
                <input type="text" class="inputbox" name="email" id="email" value="<?php echo $users->email; ?>" style="width:240px;" />
              </label>
            </div>
            <div class="edit_user">
              <label> Identifiant :
                <input type="text" class="inputbox" name="username" id="username" value="<?php echo $users->username; ?>" style="width:240px;" />
              </label>
            </div>
            <div class="edit_user">
              <label> Mot de passe :
                <input type="password" class="inputbox" name="password" id="password" value="" style="width:240px;" />
              </label>
            </div>
            <div class="edit_user">
              <label> Sa photo :
                <select name="avatar" id="avatar" class="inputbox" style="width:200px" onchange="change_image( this.value, 'image_avatar', 'avatars')">
                  <?php
									$dir = DOCROOT.'images/avatars';
									
									if (is_dir($dir) && $dh = opendir($dir)) 
									{
										while (($file = readdir($dh)) !== false) 
										{                                  
											if( $file != '.' && $file != '..' )
											{
												$select = $users->avatar == $file ? 'selected="selected"' : '';
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
        <label> Commentaire :
          <textarea class="inputbox" style="width:300px" name="commentaire" id="commentaire"/><?php echo $users->commentaire; ?></textarea>
        </label>
      </div>
      <div class="edit_user">
        <label> Sexe :
          <select style="width:150px" class="inputbox" name="sexe" id="sexe">
            <?php foreach( Kohana::config( 'users.sexe' ) as $key => $val ) : ?>
            <option <?php echo $users->sexe == $key ? 'selected="selected"' : false; ?> value="<?php echo $key; ?>"><?php echo $val; ?></option>
            <?php endforeach ?>
          </select>
        </label>
      </div>
      <div class="edit_user">
        <label> Age :
          <select style="width:150px" class="inputbox" name="age" id="age">
            <?php for($n=18; $n< 80; $n++) : ?>
            <option <?php echo $users->age == $n ? 'selected="selected"' : false; ?> value="<?php echo $n; ?>"><?php echo $n; ?> ans</option>
            <?php endfor ?>
          </select>
        </label>
      </div>
      <div class="edit_user">
        <label> Humeur :
          <select style="width:150px"  name="humeur" id="humeur" class="inputbox" >
						<?php foreach( Kohana::config( 'users.humeur' ) as $key => $val ) : ?>
            <option <?php echo $users->humeur == $key ? 'selected="selected"' : false; ?> value="<?php echo $key; ?>"><?php echo $val; ?></option>
            <?php endforeach ?>
        </select>
        </label>
      </div>
      <div class="edit_user">
        <label> Comportement :
           <select style="width:150px"  name="comportement" id="comportement" class="inputbox" >
            <?php foreach( Kohana::config( 'users.comportement' ) as $key => $val ) : ?>
            <option <?php echo $users->comportement == $key ? 'selected="selected"' : false; ?> value="<?php echo $key; ?>"><?php echo $val; ?></option>
            <?php endforeach ?>
          </select>
        </label>
      </div>
      <div class="edit_user">
        <label> Connaissance :
          <select style="width:150px"  name="connaissance" id="connaissance" class="inputbox" >
						<?php foreach( Kohana::config( 'users.connaissance' ) as $key => $val ) : ?>
            <option <?php echo $users->connaissance == $key ? 'selected="selected"' : false; ?> value="<?php echo $key; ?>"><?php echo $val; ?></option>
            <?php endforeach ?>
          </select>
        </label>
      </div>
      <div class="edit_user">
        <label> Nom de son gang :
          <select style="width:150px" class="inputbox" name="id_gang" id="id_gang">
            <?php foreach( $gangs as $val ) : ?>
            <option value="<?php echo $val->id; ?>" <?php echo $users->id_gang == $val->id ? 'selected="selected"' : ''; ?>><?php echo $val->nom_gang; ?></option>
            <?php endforeach ?>
          </select>
        </label>
      </div>
      <div class="edit_user">
        <label> Position horizontal (x) :
          <select class="inputbox" name="x" id="x">
            <?php for($n=1; $n <= Kohana::config( 'carte.taille_carte' ); $n++) : ?>
            <option value="<?php echo $n; ?>" <?php echo $users->x == $n ? 'selected="selected"' : ''; ?>><?php echo $n; ?></option>
            <?php endfor ?>
          </select>
        </label>
      </div>
      <div class="edit_user">
        <label> Position vertical (y) :
          <select class="inputbox" name="y" id="y">
            <?php for($n=1; $n <= Kohana::config( 'carte.taille_carte' ); $n++) : ?>
            <option value="<?php echo $n; ?>" <?php echo $users->y == $n ? 'selected="selected"' : ''; ?>><?php echo chr($n + 64); ?></option>
            <?php endfor ?>
          </select>
        </label>
      </div>
      <div class="edit_user">
        <label> Nombre de HP :
          <select class="inputbox" name="hp" id="hp">
            <?php for($n=0; $n <= 100; $n++) : ?>
            <option value="<?php echo $n; ?>" <?php echo $users->hp == $n ? 'selected="selected"' : ''; ?>><?php echo $n; ?></option>
            <?php endfor ?>
          </select>
        </label>
      </div>
      <div class="edit_user">
        <label> Niveau :
          <select class="inputbox" name="niveau" id="niveau">
            <?php for($n=0; $n <= 100; $n++) : ?>
            <option value="<?php echo $n; ?>" <?php echo $users->niveau == $n ? 'selected="selected"' : ''; ?>><?php echo $n; ?></option>
            <?php endfor ?>
          </select>
        </label>
      </div>
      <div class="edit_user">
        <label> Nombre de XP :
          <input type="text" class="inputbox" name="xp" id="xp" value="<?php echo $users->xp; ?>" />
        </label>
      </div>
      <div class="edit_user">
        <label> Argent en poche :
          <input type="text" class="inputbox" name="argent" id="argent" value="<?php echo $users->argent; ?>" />
        </label>
      </div>
      <div class="edit_user">
        <label> Argent en banque
          <input type="text" class="inputbox" name="argent_banque" id="argent_banque" value="<?php echo $users->argent_banque; ?>" />
        </label>
      </div>
      <div class="edit_user">
        <label> Prison ( 0 = pas en taule ) :
          <input type="text" class="inputbox" name="prison" id="prison" value="<?php echo $users->prison; ?>" />
        </label>
      </div>
      <div class="edit_user">
        <label> Planquer
          <select class="inputbox" name="planque" id="planque">
            <option value="0" >Non</option>
            <option value="1" <?php echo $users->planque ? 'selected="selected"' : ''; ?>>Oui</option>
          </select>
        </label>
      </div>
      <div class="edit_user">
        <label> IP inscription
          <input type="text" class="inputbox" name="ip" id="ip" value="<?php echo $users->ip; ?>" />
        </label>
      </div>
      <div class="edit_user">
        <label> Valider inscription
          <select class="inputbox" name="valide" id="valide">
            <option value="0" >Non</option>
            <option value="1" <?php echo $users->valide ? 'selected="selected"' : ''; ?>>Oui</option>
          </select>
        </label>
      </div>
      <div class="edit_user">
        <label> Inscription par facebook
          <select class="inputbox" name="facebook" id="facebook">
            <option value="0" >Non</option>
            <option value="1" <?php echo $users->facebook ? 'selected="selected"' : ''; ?>>Oui</option>
          </select>
        </label>
      </div>
      <div class="edit_user">
        <label> Bannir
          <select class="inputbox" name="banni" id="banni">
            <option value="0" >Non</option>
            <option value="1" <?php echo $users->banni ? 'selected="selected"' : ''; ?>>Oui</option>
          </select>
        </label>
      </div>
      <div class="edit_user">
        <label> Tchat
          <select class="inputbox" name="tchat" id="tchat">
            <option value="0" >Non</option>
            <option value="1" <?php echo $users->tchat ? 'selected="selected"' : ''; ?>>Oui</option>
          </select>
        </label>
      </div>
      <div class="edit_user">
        <label> Recherché par la police
          <select class="inputbox" name="recherche" id="recherche">
            <option value="0" >Non</option>
            <option value="1" <?php echo $users->recherche ? 'selected="selected"' : ''; ?>>Oui</option>
          </select>
        </label>
      </div>
    </div>
    <?php if($users->ip) : ?>
    <div class="bloc_user">
      <h2><img src="<?php echo url::base(); ?>images/admin/icone/Information.png" width="32" height="32" align="absmiddle" /> Localisation du joueur</h2>
      <div class="edit_user"> Pays : <?php echo $localisation->CountryName; ?> (<?php echo $localisation->CountryCode; ?>)</div>
      <div class="edit_user"> Région : <?php echo $localisation->RegionName; ?> (<?php echo $localisation->RegionCode; ?>)</div>
      <div class="edit_user"> Ville : <?php echo $localisation->City; ?></div>
      <div class="edit_user"> Latitude : <?php echo $localisation->Latitude; ?></div>
      <div class="edit_user"> Longitude : <?php echo $localisation->Longitude; ?></div>
    </div>
    <?php endif ?>
  </div>
  <div class="content_edit_user" style="float:right;">
    <div class="bloc_user">
      <h2><img src="<?php echo url::base(); ?>images/admin/icone/Bomb.png" width="32" height="32" align="absmiddle" /> Arme <div class="lien"> <div class="lien"><?php echo html::anchor('admin/armes/detail/'.$users->id_arme, '(Voir la fiche)'); ?></div></div></h2>
      <?php $users->image_arme = $users->image_arme ? $users->image_arme : 'aucune.jpg'; ?>
      <table border="0" cellspacing="0" cellpadding="0" width="100%">
        <tr valign="top">
          <td width="60"><img id="image_arme" src="<?php echo url::base(); ?>images/armes/<?php echo $users->image_arme; ?>" class="vignette" style="height:40px; margin-top:5px;"/></td>
          <td>
            <div class="edit_user">
              <label> Nom de l'arme :
                <select class="inputbox" name="id_arme" id="id_arme">
                  <option value="0">Aucune</option>
                  <?php foreach( $armes as $val ) : ?>
                  <option value="<?php echo $val->id; ?>" <?php echo $users->id_arme == $val->id ? 'selected="selected"' : ''; ?>><?php echo $val->name_arme; ?> (<?php echo $val->munition_arme; ?>)</option>
                  <?php endforeach ?>
                </select>
              </label>
            </div>
            <div class="edit_user">
              <label> Munition de l'arme :
                <select class="inputbox" name="munition" id="munition">
                  <?php for($n=0; $n <= 100; $n++) : ?>
                  <option value="<?php echo $n; ?>" <?php echo $users->munition == $n ? 'selected="selected"' : ''; ?>><?php echo $n; ?></option>
                  <?php endfor ?>
                </select>
              </label>
            </div>
          </td>
        </tr>
      </table>
      <hr/>
      <h2><img src="<?php echo url::base(); ?>images/admin/icone/Toxic.png" width="32" height="32"  align="absmiddle" /> Protection <div class="lien"> <div class="lien"><?php echo html::anchor('admin/protections/detail/'.$users->id_protection, '(Voir la fiche)'); ?></div></div></h2>
      <?php $users->image_protection = $users->image_protection ? $users->image_protection : 'aucune.jpg'; ?>
      <table border="0" cellspacing="0" cellpadding="0" width="100%">
        <tr valign="top">
          <td width="60"><img id="image_arme" src="<?php echo url::base(); ?>images/protections/<?php echo $users->image_protection; ?>" class="vignette" style="height:40px; margin-top:5px;"/></td>
          <td>
            <div class="edit_user">
              <label> Nom de la protection :
                <select class="inputbox" name="id_protection" id="id_protection">
                  <option value="0">Aucune</option>
                  <?php foreach( $protections as $val ) : ?>
                  <option value="<?php echo $val->id; ?>" <?php echo $users->id_protection == $val->id ? 'selected="selected"' : ''; ?>><?php echo $val->name_protection; ?></option>
                  <?php endforeach ?>
                </select>
              </label>
            </div>
            <div class="edit_user">
              <label> Etat de la protection :
                <select class="inputbox" name="etat_protection" id="etat_protection">
                  <?php for($n=0; $n <= 100; $n++) : ?>
                  <option value="<?php echo $n; ?>" <?php echo $users->etat_protection == $n ? 'selected="selected"' : ''; ?>><?php echo $n; ?></option>
                  <?php endfor ?>
                </select>
              </label>
            </div>
          </td>
        </tr>
      </table>
      <hr/>
      <h2><img src="<?php echo url::base(); ?>images/admin/icone/Car.png" width="32" height="32"  align="absmiddle" /> Véhicule <div class="lien"><?php echo html::anchor('admin/vehicules/detail/'.$users->id_vehicule, '(Voir la fiche)'); ?></div></h2>
      <?php $users->image_vehicule = $users->image_vehicule ? $users->image_vehicule : 'aucune.jpg'; ?>
      <table border="0" cellspacing="0" cellpadding="0" width="100%">
        <tr valign="top">
          <td width="60"><img id="image_arme" src="<?php echo url::base(); ?>images/voitures/<?php echo $users->image_vehicule; ?>" class="vignette" style="height:40px; margin-top:5px;"/></td>
          <td>
            <div class="edit_user">
              <label> Nom du véhicule :
                <select class="inputbox" name="id_vehicule" id="id_vehicule">
                  <option value="0">Aucun</option>
                  <?php foreach( $vehicules as $val ) : ?>
                  <option value="<?php echo $val->id; ?>" <?php echo $users->id_vehicule == $val->id ? 'selected="selected"' : ''; ?>><?php echo $val->name_vehicule; ?></option>
                  <?php endforeach ?>
                </select>
              </label>
            </div>
            <div class="edit_user">
              <label> Etat du véhicule :
                <select class="inputbox" name="etat_vehicule" id="etat_vehicule">
                  <?php for($n=0; $n <= 100; $n++) : ?>
                  <option value="<?php echo $n; ?>" <?php echo $users->etat_vehicule == $n ? 'selected="selected"' : ''; ?>><?php echo $n; ?></option>
                  <?php endfor ?>
                </select>
              </label>
            </div>
            <div class="edit_user">
              <label> Réservoir du véhicule :
                <select class="inputbox" name="reservoir_vehicule" id="reservoir_vehicule">
                  <?php for($n=0; $n <= 200; $n++) : ?>
                  <option value="<?php echo $n; ?>" <?php echo $users->reservoir_vehicule == $n ? 'selected="selected"' : ''; ?>><?php echo $n; ?></option>
                  <?php endfor ?>
                </select>
              </label>
            </div>
          </td>
        </tr>
      </table>
      <hr />
      <h2><img src="<?php echo url::base(); ?>images/admin/icone/Monitor.png" width="32" height="32"  align="absmiddle" /> Statistiques</h2>
      <div class="edit_user">Nombre de connection(s) : <?php echo number_format($users->logins); ?> </div>
      <div class="edit_user">Nombre de déplacement : <?php echo number_format( $users->deplacement ); ?></div>
      <div class="edit_user">Nombre de drogue acheté : <?php echo number_format( $users->achat_drogue ); ?></div>
      <div class="edit_user">Nombre de drogue vendu : <?php echo number_format( $users->vente_drogue ); ?></div>
      <div class="edit_user">Nombre de bâtiment acheté : <?php echo number_format( $users->achat_batiment ); ?></div>
      <div class="edit_user">Nombre de bâtiment vendu : <?php echo number_format( $users->vente_batiment ); ?></div>
      <div class="edit_user">Nombre d'objet acheté : <?php echo number_format( $users->achat_element ); ?></div>
      <div class="edit_user">Nombre d'objet vendu : <?php echo number_format( $users->vente_element ); ?></div>
    </div>
    <div class="bloc_user">
      <h2><img src="<?php echo url::base(); ?>images/admin/icone/Alarm.png" width="32" height="32" align="absmiddle" /> Temps</h2>
      <div class="edit_user"> Dernière connection : <?php echo date::convertir_date( time() - $users->last_login ); ?></div>
      <div class="edit_user"> Dernière activité : <?php echo date::convertir_date( time() - $users->last_activity ); ?></div>
      <div class="edit_user"> Dernier déplacement : <?php echo date::convertir_date( time() - $users->time_move ); ?></div>
    </div>
  </div>
  <div class="spacer"></div>
  <input type="hidden" name="id" id="id" value="<?php echo $users->id; ?>" />
</form>
<h3>Géo localiser le joueur via son IP</h3>
<div id="map" style="height:500px;"></div>