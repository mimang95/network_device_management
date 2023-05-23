<?php

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $filename = $_POST['filename'];

    require '../classes/csv-reader.classes.php';
    $csvReader = new CSVReader($filename);

    $data = $csvReader->read();

    if ($data !== false) {
        foreach ($data as $row) {
            echo implode(', ', $row) . "<br>";
        }
    } else {
        echo "Fehler beim Einlesen der CSV-Datei.";
    }
}
?>