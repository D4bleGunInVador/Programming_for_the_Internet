<?php
header('Content-Type: application/json');

$csvFile = 'data.csv';
$data = [];

// Заголовки для коректного відображення
$headers = ["lastname", "firstname", "middlename", "address", "idnumber", "photo"];

if (($handle = fopen($csvFile, 'r')) !== FALSE) {
    while (($row = fgetcsv($handle, 1000, ',')) !== FALSE) {
        // Якщо в CSV немає заголовків, створюємо масив вручну
        $data[] = array_combine($headers, $row);
    }
    fclose($handle);
}

// Відправляємо JSON-відповідь
echo json_encode($data, JSON_UNESCAPED_UNICODE);
?>