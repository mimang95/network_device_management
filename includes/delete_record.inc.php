<?php
include('../classes/dbh.classes.php');

// Check if the request method is POST
if ($_SERVER['REQUEST_METHOD'] === 'POST') {

    // Retrieve the device ID from the POST data
    $device_id = $_POST['device_id'];

    // Create an instance of the Dbh class
    $dbh = new Dbh();

    // Call the deleteNetworkDevice method from the Dbh class and pass the device ID
    $dbh->deleteNetworkDevice($device_id);

    // Redirect to index.php with no error message
    header("location: ../index.php?error=none");
}
