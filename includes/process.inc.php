<?php

// Check if the request method is POST
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $filename = $_POST['filename']; // Retrieve the filename from the POST data

    require '../classes/csv-reader.classes.php';
    require '../classes/dbh.classes.php';

    $csvReader = new CSVReader($filename);
    $data = $csvReader->read(); // Read the CSV file and retrieve the data

    if ($data !== false) {
        $dbh = new Dbh();
        $dbh->saveCSVToDatabase($data); // Call the saveCSVToDatabase method of the Dbh class and pass the CSV data
        header("location: ../index.php"); // Redirect to index.php
        exit(); // Terminate further execution
    } else {
        echo "Fehler beim Einlesen der CSV-Datei."; // Output an error message if there was an issue reading the CSV file
    }
}
?>