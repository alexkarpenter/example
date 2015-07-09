<?php
error_reporting(E_ALL);
ini_set("display_errors", 1);

require_once 'BL/Autoload.php';

use SD\Type\IType;


$request = \SD\Model\Entity\Composite::createFromArray(array(
    'provider' => new \SD\Type\Str('burs'),
    //'operation' => new \SD\Type\Str('getBusStops'),
    'operation' => new \SD\Type\Str('getAllBusStops'),
    //'operation' => new \SD\Type\Str('getBusTrips'),
    /*'params' => \SD\Model\Entity\Spec::createFromArray([
        'BusStopName' => 'Москв',
    ])*/
));

/*$request = \SD\Model\Entity\Composite::createFromArray(array(
    'provider' => new \SD\Type\Str('burs'),
    'operation' => new \SD\Type\Str('getBusTrips'),
    'params' => \SD\Model\Entity\Spec::createFromArray([
        'DepartureBusStopID' => '23647',
        'ArrivalBusStopID' => '23650',
        'DepartureDate' => '2015-07-21',
    ])
));*/

$resp = \SD\Service::getInstance($request)->run();
var_dump($resp->response);