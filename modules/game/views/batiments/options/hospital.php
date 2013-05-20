<?php defined('SYSPATH') OR die('No direct access allowed.'); ?>
<div class="conteneur_action">
<h2>:: Chambre d'hôpital</h2>
<div class="conteneurProduit">
<img src="<?php echo url::base(); ?>images/batiments_option/Hospital.png" width="100" align="left" style="margin: 0 10px 10px 0" />
<i class="orange">Si vous souhaitez être soigné, veuilez rester sur l'hôpital le plus longtemps possible et régler la note.</i>
<p>Vous êtes hospitalisé depuis : <?php echo $temps; ?><br />
Cela vous permet de récuperer <strong class="vert"><?php echo $point_gagner; ?> pt(s) de HP</strong> ce qui vous fera un total de <strong class="vert"><?php echo $point_total; ?> pt(s)</strong><br />
<i class="jaune">Maximun de 10 pts par séjour (10h)</i></p>
<p style="margin-top:10px;">Si vous souhaitez gagner rapidement 10 pts de vie, utilisez le système : 
<table border="0" cellspacing="5" cellpadding="5">
  <tr>
    <td><a title="Utiliser le système Allopass" href="javascript:;" onclick="ouverture( 'allopass.html', 'Allopass', 300, 480 );"><img src="<?php echo url::base(); ?>images/buttons/allopass.jpg" width="88" height="20" align="baseline" /></a></td>
    <td><a title="Tarif du système Allopass" href="javascript:;" onclick="tarif_allopass();">Tarifs sur le paiement par Allopass</a></td>
    <td><a title="Utiliser le système Allopass" href="javascript:;" onclick="ouverture( 'allopass.html', 'Allopass', 300, 480 );">Payer par le système Allopass</a></td>
  </tr>
</table>
</p>
</div>
<?php if( $prix > 0 ) : ?>
<div align="right" style="padding-right:5px;">
<input type="button" id="note_hospital" class="button" value="Effectuer les soins pour <?php echo number_format( $prix ); ?> $" name="<?php echo $id; ?>" />
</div>
<?php endif ?>
</div>