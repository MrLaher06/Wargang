<?php defined('SYSPATH') OR die('No direct access allowed.'); ?>
<div <?php echo isset( $style ) ? $style : ''; 
					echo( isset( $lien ) && $lien ) ? 'class="caseCarte deplacementCarte" onclick="move(\''.$lien.'\')"' : 'class="caseCarte"' ?>>

<?php if( isset( $lien ) && $lien ) : ?>
<div class="case_venir">Venir ici</div>
<?php endif ?>

<?php if( isset( $batiment ) ) : ?>
<?php echo $batiment; ?>
<?php endif ?>

<?php if( isset( $son_perso ) ) : ?>
<?php echo $son_perso; ?>
<?php endif ?>

<?php if( isset( $user ) ) : ?>
<?php echo $user; ?>
<?php endif ?>

</div>