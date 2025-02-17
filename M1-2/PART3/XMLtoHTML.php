<?php
// Визначення імені HTML-файлу
$htmlFileName = 'output.html';

// Видалення попереднього HTML-файлу, якщо він існує
if (file_exists($htmlFileName)) {
    unlink($htmlFileName);
}

// Завантаження XML та XSLT документів
$xml = new DOMDocument;
$xml->load('passport.xml');

$xsl = new DOMDocument;
$xsl->load('passport.xsl');

// Конфігурація XSLT-процесора
$proc = new XSLTProcessor;
$proc->importStyleSheet($xsl);

// Виконання трансформації і запис результату у HTML-файл
$html = $proc->transformToXML($xml);
file_put_contents($htmlFileName, $html);

// Виведення результату у браузері
header('Content-Type: text/html; charset=utf-8');
echo $html;
?>
