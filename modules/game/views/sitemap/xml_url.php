<?php defined('SYSPATH') or die('Access non autoris&eacute;.'); ?>
<url>
  <loc><?php echo trim($loc); ?></loc>
  <lastmod><?php echo $lastmod != '0000-00-00' ? $lastmod : date("Y-m-d"); ?></lastmod>
  <changefreq>weekly</changefreq>
  <priority>1</priority>
</url>