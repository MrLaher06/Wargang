<div class="conteneur_action">
<?php if( !isset($titre) || $titre === false ) : ?>
  <h2>:: Score des meilleurs joueurs</h2>
<?php endif ?>
<?php if( !isset($home) || $home === false ) : ?>
  <div align="right" class="time_action"><a href="javascript:;" onclick="paneSplitter.reloadContent('score');return false;" >Recharger cette page</a>&nbsp;&nbsp;<?php echo html::aide(15); ?></div>
<?php endif ?>
  <?php if( isset($resultat) && $resultat ) : ?>
  <table border="0" cellspacing="1" cellpadding="2" width="99%" align="center" class="tableau_score">
    <?php $n = 1; ?>
    <?php foreach( $resultat as $val ) : ?>
    <tr valign="middle" align="center" class="tableau_<?php echo ($n%2 == 0) ? 'pair' : 'impair' ?>" >
      <td width="10" class="<?php echo ( $n <= 10 ) ? 'rouge bold' : 'vert'; ?>"><?php echo $n; ?></td>
			<?php if( !isset($home) || $home === false ) : ?>
      <td align="left" width="25">
       <a href="javascript:;" onclick="displayMessage('<?php	echo url::base(TRUE);	?>users/detail/<?php echo $val->id; ?>.html', 300, 250)"><small>détail</small></a>
      </td>
      <?php endif ?>
      <?php if( $n <= 10 ) : ?>
      <td width="25"><img src="<?php echo url::base(); ?>images/avatars/<?php echo $val->avatar; ?>" alt="Img" class="vignette30" <?php if($val->couleur_gang) echo 'style="background-color:'.$val->couleur_gang.'"'; ?>/></td>
      <td align="left">
			<span class="name_score name_tchat"><?php echo $val->username; ?></span></td>
      <?php else : ?>
      <td colspan="2" align="left"><span class="name_score name_tchat"><?php echo $val->username; ?></span>
      </td>
      <?php endif ?>
      <td width="60"><?php echo $val->recherche ? '<strong class="rouge">recherch&eacute;</strong>' : '<strong class="vert">tranquille</strong>'; ?></td>
      <td width="100"><?php echo $val->id_gang ? '<span style="color:'.$val->couleur_gang.'">'.$val->nom_gang.'</span>' : 'Pas de gang'; ?></td>
      <td width="30" align="left">lvl <?php echo $val->niveau; ?></td>
      <td width="80" align="right"><span class="argent_score"><?php echo number_format($val->argent); ?> $</span></td>
      <td width="50">
			<?php 
			if( $val->prison )
				echo '<strong class="bleu">Prison</strong>';
			elseif( $val->planque )
				echo '<strong class="rouge">planque</strong>';
			else
				echo '<strong class="vert">dehors</strong>'; ?></td>
    </tr>
    <?php $n++; ?>
    <?php endforeach ?>
  </table>
  <?php endif ?>
</div>
<?php if( !isset($home) || $home === false ) : ?>
<div class="close_windows"><a href="javascript:;" onclick="paneSplitter.reloadContent('score');return false;" >Recharger cette page</a> - <a href="javascript:;" onclick="paneSplitter.deleteContentById('score');return false;" >Fermer cette page</a></div>
<?php endif ?>
