<?php
header ("Content-Type:text/xml");
require_once("config/config.php");
$siteurl = "http://".$_SERVER["SERVER_NAME"]."/".$config['sitepath'];

echo '<?xml version="1.0" encoding="UTF-8"?>';
?>
<urlset xmlns="http://www.google.com/schemas/sitemap/0.84">
<url>
    <loc><?=$siteurl?></loc>
    <lastmod><? echo date("Y-m-d"); ?></lastmod>
    <changefreq>daily</changefreq>
    <priority>0.6</priority>
</url>   
</urlset>