<?php
// responsible for the login of users
class LoginContr extends Login {
    private $uid;
    private $pwd;
    
    // Constructor method to initialize the user ID and password
    public function __construct($uid, $pwd) {
        $this->uid = $uid;
        $this->pwd = $pwd;
    }

    // Method to handle the login process
    public function loginUser() {
        // Check if any input fields are empty
        if ($this->emptyInput() == false) {
            header("location: ../index.php?error=emptyinput");  // Redirect to index.php with an error message
            exit();  // Stop further execution
        }
        $this->getUser($this->uid, $this->pwd);
    }
    
    // Private method to check if any input fields are empty
    private function emptyInput() {
        $uid = "";
        $pwd = "";
        $pwdRepeat = "";
        $email = "";
        $result = null;
        
        // Check if either the user ID or password is empty
        if (empty($this->uid) || empty($this->pwd)) {
            $result = false;  // At least one field is empty
        } else {
            $result = true;  // Both fields are filled
        }
        
        return $result;  // Return the result indicating if any field is empty or not
    }
}