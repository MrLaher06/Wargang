<?php defined('SYSPATH') OR die('No direct access allowed.'); ?>

<div align="right" style="margin-right:10px;">
  <h2><img src="<?php echo url::base(); ?>images/admin/icone/Search.png" width="32" height="32" align="absmiddle" /> Faire une recherche dans la base de données</h2>
  <form method="post" action="<?php	echo url::base(TRUE);	?>admin/recherche.html">
    <div>
      <input name="s" type="text" class="inputbox" id="search" value="<?php echo $this->input->post('s'); ?>" size="50" />
      <input type="submit" value="Rechercher" class="inputbox" />
    </div>
    <label> Utilisateur :
      <input type="checkbox" name="users" <?php if($this->input->post('users') || !$_POST) echo 'checked'; ?> value="1" />
    </label>
    <label> Armes :
      <input type="checkbox" name="armes" <?php if($this->input->post('armes') || !$_POST) echo 'checked'; ?> value="1" />
    </label>
    <label> Voitures :
      <input type="checkbox" name="vehicules" <?php if($this->input->post('vehicules') || !$_POST) echo 'checked'; ?> value="1" />
    </label>
    <label> Protections :
      <input type="checkbox" name="protections" <?php if($this->input->post('protections') || !$_POST) echo 'checked'; ?> value="1" />
    </label>
    <label> Gangs :
      <input type="checkbox" name="gangs" <?php if($this->input->post('gangs') || !$_POST) echo 'checked'; ?> value="1" />
    </label>
    <label> Drogues :
      <input type="checkbox" name="drogues" <?php if($this->input->post('drogues') || !$_POST) echo 'checked'; ?> value="1" />
    </label>
  </form>
  </div>
</div>
  <div class="statistique bloc_user" style="margin-top:10px">
    <?php if( isset($nbr_total) && $nbr_total ) : ?>
    <h2><img src="<?php echo url::base(); ?>images/admin/icone/Monitor.png" width="32" height="32" align="absmiddle" /> Nombre total de résultat : <strong><?php echo $nbr_total; ?></strong> </h2>
    <?php if( isset($nbr_armes) && $nbr_armes ) : ?>
    <div>Nombre de résultat pour les armes : <strong><?php echo $nbr_armes; ?></strong> </div>
    <?php endif ?>
    <?php if( isset($nbr_vehicules) && $nbr_vehicules ) : ?>
    <div>Nombre de résultat pour les véhicules : <strong><?php echo $nbr_vehicules; ?></strong> </div>
    <?php endif ?>
    <?php if( isset($nbr_protections) && $nbr_protections ) : ?>
    <div>Nombre de résultat pour les protections : <strong><?php echo $nbr_protections; ?></strong> </div>
    <?php endif ?>
    <?php if( isset($nbr_gangs) && $nbr_gangs ) : ?>
    <div>Nombre de résultat pour les gangs : <strong><?php echo $nbr_gangs; ?></strong> </div>
    <?php endif ?>
    <?php if( isset($nbr_drogues) && $nbr_drogues ) : ?>
    <div>Nombre de résultat pour les drogues : <strong><?php echo $nbr_drogues; ?></strong> </div>
    <?php endif ?>
    <?php if( isset($nbr_users) && $nbr_users ) : ?>
    <div>Nombre de résultat pour les utilisateurs : <strong><?php echo $nbr_users; ?></strong> </div>
    <?php endif ?>
    <?php endif ?>
    <?php if( isset($stat) ) : ?>
    <h2><img src="<?php echo url::base(); ?>images/admin/icone/Monitor.png" width="32" height="32" align="absmiddle" /> Statistiques rapide sur le jeu en cours</h2>
    <?php if( isset($stat_users) && $stat_users ) : ?>
<div>Nombre total de membres : <strong class="vert"><?php echo $stat_users; ?> membres</strong> </div>
    <?php endif ?>
    <?php if( isset($stat_planque) && $stat_planque ) : ?>
    <div>Nombre total de membres hors planque : <strong class="vert"><?php echo $stat_planque; ?> dehors</strong> </div>
    <?php endif ?>
    <?php if( isset($stat_gangs) && $stat_gangs ) : ?>
    <div>Nombre total de gangs : <strong class="vert"><?php echo $stat_gangs; ?> gangs</strong> </div>
    <?php endif ?>
    <?php if( isset($stat_armes) && $stat_armes ) : ?>
    <div>Nombre total d'armes : <strong class="vert"><?php echo $stat_armes; ?> armes</strong> </div>
    <?php endif ?>
    <?php if( isset($stat_vehicules) && $stat_vehicules ) : ?>
    <div>Nombre total de véhicules : <strong class="vert"><?php echo $stat_vehicules; ?> véhicules</strong> </div>
    <?php endif ?>
    <?php if( isset($stat_protections) && $stat_protections ) : ?>
    <div>Nombre total de protections : <strong class="vert"><?php echo $stat_protections; ?> protections</strong> </div>
    <?php endif ?>
    <?php if( isset($stat_drogues) && $stat_drogues ) : ?>
    <div>Nombre total de drogues : <strong class="vert"><?php echo $stat_drogues; ?> drogues</strong> </div>
    <?php endif ?>
    <?php if( isset($stat_argent) && $stat_argent ) : ?>
    <div>Nombre total d'argent qui tourne : <strong class="vert"><?php echo number_format($stat_argent); ?> $</strong> </div>
    <?php endif ?>
    <?php endif ?>
