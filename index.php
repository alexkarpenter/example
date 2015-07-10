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
        'DepartureDate' => '2015-07-28',
    ])
));*/

/*$request = \SD\Model\Entity\Composite::createFromArray(array(
    'provider' => new \SD\Type\Str('burs'),
    'operation' => new \SD\Type\Str('bookOrder'),
    'params' => \SD\Model\Entity\Spec::createFromArray([
        'RunID' => 'MjM0MDJfTVRBd01EUjhNVEF3TURGOE1qZ3VNRGN1TWpBeE5TQXdPakF3T2pBd2ZIeEhSRk14ZkRFd05URT0=',
        'DepartureBusStopID' => '23647',
        'ArrivalBusStopID' => '23650',
        'DepartureDate' => '2015-07-28',
        'Passengers' => \SD\Model\Entity::createFromArray([
            'Name' => 'Алексей',
            'MiddleName' => 'Николаевич',
            'Surname' => 'Карпов',
            'DocumentNumber' => '54364536452',
            'Birthdate' => '1987-07-08',
            'BirthPlace' => 'Севастополь',
            //'CountryDigitalCode' => '',
            'Gender' => 'm', // f | m
            'TariffCode' => '',
            'SeatNumber' => '',
        ])
    ])
));*/

$request = \SD\Model\Entity\Composite::createFromArray(array(
    'provider' => new \SD\Type\Str('burs'),
    'operation' => new \SD\Type\Str('getBookParams'),
    'params' => \SD\Model\Entity\Spec::createFromArray([
        'RunID' => 'MjM0MDJfTVRBd01EUjhNVEF3TURGOE1qZ3VNRGN1TWpBeE5TQXdPakF3T2pBd2ZIeEhSRk14ZkRFd05URT0=',
        'DepartureBusStopID' => '23647',
        'ArrivalBusStopID' => '23650',
        'DepartureDate' => '2015-07-28',
    ])
));

$resp = \SD\Service::getInstance($request)->run();
var_dump($resp->response);