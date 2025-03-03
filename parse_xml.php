<?php
// parse_xml.php

function parseXML($filePath) {
    $xml = simplexml_load_file($filePath);

    if ($xml === false) {
        die("Ошибка загрузки XML.");
    }

    return $xml;
}
?>
