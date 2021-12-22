<?php


$cookie_file = "cookie.txt";
$demo_html = "demo.html";
$json = "temp.json";
$urls = "urls_" . date('Y-m-d', strtotime("-1 days")) . ".txt";
$urls_clickbank = "urls_clickbank_" . date('Y-m-d', strtotime("-1 days")) . ".txt";

define("COOKIE_FILE", dirname(__FILE__) . '/' . $cookie_file);
define("DEMO_HTML", dirname(__FILE__) . '/' . $demo_html);
define("JSON_FILE", dirname(__FILE__) . '/' . $json);
define("URLS_FILE", dirname(__FILE__) . '/' . $urls);
define("URLS_CLICKBANK_FILE", dirname(__FILE__) . '/' . $urls_clickbank);

define("IN_LINKS", '-instagram.com');
define("GEO", 'US');
define("LANG", 'en');
define("CTA_TYPE1", 'LEARN_MORE');
define("CTA_TYPE2", 'SHOP_NOW');
define("YESTERDAY_DATE", date('Y-m-d', strtotime("-1 days")));

