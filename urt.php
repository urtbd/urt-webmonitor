<?php
/**
 * Author: Abu Ashraf Masnun
 * URL: http://masnun.me
 */

// Skip warnings
error_reporting(~E_WARNING);

require_once 'UrbanTerrorServer.php';

// Default response
$response = array(
    'status' => 'ok',
    'data' => array()
);


$host = empty($_POST['host']) ? null : $_POST['host'];
$port = empty($_POST['port']) ? null : $_POST['port'];

try {
    $server = new UrbanTerrorServer($host, $port);
    $data = $server->getStatus();
    $response['data'] = $data;


} catch (Exception $ex) {
    $response['status'] = $ex->getMessage();
}

header('Content-Type: application/json');
print json_encode($response);