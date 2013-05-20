<?php defined('SYSPATH') OR die('No direct access allowed.'); ?>

<div class="conteneur_action">
  <h2>:: Tarif du système Allopass</h2>
  <div align="right" class="time_action">
    <?php if( !isset($regle) ) : ?>
    <a href="javascript:;" onclick="paneSplitter.deleteContentById('tarif');paneSplitter.showContent('contenu');return false;" >Fermer cette page</a>
    <?php endif ?>
  </div>
  <table border="0" cellspacing="1" cellpadding="2" width="99%" align="center" class="tableau_score">
    <tr class="tableau_pair">
      <td><strong>Pays</strong></td>
      <td><strong>Mode de paiement</strong></td>
      <td><strong>Prix par code</strong></td>
      <td><strong>Nombre de codes</strong></td>
    </tr>
    <tr class="tableau_impair">
      <td>Argentina</td>
      <td><span class="orange">SMS surtaxé</span></td>
      <td><strong>9.68 ARS</strong></td>
      <td><span class="vert">1 code</span> à utiliser = <span class="vert">10 pts</span> de HP</td>
    </tr>
    <tr class="tableau_pair">
      <td>Austria</td>
      <td><span class="orange">SMS surtaxé</span></td>
      <td><strong>3.63 EUR</strong></td>
      <td><span class="vert">1 code</span> à utiliser = <span class="vert">10 pts</span> de HP</td>
    </tr>
    <tr class="tableau_impair">
      <td>Belgium</td>
      <td><span class="orange">SMS surtaxé</span></td>
      <td><strong>6.20 EUR</strong></td>
      <td><span class="vert">1 code</span> à utiliser = <span class="vert">10 pts</span> de HP</td>
    </tr>
    <tr class="tableau_pair">
      <td>Canada</td>
      <td><span class="orange">SMS surtaxé</span></td>
      <td><strong>7.00 CAD</strong></td>
      <td><span class="vert">1 code</span> à utiliser = <span class="vert">10 pts</span> de HP</td>
    </tr>
    <tr class="tableau_impair">
      <td>Colombia</td>
      <td><span class="jaune">SMS surtaxé</span></td>
      <td><strong>3,100.00 COP</strong></td>
      <td><span class="vert">1 code</span> à utiliser = <span class="vert">10 pts</span> de HP</td>
    </tr>
    <tr class="tableau_pair">
      <td>Colombia</td>
      <td><span class="jaune">SMS surtaxé</span></td>
      <td><strong>3,800.00 COP</strong></td>
      <td><span class="vert">1 code</span> à utiliser = <span class="vert">10 pts</span> de HP</td>
    </tr>
    <tr class="tableau_impair">
      <td>Czech republic</td>
      <td><span class="jaune">SMS surtaxé</span></td>
      <td><strong>99.00 CZK</strong></td>
      <td><span class="vert">1 code</span> à utiliser = <span class="vert">10 pts</span> de HP</td>
    </tr>
    <tr class="tableau_pair">
      <td>Ecuador</td>
      <td><span class="jaune">SMS surtaxé</span></td>
      <td><strong>1.25 USD</strong></td>
      <td><span class="vert">1 code</span> à utiliser = <span class="vert">10 pts</span> de HP</td>
    </tr>
    <tr class="tableau_impair">
      <td>Estonia</td>
      <td><span class="jaune">SMS surtaxé</span></td>
      <td><strong>50.00 EEK</strong></td>
      <td><span class="vert">1 code</span> à utiliser = <span class="vert">10 pts</span> de HP</td>
    </tr>
    <tr class="tableau_pair">
      <td>France</td>
      <td><span class="bleu">Carte prépayée Neosurf</span></td>
      <td><strong>3.00 EUR</strong></td>
      <td><span class="vert">1 code</span> à utiliser = <span class="vert">10 pts</span> de HP</td>
    </tr>
    <tr class="tableau_impair">
      <td>France</td>
      <td><span class="orange">SMS surtaxé</span></td>
      <td><strong>1.80 EUR</strong></td>
      <td><span class="vert">1 code</span> à utiliser = <span class="vert">10 pts</span> de HP</td>
    </tr>
    <tr class="tableau_pair">
      <td>Germany</td>
      <td><span class="orange">SMS surtaxé</span></td>
      <td><strong>2.00 EUR</strong></td>
      <td><span class="vert">1 code</span> à utiliser = <span class="vert">10 pts</span> de HP</td>
    </tr>
    <tr class="tableau_impair">
      <td>Greece</td>
      <td><span class="jaune">SMS surtaxé</span></td>
      <td><strong>3.50 EUR</strong></td>
      <td><span class="vert">1 code</span> à utiliser = <span class="vert">10 pts</span> de HP</td>
    </tr>
    <tr class="tableau_pair">
      <td>Hungary</td>
      <td><span class="jaune">SMS surtaxé</span></td>
      <td><strong>1,875.00 HUF</strong></td>
      <td><span class="vert">1 code</span> à utiliser = <span class="vert">10 pts</span> de HP</td>
    </tr>
    <tr class="tableau_impair">
      <td>Israel</td>
      <td><span class="jaune">SMS surtaxé</span></td>
      <td><strong>20.00 ILS</strong></td>
      <td><span class="vert">1 code</span> à utiliser = <span class="vert">10 pts</span> de HP</td>
    </tr>
    <tr class="tableau_pair">
      <td>Italy</td>
      <td><span class="orange">SMS surtaxé</span></td>
      <td><strong>5.00 EUR</strong></td>
      <td><span class="vert">1 code</span> à utiliser = <span class="vert">10 pts</span> de HP</td>
    </tr>
    <tr class="tableau_impair">
      <td>Kazakhstan</td>
      <td><span class="jaune">SMS surtaxé</span></td>
      <td><strong>2.00 USD</strong></td>
      <td><span class="vert">1 code</span> à utiliser = <span class="vert">10 pts</span> de HP</td>
    </tr>
    <tr class="tableau_pair">
      <td>Latvia</td>
      <td><span class="jaune">SMS surtaxé</span></td>
      <td><strong>0.95 LVL</strong></td>
      <td><span class="vert">1 code</span> à utiliser = <span class="vert">10 pts</span> de HP</td>
    </tr>
    <tr class="tableau_impair">
      <td>Lithuania</td>
      <td><span class="jaune">SMS surtaxé</span></td>
      <td><strong>10.00 LTL</strong></td>
      <td><span class="vert">1 code</span> à utiliser = <span class="vert">10 pts</span> de HP</td>
    </tr>
    <tr class="tableau_pair">
      <td>Luxembourg</td>
      <td><span class="orange">SMS surtaxé</span></td>
      <td><strong>6.00 EUR</strong></td>
      <td><span class="vert">1 code</span> à utiliser = <span class="vert">10 pts</span> de HP</td>
    </tr>
    <tr class="tableau_impair">
      <td>Luxembourg</td>
      <td><span class="jaune">SMS surtaxé</span></td>
      <td><strong>3.00 EUR</strong></td>
      <td><span class="vert">1 code</span> à utiliser = <span class="vert">10 pts</span> de HP</td>
    </tr>
    <tr class="tableau_pair">
      <td>Netherlands</td>
      <td><span class="orange">SMS surtaxé</span></td>
      <td><strong>1.30 EUR</strong></td>
      <td><span class="vert">1 code</span> à utiliser = <span class="vert">10 pts</span> de HP</td>
    </tr>
    <tr class="tableau_impair">
      <td>Norway</td>
      <td><span class="jaune">SMS surtaxé</span></td>
      <td><strong>30.00 NOK</strong></td>
      <td><span class="vert">1 code</span> à utiliser = <span class="vert">10 pts</span> de HP</td>
    </tr>
    <tr class="tableau_pair">
      <td>Peru</td>
      <td><span class="jaune">SMS surtaxé</span></td>
      <td><strong>2.95 PEN</strong></td>
      <td><span class="vert">1 code</span> à utiliser = <span class="vert">10 pts</span> de HP</td>
    </tr>
    <tr class="tableau_impair">
      <td>Poland</td>
      <td><span class="jaune">SMS surtaxé</span></td>
      <td><strong>23.18 PLN</strong></td>
      <td><span class="vert">1 code</span> à utiliser = <span class="vert">10 pts</span> de HP</td>
    </tr>
    <tr class="tableau_pair">
      <td>Romania</td>
      <td><span class="jaune">SMS surtaxé</span></td>
      <td><strong>2.38 EUR</strong></td>
      <td><span class="vert">1 code</span> à utiliser = <span class="vert">10 pts</span> de HP</td>
    </tr>
    <tr class="tableau_impair">
      <td>Russia</td>
      <td><span class="jaune">SMS surtaxé</span></td>
      <td><strong>4.75 USD</strong></td>
      <td><span class="vert">1 code</span> à utiliser = <span class="vert">10 pts</span> de HP</td>
    </tr>
    <tr class="tableau_pair">
      <td>Slovakia</td>
      <td><span class="jaune">SMS surtaxé</span></td>
      <td><strong>1.59 EUR</strong></td>
      <td><span class="vert">1 code</span> à utiliser = <span class="vert">10 pts</span> de HP</td>
    </tr>
    <tr class="tableau_impair">
      <td>Spain</td>
      <td><span class="orange">SMS surtaxé</span></td>
      <td><strong>1.73 EUR</strong></td>
      <td><span class="vert">1 code</span> à utiliser = <span class="vert">10 pts</span> de HP</td>
    </tr>
    <tr class="tableau_pair">
      <td>Spain</td>
      <td><span class="jaune">SMS surtaxé</span></td>
      <td><strong>3.99 EUR</strong></td>
      <td><span class="vert">1 code</span> à utiliser = <span class="vert">10 pts</span> de HP</td>
    </tr>
    <tr class="tableau_impair">
      <td>Sweden</td>
      <td><span class="orange">SMS surtaxé</span></td>
      <td><strong>50.00 SEK</strong></td>
      <td><span class="vert">1 code</span> à utiliser = <span class="vert">10 pts</span> de HP</td>
    </tr>
    <tr class="tableau_pair">
      <td>Switzerland</td>
      <td><span class="orange">SMS surtaxé</span></td>
      <td><strong>6.66 CHF</strong></td>
      <td><span class="vert">1 code</span> à utiliser = <span class="vert">10 pts</span> de HP</td>
    </tr>
    <tr class="tableau_impair">
      <td>Switzerland</td>
      <td><span class="jaune">SMS surtaxé</span></td>
      <td><strong>6.00 CHF</strong></td>
      <td><span class="vert">1 code</span> à utiliser = <span class="vert">10 pts</span> de HP</td>
    </tr>
    <tr class="tableau_pair">
      <td>Ukraine</td>
      <td><span class="jaune">SMS surtaxé</span></td>
      <td><strong>2.30 USD</strong></td>
      <td><span class="vert">1 code</span> à utiliser = <span class="vert">10 pts</span> de HP</td>
    </tr>
    <tr class="tableau_impair">
      <td>United Kingdom</td>
      <td><span class="orange">SMS surtaxé</span></td>
      <td><strong>1.50 GBP</strong></td>
      <td><span class="vert">1 code</span> à utiliser = <span class="vert">10 pts</span> de HP</td>
    </tr>
    <tr class="tableau_pair">
      <td>Venezuela</td>
      <td><span class="jaune">SMS surtaxé</span></td>
      <td><strong>10.90 VEF</strong></td>
      <td><span class="vert">1 code</span> à utiliser = <span class="vert">10 pts</span> de HP</td>
    </tr>
    <tr class="tableau_impair">
      <td>Tous</td>
      <td><span class="bleu">Carte Bancaire</span></td>
      <td><strong>3.00 EUR</strong></td>
      <td><span class="vert">1 code</span> à utiliser = <span class="vert">10 pts</span> de HP</td>
    </tr>
    <tr class="tableau_pair">
      <td>Tous</td>
      <td><span class="bleu">Hipay</span></td>
      <td><strong>3.00 EUR</strong></td>
      <td><span class="vert">1 code</span> à utiliser = <span class="vert">10 pts</span> de HP</td>
    </tr>
  </table>
  <div class="close_windows">
    <?php if( isset($regle) ) : ?>
    <a href="javascript:;" onclick="paneSplitter.loadContent('regles','<?php	echo url::base(TRUE);	?>aide.html');" >Revenir au sommaire</a> - <a href="javascript:;" onclick="paneSplitter.deleteContentById('regles');" >Fermer cette page</a>
    <?php else : ?>
    <a href="javascript:;" onclick="paneSplitter.deleteContentById('tarif');paneSplitter.showContent('contenu');return false;" >Fermer cette page</a>
    <?php endif ?>
  </div>
</div>
