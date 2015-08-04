<?php
require('include.php');

session_start();

if(isset($_GET['logout'])){
    $c->logout($_SESSION['user']);
    var_dump($_SESSION);
    echo "logout success".time();
}else{
    $oauth_data = $c->require_oauth($_SESSION['user']);
    var_dump($oauth_data);

    $a = $c->get('/userasdfa/asda');
    var_dump($a);
}