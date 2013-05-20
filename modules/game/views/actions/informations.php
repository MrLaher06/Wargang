<?php defined('SYSPATH') OR die('No direct access allowed.'); ?>

<div class="conteneur_action">
  <div align="right" class="time_action">Il y a <strong><?php echo $nbr_actions; ?></strong> possibilité(s).&nbsp;&nbsp;<?php echo html::aide(12); ?></div>
  <?php if( isset( $victoire ) && $victoire ) : ?>
  <h2>:: La partie vient d'être gagné!</h2>
  <p class="orange">La partie en cours vient de se finir, elle sera mise à zéro dès que possible.<br />
    Vous pouvez toujours continuer à jouer pour vous entrainer.</p>
  <?php endif ?>
  <?php if( isset( $batiment ) && $batiment ) : ?>
  <h2>:: 1 b&acirc;timent  sur cette position</h2>
  <?php echo $batiment; ?>
  <?php endif ?>
  <?php if( isset( $users ) && $users ) : ?>
  <h2>:: <?php echo number_format($nbr_users); ?> joueur(s) sur cette position</h2>
  <?php echo $users; ?>
  <?php endif ?>
  <?php if( isset( $bots ) && $bots ) : ?>
  <h2>:: <?php echo number_format($nbr_bots); ?> habitant(s) sur cette position</h2>
  <?php echo $bots; ?>
  <?php endif ?>
  <?php if( !$nbr_actions ) : ?>
  <h2>:: Aucune action pour le moment</h2>
  <?php echo $panel; ?>
  <?php endif ?>
</div>