<?php
// file to handle inserting network devices
include('../classes/dbh.classes.php');
    if($_SERVER['REQUEST_METHOD'] === 'POST'){
        $device_type = $_POST['device_type'];
        $ip_address = $_POST['ip_address'];
        $mac_address = $_POST['mac_address'];
        $network_address = $_POST['network_address'];
        $dbh = new Dbh();
        $dbh->insertDevice($device_type, $ip_address, $mac_address, $network_address); // Call the insertDevice method of the Dbh class, passing the device details
        header("location: ../index.php?error=none"); // Redirect to index.php with no error message
    }
?>