<?php defined('SYSPATH') OR die('No direct access allowed.'); ?>
<div class="conteneur_action">
<h2>:: Parking pour véhicule</h2>
<div class="conteneurProduit"> <img src="<?php echo url::base(); ?>images/batiments_option/garage.png" width="100" align="left" style="margin: 0 10px 10px 0" />
  <div class="orange"> Si tu souhaites mettre ta voiture en vente sur le march&eacute; noir, mets un prix de vente et le service de gardienage s'occupe du reste.</div>
  <?php if( $prix_max && !$flic) : ?>
  <div>Exemple : <b class="vert">25750</b> est un montant correct par contre <b class="rouge">25,750</b>
    <div class="vert">Laissez la case vide si vous ne désirez pas mettre votre véhicule en vente, par contre le prix de vente ne doit pas être plus de <b class="jaune"><?php echo number_format($prix_max); ?> $</b> et moins de <b class="jaune"><?php echo number_format($prix_min); ?> $</b> ne l'ai pas.</div>
  </div>
  <?php else : ?>
  <div class="jaune">Vous ne pouvez pas vendre de véhicule pour le moment car vous n'en avez aucune en votre possession ou que vous n'en avez pas le droit.</div>
  <?php endif ?>
  <div style="margin:10px 0 10px 0;" align="right">
    <?php if( $prix_max ) : ?>
    <?php if( !$flic ) : ?>
    <input type="text" class="inputbox" id="prixvente" value="" size="11" maxlength="11" />
    <input type="button" id="depot_parking" class="button" value="Deposer votre véhicule au parking" name="<?php echo $id; ?>" />
    <?php endif ?>
    <?php if( $recharge ) : ?>
    <input type="button" value="Faire le plein : <?php echo number_format( round( $niveau * 100 ) + 10 ); ?> $" id="recharge_vehicule" class="button" />
    <?php endif ?>
    <div class="rouge" style="margin-top:5px;"><em>Attention de ne pas mettre de virgule dans le montant.</em></div>
  	<div class="jaune" align="left">Lors d'une vente ou d'une récupération, le parking prendra une commission de <strong>5%</strong> du prix de revente.</div>
    <?php endif ?>
  </div>
</div>
<input type="hidden" id="prix_min" value="<?php echo $prix_min; ?>" />
<input type="hidden" id="prix_max" value="<?php echo $prix_max; ?>" />
<div class="spacer"></div>
<h2>:: Liste des véhicules disponible à la vente</h2>
<?php if( $list_parking ) : ?>
<p style="margin-bottom:10px">Cliquez sur le nom du véhicule pour l'acheter ou récupérer le véhicule en question.<br />
  <em>Vous ne pouvez pas récupérer de véhicule si vous en avez déjà une en votre possession.</em></p>
<table border="0" cellspacing="1" cellpadding="2" width="99%" align="center" class="tableau_score">
  <tr valign="middle" align="center" class="tableau_pair" >
    <td>Nom du véhicule</td>
    <td>Propriétaire</td>
    <td>Prix neuf</td>
    <td>Prix de vente</td>
    <td>Etat</td>
    <td>Réservoir</td>
  </tr>
  <?php $n = 1; ?>
  <?php foreach( $list_parking as $val ) : ?>
  <tr valign="middle" align="center" class="tableau_<?php echo ($n%2 == 0) ? 'pair' : 'impair' ?>" >
    <td class="bleu">
      <?php if( !$flic && !$prix_max ) : ?>
      <a href="javascript:;" class="recuperer_vehicule" name="<?php echo $val->id; ?>"><?php echo $val->name_vehicule; ?></a>
      <?php else : ?>
      <?php echo $val->name_vehicule; ?>
      <?php endif ?>
    </td>
    <td class="orange"><?php echo $val->username; ?></td>
    <td><?php echo number_format($val->prix_vehicule); ?> $</td>
    <td class="jaune"><strong><?php echo number_format($val->prix_ventre_parking); ?> $</strong></td>
    <td class="<?php echo $val->etat_parking < 50 ? 'rouge' : 'vert'; ?>"><?php echo number_format($val->etat_parking); ?></td>
    <td class="<?php echo $val->reservoir_parking < 50 ? 'rouge' : 'vert'; ?>"><?php echo number_format($val->reservoir_parking); ?></td>
  </tr>
  <?php $n++; ?>
  <?php endforeach ?>
</table>
<?php else : ?>
Il n'y a aucun véhicule au parking pour le moment.
<?php endif ?>
