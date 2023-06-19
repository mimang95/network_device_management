<?php
require '../classes/database-exporter.classes.php';

$exporter = new DatabaseExporter();
$exporter->connect();

if (isset($_POST['export-xml'])) {
    $xmlFile = "../xml-files/" . $_POST['exp_file'];

    $exporter->exportToXML($xmlFile);
}

$exporter->exportToXML('export.xml');