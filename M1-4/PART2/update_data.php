<?php
header('Content-Type: text/plain');

$dataFile = 'data.json';
$xmlFile = 'data.xml';

$incomingData = json_decode(file_get_contents("php://input"), true);
$index = $incomingData['index'] ?? -1;

if ($index < 0) {
    die("Невірний індекс!");
}

$passports = file_exists($dataFile) ? json_decode(file_get_contents($dataFile), true) : [];

if (isset($passports[$index])) {
    $passports[$index] = [
        "lastname" => $incomingData["lastname"] ?? "",
        "firstname" => $incomingData["firstname"] ?? "",
        "middlename" => $incomingData["middlename"] ?? "",
        "address" => $incomingData["address"] ?? "",
        "idnumber" => $incomingData["idnumber"] ?? "",
        "photo" => $incomingData["photo"] ?? ""
    ];
    file_put_contents($dataFile, json_encode($passports, JSON_PRETTY_PRINT | JSON_UNESCAPED_UNICODE));

    // Оновлення XML
    $xml = new SimpleXMLElement('<passports></passports>');
    foreach ($passports as $passport) {
        $passportNode = $xml->addChild('passport');
        foreach ($passport as $key => $value) {
            $passportNode->addChild($key, htmlspecialchars($value ?? "", ENT_QUOTES, 'UTF-8'));
        }
    }
    $xml->asXML($xmlFile);

    echo "Дані оновлено!";
} else {
    echo "Запис не знайдено!";
}
?>
