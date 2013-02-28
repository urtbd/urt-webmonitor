<?php
/**
 * Author: Abu Ashraf Masnun
 * URL: http://masnun.me
 */

error_reporting(~E_WARNING);

require_once 'UrbanTerrorServer.php';

$server = new UrbanTerrorServer('urtbd.com', 27960);
$response = $server->getStatus();

var_dump($response);