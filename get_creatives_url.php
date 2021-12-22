<?php
require 'config.php';
require 'vendor/autoload.php';

$demo_html = fopen(DEMO_HTML, 'w') or die("Can't create file");
$json_file = fopen(JSON_FILE, 'w') or die("Can't create file");
$url_file = fopen(URLS_FILE, 'w') or die("Can't create file");

$cookieJar = new \GuzzleHttp\Cookie\FileCookieJar(COOKIE_FILE);
$httpClient = new \GuzzleHttp\Client([
    'cookies' => $cookieJar
]);

$html_arr = array();
$total_pages = $_POST['total_pages'];
for ($i = 1; $i <= $total_pages; $i++) {
    if ($i == 1) {
        $url = 'https://adheart.ru/teasers/?in_links=' . IN_LINKS . '&geos%5B%5D=' . GEO . '&languages%5B%5D=' . LANG . '&cta_types%5B%5D=' . CTA_TYPE1 . '&cta_types%5B%5D=' . CTA_TYPE2 . '&date_created=' . YESTERDAY_DATE . '+-+' . YESTERDAY_DATE . '&date_created_from=' . YESTERDAY_DATE . '&date_created_to=' . YESTERDAY_DATE;
    } else {
        $url = 'https://adheart.ru/teasers/?in_links=' . IN_LINKS . '&geos%5B%5D=' . GEO . '&languages%5B%5D=' . LANG . '&cta_types%5B%5D=' . CTA_TYPE1 . '&cta_types%5B%5D=' . CTA_TYPE2 . '&date_created_from=' . YESTERDAY_DATE . '&date_created_to=' . YESTERDAY_DATE . '&page=' . $i;
    }

    $response = $httpClient->get($url);


    $htmlString = (string) $response->getBody();
    //add this line to suppress any warnings
    libxml_use_internal_errors(true);

    $html_arr_temp = explode('class="form-control form-control-sm bd-0 p-1" value="', $htmlString);
    echo $htmlString;
    foreach ($html_arr_temp as $index => $html_arr_item) {
        if ($index == 0) {
            continue;
        }
        $link_arr = explode('" data-toggle="kt-tooltip" title="', $html_arr_item);
        array_push($html_arr, $link_arr[0]);
    }
}
$written = fwrite($url_file, implode(',', $html_arr));
$close = fclose($url_file);
