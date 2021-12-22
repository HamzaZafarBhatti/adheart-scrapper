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

set_time_limit(0);

$res = $httpClient->request('POST', $url, [
    'form_params' => $data,
    'connect_timeout' => 20
]);

// echo json_encode($res->getBody());

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
