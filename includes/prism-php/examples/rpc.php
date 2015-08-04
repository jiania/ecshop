<?php
require('include.php');

$params = array(
    'username'=>'b', 
    'password'=>'c',
    );
$a = $c->post('/user/login', $params);
var_dump($a);
