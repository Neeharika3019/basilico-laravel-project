<?php

$json = file_get_contents('menu.json');

$data = json_decode($json, true);

foreach($data as $item){
    echo $item['name'] . " - Rs " . $item['price'] . "<br>";
}

?>