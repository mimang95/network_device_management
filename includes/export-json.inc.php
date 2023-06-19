<?php
require '../classes/database-exporter.classes.php';
// Import the necessary class for exporting the database

$exporter = new DatabaseExporter(); // Create an instance of the exporter class
$exporter->connect(); // Connect to the database

if (isset($_POST['export-json'])) {
    $jsonFile = "../json-files/" . $_POST['exp_file']; // Specify the path for the JSON file

    $exporter->exportToJSON($jsonFile); // Export the database to JSON using the specified file path
}

$exporter->exportToJSON('export.json'); // Export the database to JSON with a default file name 'export.json'