<?php

$configPath = dirname(__FILE__);
$rooPath = dirname($configPath);
define('ROOT_PATH', $rooPath);
define('CONFIG_PATH', $configPath);

require_once CONFIG_PATH . '/config.php';
require_once ROOT_PATH . '/vendor/autoload.php';
?>
