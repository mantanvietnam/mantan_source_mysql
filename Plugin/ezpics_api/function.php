<?php 
global $price_remove_background;
global $key_remove_bg;
global $name_bank;
global $number_bank;
global $account_holders_bank;
global $link_qr_bank;

$number_bank = '0693.122.8668';
$name_bank = 'Tiên Phong Bank (TPB)';
$account_holders_bank = 'Trần Ngọc Mạnh';
$link_qr_bank = 'https://apis.ezpics.vn/plugins/ezpics_api/view/image/link_qr_bank.jpg';

$price_remove_background = 10000;
$key_remove_bg = 'geBYsERw9PNMJHnQLtu1CE4d';

function createToken($length=30)
{
    $chars = "abcdefghijklmnopqrstuvwxyz0123456789ABCDEFGHIJKLMNOPQRSTUVWXYZ";
    return substr(str_shuffle($chars), 0, $length).time();
}

function removeBackground($link_image_local='')
{
    if(!empty($link_image_local)){
        global $key_remove_bg;

        include('library/guzzle/vendor/autoload.php');

        // Requires "guzzle" to be installed (see guzzlephp.org)
        // If you have problems with our SSL certificate getting the error 'Uncaught GuzzleHttp\Exception\RequestException: cURL error 60: SSL certificate problem: unable to get local issuer certificate (see https://curl.haxx.se/libcurl/c/libcurl-errors.html) for https://api.remove.bg/v1.0/removebg'
        // follow these steps to use the latest cacert certificate for cURL: https://github.com/guzzle/guzzle/issues/1935#issuecomment-371756738

        $client = new GuzzleHttp\Client();
        $res = $client->post('https://api.remove.bg/v1.0/removebg', [
            'multipart' => [
                [
                    'name'     => 'image_file',
                    'contents' => fopen(__DIR__.'/../../'.$link_image_local, 'r')
                ],
                [
                    'name'     => 'size',
                    'contents' => 'auto'
                ]
            ],
            'headers' => [
                'X-Api-Key' => $key_remove_bg
            ]
        ]);

        $fp = fopen(__DIR__.'/../../'.$link_image_local, "wb");
        fwrite($fp, $res->getBody());
        fclose($fp);
    }
}