<?php
# scraping books to scrape: https://books.toscrape.com/
require 'vendor/autoload.php';
$httpClient = new \GuzzleHttp\Client();
$response = $httpClient->get('https://books.toscrape.com/');
$htmlString = (string) $response->getBody();
// echo $htmlString;
//add this line to suppress any warnings
libxml_use_internal_errors(true);
$doc = new DOMDocument();
$doc->loadHTML($htmlString);
$xpath = new DOMXPath($doc);
$titles = $xpath->evaluate('//ol[@class="row"]//li//article//h3/a');
$extractedTitles = [];
foreach ($titles as $title) {
    $extractedTitles[] = $title->textContent . PHP_EOL;
    echo $title->textContent . PHP_EOL;
}

//div[@class="row mg-t-20 teasers_row"]//div[@class="card card-blog card-border mb-4 card-teaser"]//div[@class="card card-body card-body-link bd-t-1 p-0"]//input