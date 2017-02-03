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
    'schema' => 'stat'
];

$dsn = \BL\Dsn::create($conConnect['driver'], $conConnect);
$adapter = \BL\Db\Adapter::create($dsn);
$provider = new \BL\Db\QueryBuilder\Sql($adapter, null, 'stat');


$twoWeeksAgo = date('Y-m-d', strtotime("-2 week"));

$res = $provider->select()
    ->from('funnel')
    /*->where(
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
    )*/
    ->limit(10) // todo убрать
    ->execute()
    ->fetchAll();

if ($res && count($res) > 0) {
    echo "Rows from User: ".count($res)."\n";
} else {
    die('Empty result from User');
}

/*select terminal, count(pay_status) as count_pay, count(search_status) as count_search
from stat.funnel
where pcode = 'EUNO' and (dt > '2017-01-29' and dt < '2017-01-30')
GROUP BY terminal;*/