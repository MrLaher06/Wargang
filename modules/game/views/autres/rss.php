<?php defined('SYSPATH') or die('Access non autoris&eacute;.'); ?>
<rss version="2.0">
  <channel>
    <title>War Gang</title>
    <description>Flux RSS du journal de wargang</description>
    <link>http://www.wargang.com</link>
    <?php if( isset($resultat) && $resultat ) : ?>
    <?php foreach( $resultat as $val ) : ?>
    <item>
      <title><?php echo html_entity_decode($val['value']->titre); ?></title>
      <link><?php	echo url::base();	?></link>
      <description><![CDATA[<?php echo html_entity_decode( strip_tags($val['text']) ); ?>]]></description>
      <pubDate><?php echo $val['value']->date; ?></pubDate>
    </item>
    <?php endforeach ?>
  	<?php endif ?>
  </channel>
</rss>
