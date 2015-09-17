<?php
error_reporting(E_ALL);
ini_set("display_errors", 1);

require_once 'BL/Autoload.php';

use SD\Type\IType;

$fo = new SplFileObject('/var/www/gillbus_cities.csv');
$dict = [];
foreach ($fo as $line) {
    $elems = str_getcsv($line, ';');
    $cityID = isset($elems[0]) ? $elems[0] : null;
    $cityName = isset($elems[1]) ? $elems[1] : null;
    $countryID = isset($elems[2]) ? $elems[2] : null;
    $countryName = isset($elems[3]) ? $elems[3] : null;
    //list($cid, $cname, $contryId, $contryName) = str_getcsv($line, ';');
    $data = compact('cityID', 'cityName', 'countryID', 'countryName');
    $dict[] = $data;
}

$model = SD\Model\Entity\Complex::createFromArray([
    'provider' => 'BOL',
    'mis' => [
        'collection' => 'gilb_city_country',
        'models' => $dict,
    ],
]);

$data = $model->toJSON();

$curl = new BL\Curl('http://rest.lo/');
//$curl = new BL\Curl('http://rest.dev.bilet-on-line.ru/');
$curl->setCurlOption(CURLOPT_HTTPHEADER, [
    'Content-Type: application/json',
    'Content-Length: ' . strlen($data),
]);
$curl->setCurlOption(CURLOPT_POSTFIELDS, $data);

if ($curl->request(BL\Curl::METHOD_POST)){
    echo $curl->getBody() . "\nDone\n";
}