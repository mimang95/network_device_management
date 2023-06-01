<?php
include('../classes/dbh.classes.php');
    if($_SERVER['REQUEST_METHOD'] === 'POST'){
    $device_id = $_POST['device_id'];
    $dbh = new Dbh();
    $dbh->deleteNetworkDevice($device_id);
    header("location: ../index.php?error=none");
    }
?>