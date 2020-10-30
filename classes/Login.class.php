<?php

//Login user to admin-page

class Login {
    public function loginUser($username, $password) {
            if($username == "" && $password == "") {
                $_SESSION["username"] = $username;
                return true;
            } else {
                return false;
            }
        }
    }
