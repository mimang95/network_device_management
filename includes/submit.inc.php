<?php
include('../classes/dbh.classes.php');
    if($_SERVER['REQUEST_METHOD'] === 'POST'){
        $device_type = $_POST['device_type'];
        $ip_address = $_POST['ip_address'];
        $mac_address = $_POST['mac_address'];
        $network_address = $_POST['network_address'];
        $dbh = new Dbh();
        $dbh->insertDevice($device_type, $ip_address, $mac_address, $network_address);
        header("location: ../index.php?error=none");
    }
    ?>