<?php
error_reporting(E_ALL);
ini_set("display_errors", 1);

require_once 'BL/Autoload.php';

use SD\Type\IType;

$statReq = \SD\Model\Entity\Composite::createFromArray([
    'provider' => new \SD\Type\Str('stat'),
    'operation' => new \SD\Type\Str('statBuy'),
    'params' => \SD\Model\Entity\Spec::createFromArray([
        'date' => '21-04-2015',
        'pcode' => 'PRCU'
    ])
]);

$statReq = \SD\Model\Entity\Composite::createFromArray([
    'provider' => new \SD\Type\Str('stat'),
    'operation' => new \SD\Type\Str('getCountSalesByDirection'),
    'params' => \SD\Model\Entity\Spec::createFromArray([
        'terminal' => 'U021',
        'pcode' => 'EUNO',
        'arrival' => 'LED',
        'departure' => 'MOW',
        'scode' => 'AIR'
    ])
]);
//PKC:SEL


$resp = \SD\Service::getInstance($statReq)->run();
var_dump($resp->response);