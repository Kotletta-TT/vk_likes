<?php
require_once 'data.php';
session_start();


$response = $vk->fave()->getPosts($_SESSION['access_token'], []);
$json_test = json_encode($response);
print_r($response);
