<?php
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
        if($this->empytInput()==false){
            header("location: ../index.php?error=emptyinput");
            exit();
        }
        if($this->invalidUid()==false){
            header("location: ../index.php?error=username");
            exit();
        }
        if($this->invalidEmail()==false){
            header("location: ../index.php?error=email");
            exit();
        }
        if($this->pwdMatch()==false){
            header("location: ../index.php?error=passwordmatch");
            exit();
        }
        if($this->uidTakenCheck()==true){
            header("location: ../index.php?error=useroremailtaken");
            exit();
        }
        $this->setUser($this->uid, $this->pwd, $this->email);
    }
    private function empytInput(){
        $uid="";
        $pwd="";
        $pwdRepeat="";
        $email="";
        $result=null;
        if(empty($this->uid) || empty($this->pwd) || empty($this->pwdRepeat) || empty($this->email))
        {
            $result = false;
        }
        else 
        {
            $result = true;
        }
        return $result;
    }
    private function invalidUid(){
        $result=false;
        if(!preg_match("/^[a-zA-Z0-9]*$/", $this->uid))
        {
            $result = false;
        }
        else 
        {
            $result = true;
        }
        return $result;
    }
    private function invalidEmail(){
        $result=false;
        if(!filter_var($this->email, FILTER_VALIDATE_EMAIL))
        {
            $result = false;
        }
        else 
        {
            $result = true;
        }
        return $result;
    }
    private function pwdMatch(){
        $result=false;
        if($this->pwd !== $this->pwdRepeat)
        {
            $result = false;
        }
        else 
        {
            $result = true;
        }
        return $result;
    }

    private function uidTakenCheck(){
        $result=false;
        echo $this->uid;
        if($this->checkUser($this->uid, $this->email))
        {
            $result = false;
        }
        else 
        {
            $result = true;
        }
        return $result;
    }


}