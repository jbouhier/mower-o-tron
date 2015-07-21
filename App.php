<?php
/**
 * Author: Jean-Baptiste Bouhier
 * Date: 08/07/15
 * Time: 10:33 PM
 */

require_once __DIR__ . '/vendor/autoload.php';

use Mower\Controller\Engine;

$engine = new Engine($argv[1]);
$engine->init();
$engine->start();