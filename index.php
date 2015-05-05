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
        'city_from' => 'MOW',
        'city_to' => 'BOJ', //KIV
        'tariff_type' => 'ow', //ow rt
        'date_from' => '25.05.2015', //25.05
        //'date_to' => '15.04.2015',
    ])
));

/*$request = \SD\Model\Entity\Composite::createFromArray(array(
    'provider' => new \SD\Type\Str('charters'),
    'type' => new \SD\Type\Str('tariff'),
    'params' => \SD\Model\Entity\Spec::createFromArray([
        'tarif_id' => '6523694',
        'tarif_type' => 'ow',
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