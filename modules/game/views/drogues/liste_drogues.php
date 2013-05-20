<div class="conteneur_action">
<div align="right" class="time_action">Heure de la derni&egrave;re vente : <?php echo $dernier_vente; ?>&nbsp;&nbsp;<?php echo html::aide(7); ?></div>
  <h2>:: Liste des produits disponible</h2>
  <form id="form1" name="form1" method="post" action="" onsubmit="return false;">
    <?php foreach($donnees as $val): ?>
    <div class="conteneurProduit"> <img src="<?php echo url::base(); ?>images/drogues/<?php echo $val->image; ?>" alt="Img" class="vignette" align="left" />
      <div class="conteneurTitreProduitDrogue">
      <a href="javascript:;" onclick="displayMessage('<?php	echo url::base(TRUE);	?>drogues/detail/<?php echo $val->id; ?>.html', 300, 200)" title="Description"><?php echo html::image('images/icon/tooltip.png', array('align' => 'top')); ?>&nbsp;&nbsp;<span class="titreProduitDrogue"><?php echo $val->name; ?> :</span></a> <?php echo number_format( $val->prix );?> $ <small class="jaune">Prix de revente : <b class="vert"><?php echo number_format( $val->prix + round( $val->prix * ( 20 / 100) ) ); ?></b> $</small></div>
      <?php 
			if(!$val->autoriser)
				echo '<b class="rouge">Ce produit est interdit par la loi fran&ccedil;aise</b>';
			else
				echo '<b class="vert">Ce produit n\'est pas interdit par la loi fran&ccedil;aise</b>'; 
			?>      
      <div align="right">
        <table cellpadding="2" cellspacing="3">
          <tr>
            <td>Possession : <?php echo isset( $liste_drogue[$val->id] ) ? number_format(count($liste_drogue[$val->id])) : 0; ?> unit&eacute;(s)</td>
            <td>Quantit&eacute; :
              <input autocomplete="off" value="0" type="text" class="inputbox achat" id="drogue_<?php echo $val->id; ?>" size="2" maxlength="2"/>
            </td>
            <td>
              <input type="button" name="<?php echo $val->id; ?>" value="Acheter pour <?php echo number_format( $val->prix );?> $" class="button achat_valider" />
            </td>
          </tr>
        </table>
      </div>
    </div>
    <?php endforeach ?>
  </form>
</div>
