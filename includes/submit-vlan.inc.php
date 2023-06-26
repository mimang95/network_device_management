<?php
// file to handle inserting a new vlan in the database
include('../classes/dbh.classes.php');
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $network_address = $_POST['network_address'];
    $subnet_mask = $_POST['subnet_mask'];
    $default_gateway = $_POST['default_gateway'];
    $dbh = new Dbh();
    $dbh->insertVlan($network_address, $subnet_mask, $default_gateway);
    header("location: ../index.php?error=none");
}
