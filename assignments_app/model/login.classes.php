<?php

class Login{

    protected function getUser($uid, $pwd){
        // znaki zapytania sluzą jak place holdery;
        global $db;
       // $stmt = $this->connect()->prepare("SELECT users_pwd FROM users WHERE users_uid = ? OR users_email = ?;");
        $stmt = $db->prepare("SELECT users_pwd FROM users WHERE users_uid = ? OR users_email = ?;");

        if (!$stmt->execute(array($uid,$uid))){
            $stmt = null;
            header("location: ../view/login.php?error=stmtfailed");
            exit();
        }

        if($stmt->rowCount() == 0){
          $stmt = null;
          header("location: ../view/login.php?error=usernotfound");
          exit();
        }

        
        $pwdHashed = $stmt->fetchAll(PDO::FETCH_ASSOC);
        $checkPwd = password_verify($pwd,$pwdHashed[0]["users_pwd"]);
        
        //$pwdHashed = $stmt->fetch();
        //$checkPwd = password_verify($pwd,$pwdHashed["users_pwd"]);

        if($checkPwd == false){
            $stmt = null;
            header("location: ../view/login.php?error=wrongpassword");
            exit();
        }
        elseif($checkPwd == true){
            $stmt = $db->prepare("SELECT * FROM users WHERE users_uid = ? OR users_email = ? AND users_pwd = ?;");
           
            if (!$stmt->execute(array($uid,$uid,$pwd))){
                $stmt = null;
                header("location: ../view/login.php?error=stmtfailed");
                exit();
            }

            if($stmt->rowCount() == 0){
                $stmt = null;
                header("location: ../view/login.php?error=usernotfound");
                exit();
              }
            
            $user = $stmt->fetchAll(PDO::FETCH_ASSOC);

            session_start();
            $_SESSION["userid"] = $user[0]["users_id"];
            $_SESSION["useruid"] = $user[0]["users_uid"];

          

        }
        $stmt = null;
        
    }


}