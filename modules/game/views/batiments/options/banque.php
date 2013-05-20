<?php defined('SYSPATH') OR die('No direct access allowed.'); ?>

<div class="conteneur_action">
  <div align="right" class="time_action">Vous avez en banque : <strong class="jaune"><?php echo number_format($argent_banque); ?> $</strong></div>
  <h2>:: Comptoir de la banque</h2>
  <div class="conteneurProduit"> <img src="<?php echo url::base(); ?>images/batiments_option/bank.png" width="100" align="left" style="margin: 0 10px 10px 0" /> <i class="orange">Si vous souhaitez faire un depot/retrait, veuillez indiquer la somme de vous désirer virer.</i>
    <table border="0" cellspacing="3" cellpadding="3">
      <tr>
        <td>Virement :</td>
        <td>
          <input type="text" style="width:120px" value="0" class="inputbox" id="virement_banque" />
          $</td>
        <td> compte :
          <select id="virement_user" class="inputbox" style="width:150px" <?php if(!$virement) echo 'disabled="disabled"'; ?>>
            <option value="<?php echo $id_user; ?>">le votre</option>
            <?php if( $liste_user && $virement ) : ?>
            <?php foreach( $liste_user as $val ) : ?>
            <option value="<?php echo $val->id; ?>"><?php echo $val->username; ?></option>
            <?php endforeach ?>
            <?php endif ?>
          </select>
        </td>
      </tr>
      <tr>
        <td>Retrait :</td>
        <td colspan="2">
          <input type="text" style="width:120px" value="0" class="inputbox" id="retrait_banque" />
          $</td>
      </tr>
    </table>
  </div>
  <div align="right" style="padding-right:5px;">
    <input type="button" class="button sortir_batiment" value="Sortir" /> 
    <input type="button" id="banque_transaction" class="button" value="Effectuer une transaction" name="<?php echo $bat->id; ?>" />
  </div>
   <h2>:: Plan du reseau bancaire de War City</h2>
  <table border="0" cellspacing="0" cellpadding="0">
    <tr>
      <td width="300" align="left" valign="top"> <?php echo $carte; ?></td>
      <td align="left" valign="top">
        <h3>Voici la liste de toutes nos banques : </h3>
        <?php if( $liste_banque ) : ?>
        <ul style="padding:0; margin:0;">
          <?php foreach( $liste_banque as $val ) : ?>
          <li><b class="orange"><?php echo $val->nom; ?></b> en <span class="jaune"><?php echo chr( $val->y+64 ); ?> - <?php echo $val->x; ?></span><br />
<p align="justify" style="margin-right:10px;"><?php echo text::limit_chars($val->commentaire, 80, '...', true); ?></p></li>
          <?php endforeach ?>
        </ul>
        <?php endif ?>
      </td>
    </tr>
  </table>
</div>