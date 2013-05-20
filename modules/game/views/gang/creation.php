<?php defined('SYSPATH') or die('No direct access allowed.'); ?>
<div class="closeOverlay"> <img onclick="closeMessage()" src="<?php echo url::base(); ?>images/icon/close.png" width="30" height="30" alt="Fermer" /> </div>
<h2>Créer son propre gang</h2>
<form name="form_crea_gang" id="form_crea_gang" method="post" onsubmit="return false;">
  <table width="100%" border="0" cellpadding="3" cellspacing="3">
    <tr>
      <td valign="top">
        <label for="nom_gang"> Nom du gang :</label>
      </td>
      <td align="right" valign="top">
        <input type="text" id="nom_gang" name="nom_gang" class="inputbox" value="<?php echo $propo_username; ?>" style="width:195px" />
      </td>
    </tr>
    <tr>
      <td valign="top">
        <label for="image_gang"> Image du gang :</label>
      </td>
      <td align="right" valign="top">
        <select style="width:195px"  name="image_gang" id="image_gang" class="inputbox" onchange="change_image( this.value, 'image_gang_img', 'gang')">
        <?php
				$dir = DOCROOT.'images/gang';
				$image_defaut = false;
				
				if (is_dir($dir) && $dh = opendir($dir)) 
				{
					while (($file = readdir($dh)) !== false) 
					{                                  
						if( $file != '.' && $file != '..' && $file != '.DS_Store' )
						{
							if(!$image_defaut) $image_defaut = $file;
							echo '<option value="'.$file.'">'.$file.'</option>'."\n";
						}
					}
					closedir($dh);
				}
				?>
        </select>
      </td>
    </tr>
    <tr>
      <td valign="top">
        <label for="commentaire_gang"> Slogan du gang :</label>
      </td>
      <td align="right" valign="top">
        <textarea name="commentaire_gang" class="inputbox" id="commentaire_gang" style="width:195px"></textarea>
      </td>
    </tr>
    <tr>
      <td valign="top">
        <label for="couleur_gang"> Couleur du gang :</label>
      </td>
      <td align="right" valign="top">
        <input type="text" id="couleur_gang" name="couleur_gang" class="inputbox" value="#FFF" style="width:195px" />
      </td>
    </tr>
    <tr>
      <td align="center" valign="middle"><img id="image_gang_img" src="<?php echo url::base(); ?>images/gang/<?php echo $image_defaut; ?>" width="80" /></td>
      <td align="center" valign="middle">
        <div id="colorpicker"></div>
      </td>
    </tr>
    <tr>
      <td colspan="2" align="right" valign="top">
        <input type="button" id="creation_gang" class="button" value="Lancer la création de votre gang" />
      </td>
    </tr>
  </table>
</form>
<script language="javascript" type="text/javascript">
	if( $('#colorpicker').length ) $('#colorpicker').farbtastic('#couleur_gang');
</script>
