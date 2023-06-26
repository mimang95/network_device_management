<?php
require '../classes/database-exporter.classes.php';

// Create an instance of the DatabaseExporter class
$exporter = new DatabaseExporter();

// Connect to the database
$exporter->connect();

// Check if the 'export-xml' POST parameter is set
if (isset($_POST['export-xml'])) {
    // Retrieve the file name from the 'exp_file' POST parameter and prepend the path
    $xmlFile = "../xml-files/" . $_POST['exp_file'];

    // Call the exportToXML method of the DatabaseExporter class and pass the XML file path
    $exporter->exportToXML($xmlFile);
}

// Call the exportToXML method of the DatabaseExporter class with a default file name 'export.xml'
$exporter->exportToXML('export.xml');
