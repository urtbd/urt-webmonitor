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
    'data' => array(),
    'id' => null
);


$host = empty($_POST['host']) ? null : $_POST['host'];
$port = empty($_POST['port']) ? null : $_POST['port'];
$id = empty($_POST['id']) ? null : $_POST['id'];


try {
    $server = new UrbanTerrorServer($host, $port);
    $data = $server->getStatus();
    $response['data'] = $data;
    $response['id'] = (int) $id;
} catch (Exception $ex) {
    $response['status'] = $ex->getMessage();
}

header('Content-Type: application/json');
print json_encode($response);