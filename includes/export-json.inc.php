<?php
require '../classes/database-exporter.classes.php';
// Beispielverwendung

$exporter = new DatabaseExporter();
$exporter->connect();

if (isset($_POST['export-json'])) {
    $jsonFile = "../json-files/" . $_POST['exp_file'];

    $exporter->exportToJSON($jsonFile);
}

$exporter->exportToJSON('export.json');