<?php

class Signup {

    protected function setUser($uid, $pwd, $email){
        global $db;
        // znaki zapytania sluzą jak place holdery;
        $stmt = $db->prepare("INSERT INTO users (users_uid, users_pwd, users_email) VALUES (?, ?, ?);");

        $hashedPwd = password_hash($pwd, PASSWORD_DEFAULT);

        if (!$stmt->execute(array($uid,$hashedPwd,$email))){
            $stmt = null;
            header("location: ../view/login?error=stmtfailed");
            exit();
        }

        $stmt = null;
    }

        protected function checkUser($uid, $email){
            global $db;
            // znaki zapytania sluzą jak place holdery;
            $stmt = $db->prepare("SELECT users_id FROM users WHERE users_id = ? OR users_email= ?;");

            if (!$stmt->execute(array($uid,$email))){
                $stmt = null;
                header("location: ../view/login.php?error=stmtfailed");
                exit();
            }

            if($stmt->rowCount() > 0){
                $resultCheck = false;
            } else {
                $resultCheck = true;
            }

            return $resultCheck;
        }


}