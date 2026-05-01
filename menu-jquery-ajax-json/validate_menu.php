<?php

$json = file_get_contents('menu.json');
$data = json_decode($json, true);

if (!is_array($data)) {
    die("Invalid JSON format");
}

foreach ($data as $item) {

    if (
        !isset($item['item_id']) ||
        !isset($item['name']) ||
        !isset($item['price'])
    ) {
        die("Schema validation failed");
    }

    if (
        !is_numeric($item['item_id']) ||
        !is_string($item['name']) ||
        !is_numeric($item['price'])
    ) {
        die("Wrong data types");
    }
}

echo "JSON Schema Validation Passed!";
?>