<?php
require '../classes/database-exporter.classes.php';

// Create an instance of the DatabaseExporter class
$exporter = new DatabaseExporter();

// Connect to the database
$exporter->connect();

// Check if the 'export-csv' POST parameter is set
if (isset($_POST['export-csv'])) {
    // Retrieve the file name from the 'exp_file' POST parameter and prepend the path
    $csvFile = "../csv-files/" . $_POST['exp_file'];

    // Call the exportToCSV method of the DatabaseExporter class and pass the CSV file path
    $exporter->exportToCSV($csvFile);
}

// Call the exportToCSV method of the DatabaseExporter class with a default file name 'export.csv'
$exporter->exportToCSV('export.csv');
