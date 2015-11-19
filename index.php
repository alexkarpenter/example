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
                4)
        ]
    )
    //->limit(10) // todo убрать
    ->execute()
    ->fetchAll();

if ($res && count($res) > 0) {
    echo "Rows from User: ".count($res)."\n";
} else {
    die('Empty result from User');
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

$file = 'test.csv';
$fp = fopen("$file", 'w');
fwrite($fp, $strBuf);
fclose($fp);

// установка соединения
$conn_id = ftp_connect('ftp.euroset.ru', 21);

// вход на ftp
$login_result = ftp_login($conn_id, 'bonline', 'aES5VRZoXfco');

if ((!$conn_id) || (!$login_result)) {
    die('Ftp connect problem');
}

ftp_pasv($conn_id, true);

// попытка закачивания файла
if (ftp_put($conn_id, $file, $file, FTP_ASCII)) {
    echo "Successfully uploaded $file.";
} else {
    echo "Error uploading $file on ftp.";
}

// закрываем соединение и дескриптор файла
ftp_close($conn_id);

/*select "first_name", "last_name", "birth", 'city', "sex", "phone", "email", "kuza", "created"
from tol."user"
where "agent_id" = 4 and
"created" > '2015-10-01';*/