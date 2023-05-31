<?php
require '../classes/database-exporter.classes.php';
// Beispielverwendung
$exporter = new DatabaseExporter();
$exporter->connect();

if (isset($_POST['export-csv'])) {
    $csvFile = "../csv-files/" . $_POST['exp_file'];

    $exporter->exportToCSV($csvFile);
}

$exporter->exportToCSV('export.csv');