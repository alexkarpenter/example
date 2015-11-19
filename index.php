<?php
error_reporting(E_ALL);
ini_set("display_errors", 1);

require_once 'BL/Autoload.php';

//$dsn = new \BL\Dsn\Pgsql();

//$adapter = new BL\Db\Adapter\Sql\Adapter;

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
$qb = \BL\Db\QueryBuilder\Sql::create($adapter);
$provider = new \BL\Db\QueryBuilder\Sql($adapter, null, 'tol');
$qb->setTable('vw_user');
$res = $provider->select()
    ->from('vw_user')
    ->where([])
    ->limit(10)
    ->execute()
    ->fetchAll();



$res = \SD\Service::getInstance($req)->run();

print_r($res->response);

/*select "first_name", "last_name", "birth", 'city', "sex", "phone", "email", "kuza", "created"
from tol."user"
where "agent_id" = 4 and
"created" > '2015-10-01';*/