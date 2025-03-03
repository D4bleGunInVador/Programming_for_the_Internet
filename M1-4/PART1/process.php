<?php
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Отримуємо дані з форми
    $lastname = $_POST["lastname"];
    $firstname = $_POST["firstname"];
    $middlename = $_POST["middlename"];
    $address = $_POST["address"];
    $idnumber = $_POST["idnumber"];

    // Обробка фото
    $upload_dir = "uploads/";
    if (!file_exists($upload_dir)) {
        mkdir($upload_dir, 0777, true);
    }
    
    $photo_name = basename($_FILES["photo"]["name"]);
    $photo_path = $upload_dir . time() . "_" . $photo_name;

    if (move_uploaded_file($_FILES["photo"]["tmp_name"], $photo_path)) {
        // Запис даних у CSV
        $csv_file = "data.csv";
        $file = fopen($csv_file, "a");

        if ($file) {
            fputcsv($file, [$lastname, $firstname, $middlename, $address, $idnumber, $photo_path]);
            fclose($file);
        }

        echo "Дані успішно збережені!";
    } else {
        echo "Помилка завантаження фото!";
    }
} else {
    echo "Некоректний запит!";
}
?>
