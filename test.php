<?php
/**
 * Created by PhpStorm.
 * User: mahlstrom
 * Date: 2017-02-08
 * Time: 00:56
 */

require_once 'vendor/autoload.php';
$S=new \mahlstrom\IceCast\IceCastStatus('194.16.21.232:8000');
print_r($S);