<?php
// contains different methods to control the user input
class SignupContr extends Signup{
    private $uid;
    private $pwd;
    private $pwdRepeat;
    private $email;
    public function __construct($uid, $pwd, $pwdRepeat, $email){
        $this->uid=$uid;
        $this->pwd=$pwd;
        $this->pwdRepeat=$pwdRepeat;
        $this->email=$email;
    }

    public function signupUser(){
        // Check for empty input fields
        if($this->empytInput()==false){
            header("location: ../index.php?error=emptyinput");
            exit();
        }
        // Check for invalid username
        if($this->invalidUid()==false){
            header("location: ../index.php?error=username");
            exit();
        }
        // Check for invalid email
        if($this->invalidEmail()==false){
            header("location: ../index.php?error=email");
            exit();
        }
        // Check if password matches the confirmation
        if($this->pwdMatch()==false){
            header("location: ../index.php?error=passwordmatch");
            exit();
        }
        // Check if the username or email is already taken
        if($this->uidTakenCheck()==true){
            header("location: ../index.php?error=useroremailtaken");
            exit();
        }
        // If all checks pass, set the user in the system
        $this->setUser($this->uid, $this->pwd, $this->email);
    }
    private function empytInput(){
        $uid="";
        $pwd="";
        $pwdRepeat="";
        $email="";
        $result=null;
        // Check if any of the input fields are empty
        if(empty($this->uid) || empty($this->pwd) || empty($this->pwdRepeat) || empty($this->email))
        {
            $result = false; // Empty input found
        }
        else 
        {
            $result = true; // No empty input found
        }
        return $result;
    }
    private function invalidUid(){
        $result=false;
        // Check if the username contains only alphanumeric characters
        if(!preg_match("/^[a-zA-Z0-9]*$/", $this->uid))
        {
            $result = false; // Invalid username
        }
        else 
        {
            $result = true; // Valid username
        }
        return $result;
    }
    private function invalidEmail(){
        $result=false;
        // Check if the email address is valid
        if(!filter_var($this->email, FILTER_VALIDATE_EMAIL))
        {
            $result = false; // Invalid email address
        }
        else 
        {
            $result = true; // Valid email address
        }
        return $result;
    }
    private function pwdMatch(){
        $result=false;
        // Check if the password matches the confirmation
        if($this->pwd !== $this->pwdRepeat)
        {
            $result = false; // Passwords do not match
        }
        else 
        {
            $result = true; // Passwords match
        }
        return $result;
    }

    private function uidTakenCheck(){
        $result=false;
        echo $this->uid;
        // Check if the username or email is already taken in the system
        if($this->checkUser($this->uid, $this->email))
        {
            $result = false; // Username or email is taken
        }
        else 
        {
            $result = true; // Username or email is available
        }
        return $result;
    }


}