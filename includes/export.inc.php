<?php
require '../classes/database-exporter.classes.php';
// Beispielverwendung
$exporter = new DatabaseExporter();
$exporter->connect();

if (isset($_POST['export'])) {
    $csvFile = 'export.csv';

    $exporter->exportToCSV($csvFile);
}

$exporter->exportToCSV('export.csv');