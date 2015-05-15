<?php
error_reporting(E_ALL);
ini_set("display_errors", 1);

require_once 'BL/Autoload.php';

use SD\Type\IType;

$statReq = \SD\Model\Entity\Composite::createFromArray([
    'provider' => new \SD\Type\Str('stat'),
    'operation' => new \SD\Type\Str('sales')
]);

use SP\Mixin\EngineTool;
class Example extends \SP\Gear\Web{
    use SP\Mixin\EngineTool;
}

$e = new Example();
$e->collectStat($statReq);
