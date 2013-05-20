<?php defined('SYSPATH') OR die('No direct access allowed.'); ?>
<?php if( $donnees ) : ?>
	<?php foreach( $donnees as $val ) : ?>
		 <?php if( $val->type == 'crier' ) : ?>
    <div class="bleu"><b>[<span class="name_tchat"><?php echo $val->name; ?></span>]</b> <span style="font-size:14px"><?php echo $val->texte; ?></span></div>
    <?php elseif( $val->type == 'info' ) : ?>
    <div class="violet">[il y a <?php echo date::convertir_date( time() - $val->timer ); ?>] <?php echo $val->texte; ?></div>
    <?php elseif( $val->name && $name == $val->name && $val->type == 'alert' ) : ?>
    <div class="jaune">[il y a <?php echo date::convertir_date( time() - $val->timer ); ?>] <?php echo $val->texte; ?></div>
    <?php elseif( $val->id_gang && $id_gang == $val->id_gang && $val->type == 'gang'  ) : ?>
    <div class="vert_gang">[il y a <?php echo date::convertir_date( time() - $val->timer ); ?>] <b>[<span class="name_tchat"><?php echo $val->name; ?></span>] [<span class="name_tchat">gang</span>]</b> <?php echo $val->texte; ?></div>
    <?php elseif( ( $val->name && $name == $val->name && $val->type ) || ( $val->type && $name == $val->type ) ) : ?>
    <div class="orange"><b>[<span class="name_tchat"><?php echo $val->name; ?></span>] pv [<span class="name_tchat"><?php echo $val->type; ?></span>]</b> <?php echo $val->texte; ?></div>
    <?php elseif( !$val->id_gang && !$val->type ) : ?>
    <div>[il y a <?php echo date::convertir_date( time() - $val->timer ); ?>] <b>[<span class="name_tchat"><?php echo $val->name; ?></span>]</b> <?php echo $val->texte; ?></div>
    <?php endif ?>
	<?php endforeach ?>
<?php endif ?>
