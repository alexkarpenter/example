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
    'operation' => new \SD\Type\Str('getBookParams'),
    'params' => \SD\Model\Entity\Spec::createFromArray([
        'RunID' => 'MjM0MDJfTVRBd01EUjhNVEF3TURGOE1qZ3VNRGN1TWpBeE5TQXdPakF3T2pBd2ZIeEhSRk14ZkRFd05URT0=',
        'DepartureBusStopID' => '23647',
        'ArrivalBusStopID' => '23650',
        'DepartureDate' => '2015-07-28',
    ])
));*/

$request = \SD\Model\Entity\Composite::createFromArray(array(
    'provider' => new \SD\Type\Str('burs'),
    'operation' => new \SD\Type\Str('bookOrder'),
    'params' => \SD\Model\Entity\Spec::createFromArray([

        'RunID' => 'MjM0MDJfTVRBd01EUjhNVEF3TURGOE1qZ3VNRGN1TWpBeE5TQXdPakF3T2pBd2ZIeEhSRk14ZkRFd05URT0=',
        'DepartureBusStopID' => '23647',
        'ArrivalBusStopID' => '23650',
        'DepartureDate' => '2015-07-28',
        'Passenger' => \SD\Model\Entity\Spec::createFromArray([
            'Name' => 'Петр',
            'MiddleName' => 'Сергеевич',
            'Surname' => 'Дуров',
            'DocumentNumber' => '54364536452',
            'Birthdate' => '07-08-1987',
            'BirthPlace' => 'Севастополь',
            'CountryDigitalCode' => '643',
            'Gender' => 'm', // f | m
            'TariffCode' => '55282',
            'SeatNumber' => '1',
        ]),
    ])
));

$resp = \SD\Service::getInstance($request)->run();
var_dump($resp->response);