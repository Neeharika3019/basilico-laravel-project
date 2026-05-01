<?php
include 'db.php';

$result = $conn->query("SELECT item_id, name, description, price, image FROM menu_items");

$data = [];

while($row = $result->fetch_assoc()){

    /* Convert correct types */
    $row['item_id'] = (int)$row['item_id'];
    $row['price']   = (float)$row['price'];

    $data[] = $row;
}

/* Save JSON */
file_put_contents(
    'menu.json',
    json_encode($data, JSON_PRETTY_PRINT)
);

echo "menu.json created successfully!";
?>