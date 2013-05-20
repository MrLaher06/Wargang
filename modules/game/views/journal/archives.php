<?php defined('SYSPATH') OR die('No direct access allowed.'); ?>
<div class="conteneur" <?php echo isset($sommaire) ? 'style="margin-top:100px"' : false; ?>>
  <h1>Archives du journal de War Gang</h1>
  <?php if ( $resultat ) : ?>
  <?php foreach ( $resultat as $val ) : ?>
  <?php $date = explode(' ',$val['value']->date); ?>
  <div style="margin:10px;"> <a name="<?php echo $val['value']->id; ?>"></a>
    <h2><?php echo isset($pagination) ? html::anchor('archives/detail/'.url::title( utf8::transliterate_to_ascii($date[0])).'/'.url::title( utf8::transliterate_to_ascii($val['value']->titre)).'/'.$val['value']->id, $val['value']->titre, array('title' => $val['value']->titre) ) : $val['value']->titre; ?></h2>
    <div class="jaune">Ecrit le : <?php echo date::FormatDate( $val['value']->date ); ?> sur le journal de War gang</div>
    <table border="0" cellspacing="5" cellpadding="5">
      <tr>
        <td align="left" valign="top"><img src="<?php echo url::base(); ?>images/<?php echo $val['value']->image; ?>" alt="<?php echo $val['value']->attaque; ?>" /> </td>
        <td align="left" valign="top">
          <div align="justify"><?php echo $val['text']; ?></div>
          <p style="margin-top:10px;"><strong class="jaune">Gangster attaquant</strong> : <?php echo $val['value']->attaque; ?> - <strong class="jaune">Gangster défenseur</strong> : <?php echo $val['value']->defense; ?> - <strong class="jaune">Position du crime</strong> : <?php echo $val['value']->position; ?></p>
        </td>
      </tr>
    </table>
  </div>
  <div class="spacer separator"></div>
  <?php endforeach ?>
  <?php echo isset($pagination) ? $pagination->render() : false; ?>
  <?php endif ?>
  <div style="margin:10px;" align="right">
    <?php if ( isset($sommaire) ) : ?>
    <a href="<?php	echo url::base(TRUE);	?>archives/page/<?php echo $sommaire && $sommaire != 'page' ? $sommaire : 1; ?>.html" target="_top">Revenir au sommaire</a> - 
    <?php endif ?>
    <a href="<?php	echo url::base(TRUE);	?>" target="_top">Revenir à l'accueil</a> </div>
</div>
