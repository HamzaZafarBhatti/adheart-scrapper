<?php
require 'config.php';
require 'vendor/autoload.php';

$cookieJar = new \GuzzleHttp\Cookie\FileCookieJar(COOKIE_FILE, TRUE);
$httpClient = new \GuzzleHttp\Client([
    'cookies' => $cookieJar
]);


$data['login'] = [
    'email' => $_POST['email'],
    'password' => $_POST['password'],
];
$data['do_login'] = '';

$fields_string = http_build_query($data); //url-ify the data for the POST

$url = 'https://adheart.ru/login/';

// $res = $client->post($url, [
//     'form_params' => $data
// ]);
set_time_limit(0);

$res = $httpClient->request('POST', $url, [
    'form_params' => $data,
    'connect_timeout' => 20
]);

// echo json_encode($res->getBody());


// $options = array(
//     CURLOPT_RETURNTRANSFER => true,     // return web page 
//     CURLOPT_HEADER         => true,     // return headers 
//     CURLOPT_FOLLOWLOCATION => true,     // follow redirects 
//     CURLOPT_ENCODING       => "",       // handle all encodings 
//     CURLOPT_USERAGENT      => "spider", // who am i 
//     CURLOPT_COOKIEJAR      => COOKIE_FILE,      //set cookies in cookie file
//     // CURLOPT_COOKIEFILE     => COOKIE_FILE,      //
//     CURLOPT_AUTOREFERER    => true,     // set referer on redirect 
//     CURLOPT_CONNECTTIMEOUT => 120,      // timeout on connect 
//     CURLOPT_TIMEOUT        => 120,      // timeout on response 
//     CURLOPT_MAXREDIRS      => 10,       // stop after 10 redirects 
//     CURLOPT_POST           => true,     // post request
//     CURLOPT_POSTFIELDS     => $fields_string,     // post data
//     CURLOPT_URL            => $url,
// );

// $curl = curl_init();
// curl_setopt_array($curl, $options);
// $result = curl_exec($curl);
// curl_close($curl);

do {
    if (file_get_contents(COOKIE_FILE)) {
        $response = [
            'status' => 1,
            'message' => 'Login Completed',
        ];
        break;
    } else {
        $response = [
            'status' => 0,
            'message' => 'Login Failed',
        ];
    }
} while(true);

echo json_encode($response);
