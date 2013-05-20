<?php defined('SYSPATH') or die('No direct access allowed.'); ?>
<div class="closeOverlay"> <img onclick="closeMessage()" src="<?php echo url::base(); ?>images/icon/close.png" width="30" height="30" alt="Fermer" /> </div>
<div style="margin:10px;">
  <?php if(isset($donnees) && $donnees) :  ?>
  <?php foreach($donnees as $val) :  ?>
  <?php if( $val['mission']->type == 'user' ) : ?>
  <div class="conteneurVignette"><?php echo html::image('images/avatars/'.$val['val']->avatar, array( 'width' => 60, 'height' => 60 ) ); ?></div>
  <?php if($val['fini']) : ?>
  <h2 class="vert">Mission a valider</h2>
  <?php else : ?>
  <h2 class="rouge">Mission non validée</h2>
  <?php endif ?>
  <h3 class="jaune">Mission de type combattre un gangster</h3>
  <div><strong>Nom du gangster</strong> : <span class="name_tchat orange"><?php echo $val['val']->username; ?></span></div>
  <?php if(!$val['fini']) : ?>
  <div><strong>Position du gangster</strong> : <span class="violet"><?php echo chr( $val['val']->y+64 ).' - '.$val['val']->x; ?></span></div>
  <?php endif ?>  <div><strong class="vert">Xp</strong> : <?php echo number_format($val['mission']->xp); ?> : - <strong class="vert">Argent</strong> : <?php echo number_format($val['mission']->argent); ?> $</div>
<div class="spacer"></div>
  <?php elseif( $val['mission']->type == 'bot' ) : ?>
  <div class="conteneurVignette"><?php echo html::image('images/bots/'.$val['val']->image, array( 'width' => 60, 'height' => 60 ) ); ?></div>
  <?php if($val['fini']) : ?>
  <h2 class="vert">Mission a valider</h2>
  <?php else : ?>
  <h2 class="rouge">Mission non validée</h2>
  <?php endif ?>
  <h3 class="jaune">Mission de type combattre un habitant</h3>
  <div><strong>Nom de l'habitant</strong> : <span class="orange"><?php echo $val['val']->nom; ?></span></div>
  <?php if(!$val['fini']) : ?>
  <div><strong>Position de l'habitant</strong> : <span class="violet"><?php echo chr( $val['val']->y+64 ).' - '.$val['val']->x; ?></span></div>
  <?php endif ?>  <div><strong class="vert">Xp</strong> : <?php echo number_format($val['mission']->xp); ?> : - <strong class="vert">Argent</strong> : <?php echo number_format($val['mission']->argent); ?> $</div>
<div class="spacer"></div>
  <?php elseif( $val['mission']->type == 'batiment' ) : ?>
  <div class="conteneurVignette"><?php echo html::image('images/batiments/'.$val['val']->image, array( 'width' => 60, 'height' => 60 ) ); ?></div>
  <?php if($val['fini']) : ?>
  <h2 class="vert">Mission a valider</h2>
  <?php else : ?>
  <h2 class="rouge">Mission non validée</h2>
  <?php endif ?>
  <h3 class="jaune">Mission de type braquage de bâtiment</h3>
  <div><strong>Nom du bâtiment</strong> : <span class="orange"><?php echo $val['val']->nom; ?></span></div>
  <div><strong>Position du bâtiment</strong> : <span class="violet"><?php echo chr( $val['val']->y+64 ).' - '.$val['val']->x; ?></span></div>  <div><strong class="vert">Xp</strong> : <?php echo number_format($val['mission']->xp); ?> : - <strong class="vert">Argent</strong> : <?php echo number_format($val['mission']->argent); ?> $</div>
<div class="spacer"></div>
  <?php elseif( $val['mission']->type == 'vehicule' ) : ?>
  <div class="conteneurVignette"><?php echo html::image('images/voitures/'.$val['val']->image_vehicule, array( 'width' => 60, 'height' => 60 ) ); ?></div>
  <?php if($val['fini']) : ?>
  <h2 class="vert">Mission a valider</h2>
  <?php else : ?>
  <h2 class="rouge">Mission non validée</h2>
  <?php endif ?>
  <h3 class="jaune">Mission de type ramener un véhicule</h3>
  <div><strong>Nom du véhicule</strong> : <?php echo $val['val']->name_vehicule; ?></div>
  <div><strong class="vert">Xp</strong> : <?php echo number_format($val['mission']->xp); ?> : - <strong class="vert">Argent</strong> : <?php echo number_format($val['mission']->argent); ?> $</div>
  <div class="spacer"></div>
  <?php endif ?>
  <?php endforeach ?>
  <?php else : ?>
  <p class="orange">Pour le moment vous n'avez pas de mission en cours, Veuillez vous rentre dans une Villa de la mafia pour vous en procurez une.</p>
  <?php endif ?>
</div>
