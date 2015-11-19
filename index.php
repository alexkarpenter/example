<?php
error_reporting(E_ALL);
ini_set("display_errors", 1);

require_once 'BL/Autoload.php';

$conConnect = [
    'driver' => 'pgsql',
    'host' => '89.175.169.162',
    'port' => '5432',
    'username' => 'bol',
    'password' => 'gjasghuAFwgtsd41',
    'dbname' => 'bol',
    'schema' => 'bol'
];

$dsn = \BL\Dsn::create($conConnect['driver'], $conConnect);
$adapter = \BL\Db\Adapter::create($dsn);
$provider = new \BL\Db\QueryBuilder\Sql($adapter, null, 'tol');


$twoWeeksAgo = date('Y-m-d', strtotime("-2 week"));

$res = $provider->select()
    ->from('vw_user')
    ->where(
        [
            new \BL\Db\QueryBuilder\Sql\Predicate\Operator(
                'created',
                \BL\Db\QueryBuilder\Sql\Predicate\Operator::GREATER_THAN,
                $twoWeeksAgo
            ),
            new \BL\Db\QueryBuilder\Sql\Predicate\Operator(
                'agent_id',
                \BL\Db\QueryBuilder\Sql\Predicate\Operator::EQUAL_TO,
                3)
        ]
    )
    //->limit(10) // todo убрать
    ->execute()
    ->fetchAll();

if ($res && count($res) > 0) {
    echo 'Извлечено записей: '.count($res);
} else {
    die('Нет данных от User');
}

$strBuf = "Имя;Фамилия;Дата рождения;Город;Пол;Номер телефона;E-mail;EAN\n";
foreach ($res as $row) {
    $strBuf .= $row['first_name'].';';
    $strBuf .= $row['last_name'].';';
    $strBuf .= $row['birth'].';';
    $strBuf .= ';';             // City
    $strBuf .= $row['sex'].';';
    $strBuf .= $row['phone'].';';
    $strBuf .= $row['email'].';';
    $strBuf .= $row['kuza'];
    //$strBuf .= $row['created'];
    $strBuf .= "\n";
}

$file = 'testfile.csv';
$fp = fopen($file, "w");
fwrite($fp, $strBuf);

// установка соединения
$conn_id = ftp_connect('ftp.euroset.ru', 21);

// вход на ftp
$login_result = ftp_login($conn_id, 'bonline', 'aES5VRZoXfco');

if ((!$conn_id) || (!$login_result)) {
    die('Не удается соединиться по ftp');
}

// попытка закачивания файла
if (ftp_fput($conn_id, '.', $fp, FTP_ASCII)) {
    echo "Файл $file успешно загружен\n";
} else {
    echo "При закачке $file произошла проблема\n";
}

// закрываем соединение и дескриптор файла
ftp_close($conn_id);
fclose($fp);

/*select "first_name", "last_name", "birth", 'city', "sex", "phone", "email", "kuza", "created"
from tol."user"
where "agent_id" = 4 and
"created" > '2015-10-01';*/