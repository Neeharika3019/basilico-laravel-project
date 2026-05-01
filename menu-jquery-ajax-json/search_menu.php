<?php
include 'db.php';

$search = $_GET['q'] ?? '';

$term = "%$search%";
$starts = "$search%";

$stmt = $conn->prepare("
    SELECT * FROM menu_items
    WHERE name LIKE ?
    ORDER BY
        CASE
            WHEN name LIKE ? THEN 1
            WHEN name LIKE ? THEN 2
            ELSE 3
        END,
        name ASC
");

$stmt->bind_param("sss", $term, $starts, $term);
$stmt->execute();

$result = $stmt->get_result();

while($row = $result->fetch_assoc()){
    echo "<p>".$row['name']." - Rs ".$row['price']."</p>";
}
?>