<?php

class SignupContr extends Signup{

    private $uid;
    private $pwd;
    private $pwdRepeat;
    private $email;

    public function __construct($uid, $pwd, $pwdRepeat, $email)
    {
        $this->uid = $uid;
        $this->pwd = $pwd;
        $this->pwdRepeat = $pwdRepeat;
        $this->email = $email;
        
    }


    public function signupUser(){
        if($this->emptyInput() == false){
            //echo "empty input!";
            header("location: ../view/login.php?error=emptyinput");
            exit();
        }
        if($this->invalidUid() == false){
            //echo "invalid Username!";
            header("location: ../view/login.php?error=username");
            exit();
        }
        if($this->invalidEmail() == false){
            //echo "invalid email!";
            header("location: ../view/login.php?error=email");
            exit();
        }
        if($this->pwdMatch() == false){
            //echo "Passwords do not match!";
            header("location: ../view/login.php?error=passwordmatch");
            exit();
        }
        if($this->uidTakenCheck() == false){
            //echo "username or email taken!";
            header("location: ../view/login.php?error=useroremailtaken");
            exit();
        }

        $this->setUser($this->uid, $this->pwd, $this->email);
    }

    //check for empty inputs

    private function emptyInput(){
        if(empty($this->uid) || empty($this->pwd) || empty($this->pwdRepeat) || empty($this->email)){
            $result = false;
        } else {
            $result = true;
        }
        return $result;

    }

    //check for weird characters

    private function invalidUid(){
        if (!preg_match("/^[a-zA-Z0-9]*$/", $this->uid)){
            $result = false;
        } else {
            $result = true;
        }
        return $result;
    }

    //check for right email address

    private function invalidEmail(){
        if(!filter_var($this->email, FILTER_VALIDATE_EMAIL)){
            $result = false;
        } else {
            $result = true;
        }
        return $result;
    }

    //check if second password matches password

    private function pwdMatch(){
        if($this->pwd !== $this->pwdRepeat){
            $result = false;
        } else {
            $result = true;
        }
        return $result;
    }

    private function uidTakenCheck(){
        if(!$this->checkUser($this->uid, $this->email)){
            $result = false;
        } else {
            $result = true;
        }
        return $result;
    }


}