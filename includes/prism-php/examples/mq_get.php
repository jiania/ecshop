<?php
require('include.php');

$mq = $c->notify();

while(1){
    $data = $mq->get();
    echo $data, "\n";
    $data->ack();
}