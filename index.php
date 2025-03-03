<?php
ini_set('memory_limit', '512M'); 
set_time_limit(0); 

include 'parse_xml.php';
include 'process_names.php';
include_once 'db.php';

$reader = new XMLReader();
if ($reader->open('nomen.xml')) {
    $names = [];
    $codes = [];

    while ($reader->read()) {
        if ($reader->nodeType == XMLReader::ELEMENT && $reader->localName == 'Справочник.Номенклатура') {
            $xmlData = simplexml_load_string($reader->readOuterXML());

            // Извлекаем наименование
            $name = (string)$xmlData->КлючевыеСвойства->Наименование;
            // Извлекаем код
            $code = (string)$xmlData->КлючевыеСвойства->КодВПрограмме;

            // Проверка на дубли
            if (!empty($name) && !empty($code) && !in_array($name, $names)) {
                $names[] = $name;
                $codes[] = $code;
            }
        }
    }
    $reader->close();

    if (count($names) > 0 && count($codes) > 0) {
        saveNamesToDB($names, $codes); // Функция сохранения
        echo "Данные успешно записаны в базу.<br>";
    } else {
        echo "Нет данных для записи.<br>";
    }
}
?>
