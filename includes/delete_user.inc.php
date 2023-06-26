<?php
include('../classes/dbh.classes.php');
include('../classes/signup.classes.php');
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Username of the user to delete
    $usernameToDelete = $_POST['delete_user'];
    $signup = new Signup(); // Create an instance of the "Signup" class
    $signup->deleteUser($usernameToDelete); // Call the "deleteUser" method to delete the user
    header("location: ../index.php?error=none");
}
