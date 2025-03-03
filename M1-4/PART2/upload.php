<?php
header('Content-Type: application/json');

$uploadDir = 'uploads/';
if (!is_dir($uploadDir)) {
    mkdir($uploadDir, 0777, true); // Створюємо папку, якщо її немає
}

if (!empty($_FILES['photo'])) {
    $fileName = time() . "_" . basename($_FILES['photo']['name']);
    $targetFile = $uploadDir . $fileName;

    if (move_uploaded_file($_FILES['photo']['tmp_name'], $targetFile)) {
        echo json_encode(["success" => true, "filePath" => $targetFile]);
    } else {
        echo json_encode(["success" => false, "error" => "Помилка при завантаженні"]);
    }
} else {
    echo json_encode(["success" => false, "error" => "Файл не вибрано"]);
}
?>
