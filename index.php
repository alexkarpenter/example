<?php
error_reporting(E_ALL);
ini_set("display_errors", 1);

require_once 'BL/Autoload.php';

use SD\Type\IType;

//phpinfo();die;

$request = \SD\Model\Entity\Composite::createFromArray(array(
    'provider' => new \SD\Type\Str('charters'),
    'type' => new \SD\Type\Str('tariffList'),
    'params' => \SD\Model\Entity\Spec::createFromArray([
        'city_out_iata' => 'MOW',             //city_from
        'city_in_iata' => 'BOJ', //KIV BOJ      city_to
        'type' => 'ow', //ow rt                 tariff_type
        //'dateBack' => '20.07.2015', //25.05     date_from
        'dateTo' => '22.07.2015',           //date_to
        'adt' => 1,
        'chd' => 1,
        //'inf' => 0,
    ])
));

/*$request = \SD\Model\Entity\Composite::createFromArray(array(
    'provider' => new \SD\Type\Str('charters'),
    'type' => new \SD\Type\Str('tariff'),
    'params' => \SD\Model\Entity\Spec::createFromArray([
        'tarif_id' => '6523718',
        'type' => 'ow',
        'adt' => 1,
        'chd' => 1,
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
$passengers->append($pas2);

/*$request = \SD\Model\Entity\Composite::createFromArray(array(
    'provider' => new \SD\Type\Str('charters'),
    'type' => new \SD\Type\Str('booking'),
    'params' => \SD\Model\Entity\Spec::createFromArray([
        'passengers' => $passengers,
        'tarif_id' => '4619214',
        'tarif_type' => 'ow',
    ])
));*/


/*$request = \SD\Model\Entity\Composite::createFromArray(array(
    'provider' => new \SD\Type\Str('charters'),
    'type' => new \SD\Type\Str('сheckout'),
    'params' => \SD\Model\Entity\Spec::createFromArray([
        'book_number' => '090415-13807',
    ])
));*/

$resp = \SD\Service::getInstance($request)->run();
var_dump($resp->response);