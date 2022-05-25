<?php

class LoginContr extends Login{

    private $uid;
    private $pwd;
   

    public function __construct($uid, $pwd)
    {
        $this->uid = $uid;
        $this->pwd = $pwd;
        
    }

    public function loginUser(){
        if($this->emptyInput() == false){
            //echo "empty input!";
            header("location: ../view/login.php?error=emptyinput");
            exit();
        }

        $this->getUser($this->uid, $this->pwd);
    }

    //check for empty inputs

    private function emptyInput(){
        if(empty($this->uid) || empty($this->pwd)){
            $result = false;
        } else {
            $result = true;
        }
        return $result;

    }



}