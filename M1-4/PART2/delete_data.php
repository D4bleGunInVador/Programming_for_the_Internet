<?php
header('Content-Type: text/plain');

$dataFile = 'data.json';
$xmlFile = 'data.xml';

$incomingData = json_decode(file_get_contents("php://input"), true);
$index = $incomingData['index'] ?? -1;
$photoPath = $incomingData['photo'] ?? '';

if ($index < 0) {
    die("Невірний індекс!");
}

$passports = file_exists($dataFile) ? json_decode(file_get_contents($dataFile), true) : [];

if (isset($passports[$index])) {
    // Видаляємо фото, якщо воно існує
    if (!empty($photoPath) && file_exists($photoPath)) {
        unlink($photoPath);
    }

    array_splice($passports, $index, 1);
    file_put_contents($dataFile, json_encode($passports, JSON_PRETTY_PRINT | JSON_UNESCAPED_UNICODE));

    // Оновлення XML
    $xml = new SimpleXMLElement('<passports></passports>');
    foreach ($passports as $passport) {
        $passportNode = $xml->addChild('passport');
        foreach ($passport as $key => $value) {
            $passportNode->addChild($key, htmlspecialchars($value));
        }
    }
    $xml->asXML($xmlFile);

    echo "Паспорт і фото видалено!";
} else {
    echo "Запис не знайдено!";
}
?>
