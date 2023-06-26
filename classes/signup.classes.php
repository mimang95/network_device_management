<?php

// File for interaction with the database
class Signup extends Dbh
{

    // Method for setting user data in the database
    protected function setUser($uid, $pwd, $email)
    {
        $stmt = $this->connect()->prepare('INSERT INTO users (users_uid, users_pwd, users_email) VALUES (?, ?, ?);');
        $hashedPwd = password_hash($pwd, PASSWORD_DEFAULT); // Hash the password for security

        if (!$stmt->execute(array($uid, $hashedPwd, $email))) { // Execute the prepared statement with user data
            $stmt = null;
            header("location: ../index.php?error=stmtfailed"); // Redirect to index.php with an error message
            exit();
        }
        $stmt = null; // Close the statement
    }

    // Method for checking if a user already exists in the database
    protected function checkUser($uid, $email)
    {
        $stmt = $this->connect()->prepare('SELECT users_uid FROM users WHERE users_uid = ? OR users_email = ?;');
        if (!$stmt->execute(array($uid, $email))) { // Execute the prepared statement with user ID and email
            $stmt = null;
            header("location: ../index.php?error=stmtfailed"); // Redirect to index.php with an error message
            exit();
        }
        $resultCheck = null;
        if ($stmt->rowCount() > 0) { // If the number of rows returned is greater than 0, user already exists
            $resultCheck = false; // User exists
        } else {
            $resultCheck = true; // User does not exist
        }
        return $resultCheck; // Return the result of the check
    }

    // Method for deleting a user from the database
    public function deleteUser($uid)
    {
        $stmt = $this->connect()->prepare('DELETE FROM users WHERE users_uid = ?;');

        if (!$stmt->execute(array($uid))) { // Execute the prepared statement with user ID
            $stmt = null;
            header("location: ../index.php?error=stmtfailed"); // Redirect to index.php with an error message
            exit();
        }
        $stmt = null; // Close the statement
    }
}
