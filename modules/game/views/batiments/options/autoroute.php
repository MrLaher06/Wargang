<?php defined('SYSPATH') OR die('No direct access allowed.'); ?>

<div class="conteneur_action">
  <h2>:: Bienvenue sur notre reseau d'autoroute</h2>
  <div class="conteneurProduit"> <img src="<?php echo url::base(); ?>images/batiments_option/autoroute.png" align="left" style="margin: 0 10px 10px 0" /> <i class="orange">Si vous souhaitez vous rendre à la sortie d'autoroute veuillez payer la somme de 100 $ pour l'utiliser.</i><br />
    <?php if( !$passage ) : ?>
    <strong class="rouge">Tu n'as pas de véhicule pour traverser l'autoroute.</strong>
    <div class="vert">Cela étant, tu peux tout de même prendre le bus qui te fera traverser. Mais le soucis, c'est que le bus peux te déposer sur n'importe quelle sortie.</div>
    <?php endif ?>
    <p style="margin-top:10px">
      <select id="autoroute" <?php if( !$passage ) echo 'disabled="disabled"' ?> class="inputbox" style="width:150px" >
        <?php if( $liste_autoroute ) : ?>
        <?php foreach( $liste_autoroute as $val ) : ?>
        <?php if( $val->id != $bat->id ) : ?>
        <option value="<?php echo $val->id; ?>"><?php echo $val->nom; ?></option>
        <?php endif ?>
        <?php endforeach ?>
        <?php endif ?>
      </select>
    </p>
  </div>
  <div align="right" style="padding-right:5px;">
    <input type="button" class="button sortir_batiment" value="Sortir" />
    <?php if( $passage ) : ?>
    <input type="button" id="prendre_autoroute" class="button" value="Traverser l'autoroute pour 100 $" name="<?php echo $bat->id; ?>" />
    <?php else : ?>
    <input type="button" id="prendre_autoroute" class="button" value="Prendre le bus pour 200 $" name="<?php echo $bat->id; ?>" />
    <?php endif ?>
  </div>
  <h2>:: Plan de nos sorties d'autoroute</h2>
  <table border="0" cellspacing="0" cellpadding="0">
    <tr>
      <td width="300" align="left" valign="top"> <?php echo $carte; ?></td>
      <td align="left" valign="top">
        <h3>Voici la liste de toutes les sortie : </h3>
        <?php if( $liste_autoroute ) : ?>
        <ul style="padding:0; margin:0;">
          <?php foreach( $liste_autoroute as $val ) : ?>
          <li><span class="orange"><?php echo $val->nom; ?></span> en <span class="jaune"><?php echo chr( $val->y+64 ); ?> - <?php echo $val->x; ?></span><br />
<p align="justify" style="margin-right:10px;"><?php echo $val->commentaire; ?></p></li>
          <?php endforeach ?>
        </ul>
        <?php endif ?>
      </td>
    </tr>
  </table>
</div>
