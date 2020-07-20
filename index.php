<?php

require 'data.php';
require_once 'function.php';

session_start();
if (!empty($_SESSION['access_token'])) {
    header('Location:/likes.php');
}
else {
    header('Location:/auth.php');
}
?>;