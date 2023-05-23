<?php

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $filename = $_POST['filename'];

    require '../classes/csv-reader.classes.php';
    require '../classes/dbh.classes.php';

    $csvReader = new CSVReader($filename);
    $data = $csvReader->read();

    if ($data !== false) 
        {
            $dbh = new Dbh();
            $dbh->saveCSVToDatabase($data);
            header("location: ../index.php");
            exit();
        }
    else 
        {
            echo "Fehler beim Einlesen der CSV-Datei.";
        }
}
?>