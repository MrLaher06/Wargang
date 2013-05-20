<?php defined('SYSPATH') or die('No direct access allowed.'); ?>
<div class="closeOverlay"> <img onclick="closeMessage()" src="<?php echo url::base(); ?>images/icon/close.png" width="30" height="30" alt="Fermer" /> </div>
<h2>Modifier son gangster</h2>
<form name="form_modif_user" id="form_modif_user" method="post" onsubmit="return false" >
  <table width="100%" border="0" cellpadding="5" cellspacing="5">
    <tr>
      <td colspan="2" valign="top">
        <label for="commentaire_user">Commentaire sur votre gangster</label>
        <textarea name="commentaire_user" class="inputbox" id="commentaire_user" style="width:325px"><?php echo $info->commentaire; ?></textarea>
      </td>
    </tr>
    <?php if(!$info->facebook) : ?>
    <tr>
      <td valign="top">
        <label for="password_user">Mot de passe :</label>
      </td>
      <td align="right" valign="top">
        <input name="password_user" type="password" class="inputbox" id="password_user" style="width:195px" value="" />
        <br />
        <small class="jaune">(A remplir si vous souhaitez changer )</small> </td>
    </tr>
    <?php endif ?>
    <tr>
      <td valign="top">
        <label for="sexe_user">Sexe :</label>
      </td>
      <td align="right" valign="top">
        <select style="width:150px"  name="sexe_user" id="sexe_user" class="inputbox" >
          <?php foreach( Kohana::config( 'users.sexe' ) as $key => $val ) : ?>
          <option <?php echo $info->sexe == $key ? 'selected="selected"' : false; ?> value="<?php echo $key; ?>"><?php echo $val; ?></option>
          <?php endforeach ?>
        </select>
      </td>
    </tr>
    <tr>
      <td valign="top">
        <label for="age_user">Age :</label>
      </td>
      <td align="right" valign="top">
        <select style="width:150px"  name="age_user" id="age_user" class="inputbox" >
          <?php for($n=18; $n< 80; $n++) : ?>
          <option <?php echo $info->age == $n ? 'selected="selected"' : false; ?> value="<?php echo $n; ?>"><?php echo $n; ?> ans</option>
          <?php endfor ?>
        </select>
      </td>
    </tr>
    <tr>
      <td valign="top">
        <label for="humeur_user">Humeur :</label>
      </td>
      <td align="right" valign="top">
        <select style="width:150px"  name="humeur_user" id="humeur_user" class="inputbox" >
          <?php foreach( Kohana::config( 'users.humeur' ) as $key => $val ) : ?>
          <option <?php echo $info->humeur == $key ? 'selected="selected"' : false; ?> value="<?php echo $key; ?>"><?php echo $val; ?></option>
          <?php endforeach ?>
        </select>
      </td>
    </tr>
    <tr>
      <td valign="top">
        <label for="comportement_user">Comportement :</label>
      </td>
      <td align="right" valign="top">
        <select style="width:150px"  name="comportement_user" id="comportement_user" class="inputbox" >
          <?php foreach( Kohana::config( 'users.comportement' ) as $key => $val ) : ?>
          <option <?php echo $info->comportement == $key ? 'selected="selected"' : false; ?> value="<?php echo $key; ?>"><?php echo $val; ?></option>
          <?php endforeach ?>
        </select>
      </td>
    </tr>
    <tr>
      <td valign="top">
        <label for="connaissance_user">Niveau de jeu :</label>
      </td>
      <td align="right" valign="top">
        <select style="width:150px"  name="connaissance_user" id="connaissance_user" class="inputbox" >
          <?php foreach( Kohana::config( 'users.connaissance' ) as $key => $val ) : ?>
          <option <?php echo $info->connaissance == $key ? 'selected="selected"' : false; ?> value="<?php echo $key; ?>"><?php echo $val; ?></option>
          <?php endforeach ?>
        </select>
      </td>
    </tr>
    <tr>
      <td colspan="2" align="right" valign="top">
        <input type="button" id="modifier_user" class="button" value="Modifier votre gangster" />
      </td>
    </tr>
  </table>
</form>
