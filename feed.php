<?php

$baseUrl = "http://www.example.com";
$dirs = array();
foreach (glob("*", GLOB_ONLYDIR) as $filename) {
  $dirs[filemtime($filename)] = $filename;
}

if (!empty($dirs)) {

  krsort($dirs);

  echo <<<EOX
<?xml version="1.0" encoding="UTF-8" standalone="yes"?>
<rss xmlns:content="http://purl.org/rss/1.0/modules/content/" version="2.0">
<channel>
<title>Bilder von Luis</title>
<link>$baseUrl</link>
<description>Bilder von Luis</description>
<language>de</language>
EOX;

  echo "
<pubDate>". date('r', time()) ."</pubDate>
<lastBuildDate>". date('r', time()) ."</lastBuildDate>";

  foreach ($dirs as $time => $name) {

    echo "
<item>
<title>$name</title>
<link>$baseUrl/$name</link>
<pubDate>". date('r', $time) ."</pubDate>
</item>";
  }

  echo "
</channel>
</rss>
";

}

?>
