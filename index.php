<?php
error_reporting(E_ALL);
ini_set("display_errors", 1);

require_once 'BL/Autoload.php';

use SD\Type\IType;

//phpinfo();die;

$request = \SD\Model\Entity\Composite::createFromArray(array(
    'provider' => new \SD\Type\Str('sfa'),
    'type' => new \SD\Type\Str('tariffList'),
    'params' => \SD\Model\Entity\Spec::createFromArray([
        'city_out_iata' => 'MOW',             //city_from
        'city_in_iata' => 'BOJ', //KIV BOJ KSQ      city_to
        'type' => 'ow', //ow rt                 tariff_type
        //'dateBack' => '20.07.2015', //25.05     date_from
        'dateTo' => '21.09.2015',           //date_to
        'adt' => 1,
        'chd' => 0,
        'inf' => 0,
    ])
));

/*$request = \SD\Model\Entity\Composite::createFromArray(array(
    'provider' => new \SD\Type\Str('sfa'),
    'type' => new \SD\Type\Str('tariff'),
    'params' => \SD\Model\Entity\Spec::createFromArray([
        'tariff_id' => '6685062',
        'type' => 'ow',
        'adt' => 1,
        'chd' => 0,
    ])
));*/

$passengers = new \SD\Model\Collection('\SD\Model\Entity\Spec');

$pas1 = \SD\Model\Entity\Spec::createFromClass(
    'SD\Service\Info\Passenger',
    array(
        'passenger_code' => 'adt',
        'first_name' => 'Test',
        'last_name' => 'Test',
        'gender_code' => 'M',
        'birthday' => new \SD\Type\DateTime('10.10.1988'),
        'document_type_id' => '1',
        'doc_num' => '434253125',
        'doc_expire' => new \SD\Type\DateTime('10.10.2017'),
        'citizenship_code' => 'RU',
    ));

$pas2 = \SD\Model\Entity\Spec::createFromClass(
    'SD\Service\Info\Passenger',
    array(
        'passenger_code' => 'adt',         //adt – взрослый, chd – ребенок, inf – младенец
        'first_name' => 'Testt',
        'last_name' => 'Testt',
        'gender_code' => 'F',               //M, F
        'birthday' => new \SD\Type\DateTime('10.10.1988'),         //dd.mm.yyyy
        'document_type_id' => '1',          //1 – загранпаспорт РФ, 2 – национальный паспорт
        'doc_num' => '434253421',
        'doc_expire' => new \SD\Type\DateTime('10.10.2017'),       //dd.mm.yyyy
        'citizenship_code' => 'RU',         //IATA код страны из справочника(RU, UA)
    ));

$passengers->append($pas1);
//$passengers->append($pas2);

$request = \SD\Model\Entity\Composite::createFromArray(array(
    'provider' => new \SD\Type\Str('sfa'),
    'type' => new \SD\Type\Str('booking'),
    'params' => \SD\Model\Entity\Spec::createFromArray([
        'passengers' => $passengers,
        'recommendationId' => '12778052',
        'type' => 'ow',
    ])
));


/*$request = \SD\Model\Entity\Composite::createFromArray(array(
    'provider' => new \SD\Type\Str('info'),
    'type' => new \SD\Type\Str('order'),
    'operation' => new \SD\Type\Str('getOrdersByProvider'),
    'params' => \SD\Model\Entity\Spec::createFromArray([
        'provider' => 'Sfa',
        'status_id' => 9
    ])
));*/

$res = \SD\Service::getInstance($request)->run();
