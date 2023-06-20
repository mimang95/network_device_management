<?php

// File for interacting with the database
class Login extends Dbh {
    
    // Method to retrieve user information from the database based on user ID and password
    protected function getUser($uid, $pwd) {
        $stmt = $this->connect()->prepare('SELECT users_pwd FROM users WHERE users_uid = ? OR users_email = ?;');
        
        // Execute the prepared statement with user ID and password as parameters
        if (!$stmt->execute(array($uid, $pwd))) {
            $stmt = null;
            header("location: ../index.php?error=stmtfailed");  // Redirect to index.php with a statement execution error message
            exit();  // Stop further execution
        }
        
        // Check if any user is found with the provided user ID or email
        if ($stmt->rowCount() == 0) {
            $stmt = null;
            header("location: ../index.php?error=usernotfound");  // Redirect to index.php with a user not found error message
            exit();  // Stop further execution
        }
        
        $pwdHashed = $stmt->fetchAll(PDO::FETCH_ASSOC);  // Fetch the hashed password from the database
        $checkPwd = password_verify($pwd, $pwdHashed[0]["users_pwd"]);  // Verify the provided password with the hashed password
        
        // Check if the provided password matches the hashed password
        if ($checkPwd == false) {
            $stmt = null;
            header("location: ../index.php?error=wrongpassword");  // Redirect to index.php with a wrong password error message
            exit();  // Stop further execution
        } elseif ($checkPwd == true) {
            $stmt = $this->connect()->prepare('SELECT * FROM users WHERE users_uid = ? OR users_email = ? AND users_pwd = ?;');
            
            // Execute the prepared statement with user ID, user email, and password as parameters
            if (!$stmt->execute(array($uid, $uid, $pwd))) {
                $stmt = null;
                header("location: ../index.php?error=stmtfailed");  // Redirect to index.php with a statement execution error message
                exit();  // Stop further execution
            }
            
            // Check if any user is found with the provided user ID or email and password
            if ($stmt->rowCount() == 0) {
                $stmt = null;
                header("location: ../index.php?error=usernotfound");  // Redirect to index.php with a user not found error message
                exit();  // Stop further execution
            }
            
            $user = $stmt->fetchAll(PDO::FETCH_ASSOC);  // Fetch the user information from the database
            
            // Start a new session and store the user id and user uid in session variables
            session_start();
            $_SESSION["userid"] = $user[0]["users_id"];
            $_SESSION["useruid"] = $user[0]["users_uid"];
        
            $stmt = null;  // Close the prepared statement
        }
    }
}