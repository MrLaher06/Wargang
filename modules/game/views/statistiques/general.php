<?php defined('SYSPATH') OR die('No direct access allowed.'); ?>
<div class="conteneur_action">
  <div align="right" class="time_action">
  <?php if( $liste_users ) : ?>
    <select id="choix_stat_user" class="inputbox" onchange="change_stat_user( this.value )" style="width:100px">
      <option value="">Sélectionnez</option>
		<?php foreach( $liste_users as $val ) : ?>
      <option value="<?php echo $val->id; ?>"><?php echo $val->username; ?></option>
    <?php endforeach ?>
    </select>
  <?php endif ?>
    <select id="choix_stat" class="inputbox" onchange="change_stat( this.value )" style="width:150px">
      <option value="">Sélectionnez</option>
      <optgroup label="Gangsters">
      <option value="">Voir les statistiques en générales</option>
      <option value="vu_detail_user">Voir le détail de votre gangster</option>
      <option value="deplacement">Déplacement de votre gangster</option>
      <option value="change_avatar">Avoir changer l'avatar de votre gangster</option>
      <option value="logout">Avoir planquer son gangster</option>
      <option value="modifier_user">Avoir modifier votre gangster</option>
      <option value="prepare_attaque_user">Avoir préparé un combat de gangsters</option>
      <option value="participe_attaque_user">Avoir participé à un combat de gangsters</option>
      <option value="lancer_attaque_user">Avoir lancé un combat de gangsters</option>
      <option value="combat_user_disparu">Avoir vu son combat de gangsters disparaitre</option>
      </optgroup>
      <optgroup label="Bots">
      <option value="prepare_attaque_bot">Avoir préparé un combat bot</option>
      <option value="participe_attaque_bot">Avoir participé à un combat bot</option>
      <option value="lancer_attaque_bot">Avoir lancé un combat bot</option>
      </optgroup>
      <optgroup label="Gang/Flic">
      <option value="creation_gang">Création de votre gang</option>
      <option value="envois_invitation">Avoir envoyé une invitation</option>
      <option value="valide_invitation">Avoir validé une invitation</option>
      <option value="annul_invitation">Avoir annulé une invitation</option>
      <option value="embauche_police">Avoir postulé à la police</option>
      <option value="demission_police">Avoir démissionné de la police</option>
      </optgroup>
      <optgroup label="Bâtiments">
      <option value="prepare_braquage">Avoir préparé un braquage</option>
      <option value="particpe_braquage">Avoir participé à un braquage</option>
      <option value="lancer_braquage">Avoir lancé un braquage</option>
      <option value="visite">Avoir visité un bâtiment</option>
      <option value="hospital">Avoir été soigné à l'hôspital</option>
      <option value="virement">Avoir fait un retrait bancaire</option>
      <option value="retrait">Avoir fait un virement bancaire</option>
      <option value="recu_virement">Avoir reçu un virement bancaire</option>
      </optgroup>
      <optgroup label="Commerce">
      <option value="achat_drogue">Avoir acheté divers produits</option>
      <option value="achat_batiment">Avoir acheté un bâtiment</option>
      <option value="vente_batiment">Avoir vendu un bâtiment</option>
      <option value="achat_vehicule">Avoir acheté un véhicule</option>
      <option value="essence">Avoir acheté de l'essence</option>
      <option value="achat_arme">Avoir acheté une arme</option>
      <option value="achat_arme">Avoir acheté des munitions</option>
      <option value="achat_protection">Avoir acheté une protection</option>
      <option value="autoroute">Avoir utilisé l'autoroute</option>
      <option value="bus">Avoir utilisé le bus</option>
      <option value="casino">Avoir joué au Casino</option>
      </optgroup>
      <optgroup label="Justice">
      <option value="mettre_prison">Mettre en prison</option>
      <option value="aller_prison">Aller en prison</option>
      <option value="retirer_arme">Confisquer une arme</option>
      <option value="confisque_arme">Perte de votre arme</option>
      <option value="denoncer">Dénoncé un gangster</option>
      </optgroup>
      <optgroup label="Tricherie">
      <option value="allopass">Avoir payé un Allopass</option>
      </optgroup>
      <optgroup label="Divers">
      <option value="annuler">Avoir annulé une action</option>
      <option value="game_over">Avoir eu un GAME OVER</option>
      </optgroup>
    </select>&nbsp;&nbsp;<?php echo html::aide(14); ?>
  </div>
  <div id="contenu_statistique">
    <h2>:: Vos actions journalières (<?php echo $total_stat; ?>)</h2>
    <div id="graph_stat_action" align="center">Chargement en cours...</div>
    <div><span class="rouge">___batiment</span>&nbsp;&nbsp;&nbsp;<span class="orange">___gangster</span>&nbsp;&nbsp;&nbsp;<span class="jaune">___bot</span></div>
    <div align="right"> <i class="jaune">Ce tableau est mise à jour toutes les heures (en cache)</i> </div>
    <script type="text/javascript" language="javascript">
		$(document).ready(function() {
			var myChart = new JSChart('graph_stat_action', 'line');
			myChart.setDataArray([<?php echo implode(', ', $tableau_stat_batiment); ?>], 'rouge');
			myChart.setDataArray([<?php echo implode(', ', $tableau_stat_user); ?>], 'orange');
			myChart.setDataArray([<?php echo implode(', ', $tableau_stat_bot); ?>], 'jaune');
			myChart.setTitle('');
			myChart.setTitleFontSize(10);
			myChart.setAxisNameX('Heure ');
			myChart.setAxisNameY('Action ');
			myChart.setAxisValuesColor('#FFF');
			myChart.setAxisPaddingLeft(45);
			myChart.setAxisPaddingRight(5);
			myChart.setAxisPaddingTop(20);
			myChart.setAxisPaddingBottom(30);
				<?php for($n=0;$n<=23;$n++) : ?>
					myChart.setTooltip([<?php echo $n; ?>]);
				<?php endfor ?>
			myChart.setAxisValuesNumberX(7);
			myChart.setGraphExtend(true);
			myChart.setGridColor('#FFF');
			myChart.setLineWidth(2);
			myChart.setLineColor('#900', 'rouge');
			myChart.setLineColor('#F90', 'orange');
			myChart.setLineColor('#FF3', 'jaune');	
			myChart.setFlagRadius(4);
			myChart.setSize( Math.round( $('#statistiques').width() - 20 ), <?php echo isset($heigth) && $heigth ? $heigth : 160; ?>);
			myChart.draw();
		});
		</script>
  </div>
</div>
<div class="close_windows"><a href="javascript:;" onclick="paneSplitter.reloadContent('statistiques');return false;" >Recharger cette page</a> - <a href="javascript:;" onclick="paneSplitter.deleteContentById('statistiques');return false;" >Fermer cette page</a></div>