<?php
session_start();
require_once 'database.php';
function checkUser($username,$password){
    $q="SELECT * from users where username='$username' and password='$password'";
    $user = getRow($q);
    if($user!=null){
        $_SESSION['user']=$user;
        return true;
    }        
    else
        return false;
}