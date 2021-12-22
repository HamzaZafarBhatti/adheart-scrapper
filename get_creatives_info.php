<?php
require 'config.php';
require 'vendor/autoload.php';

$cookieJar = new \GuzzleHttp\Cookie\FileCookieJar(COOKIE_FILE);
$httpClient = new \GuzzleHttp\Client([
    'cookies' => $cookieJar
]);

$url = 'https://adheart.ru/teasers/?in_links=' . IN_LINKS . '&geos%5B%5D=' . GEO . '&languages%5B%5D=' . LANG . '&cta_types%5B%5D=' . CTA_TYPE1 . '&cta_types%5B%5D=' . CTA_TYPE2 . '&date_created=' . YESTERDAY_DATE . '+-+' . YESTERDAY_DATE . '&date_created_from=' . YESTERDAY_DATE . '&date_created_to=' . YESTERDAY_DATE;

$response = $httpClient->get($url);


$htmlString = (string) $response->getBody();
//add this line to suppress any warnings
libxml_use_internal_errors(true);

$html_arr_total_creatives = explode('kt-valign-middle">', $htmlString);
$total_creatives = 0;

foreach ($html_arr_total_creatives as $index => $html_arr_item) {
    if ($index == 0) {
        continue;
    }
    $total_creatives = explode('</span> creatives', $html_arr_item)[0];
}

$html_arr_total_pages = explode('econdary disabled kt-font-dark">', $htmlString);
$total_pages = 0;

foreach ($html_arr_total_pages as $index => $html_arr_item) {
    if ($index == 0 || $index == 1) {
        continue;
    }
    $total_pages = explode('</a>', $html_arr_item)[0];
}

if ($total_creatives && $total_pages) {
    $response = [
        'status' => 1,
        'message' => 'Creatives Information Found',
        'totalCreatives' => $total_creatives,
        'totalPages' => $total_pages,
    ];
} else {
    $response = [
        'status' => 0,
        'message' => 'Something went wrong!'
    ];
}

echo json_encode($response);
