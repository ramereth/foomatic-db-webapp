<?php

// PHP wrapper for running the web query API for printer setup tools
// http://www.linuxfoundation.org/en/OpenPrinting/Database/Query
// The output of the called program "query" should not be modified, to
// keep the web query API compatible to the former site.
// PHP Code for access statistics, logging, ... can be added though.

// To be compatible with the former query.cgi the line
//   RewriteRule ^query.cgi/?$ query.php               [L]
// needs to be added to .htaccess

if ($_GET['format'] == "xml") {
  header("Content-Type: text/xml; name=query.xml; charset=UTF-8");
  header("Content-Disposition: inline; filename=\"query.xml\"");
} else {
  header("Content-Type: text/plain; name=query.txt; charset=UTF-8");
  header("Content-Disposition: inline; filename=\"query.txt\"");
}

$dir = getcwd();
$querycmdline = "/usr/bin/perl ./query";
foreach($_GET as $k => $v) {
  $querycmdline .= " " . escapeshellarg($k) . "=" . escapeshellarg($v);
}

chdir('foomatic');
passthru($querycmdline);
chdir($dir);

?>
