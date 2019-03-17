<?php
require_once 'session.php';
require_once 'database.php';
function checkUser($username,$password){
    $password=getHash($username,$password);
    $q="SELECT * from users where username='$username' and password='$password'";
    $user = getRow($q);
    if($user!=null){
        $_SESSION['user']=$user;
        return true;
    }        
    else
        return false;
}


function getUsers($q){
    return getRows("SELECT * from users WHERE name like '%$q%' or username like '%$q%'");
}

function getUser($id){
    return getRow("SELECT * from users where id=$id");
}

function insertUser($name,$image,$username,$password,$is_admin,$is_author){
    $password=getHash($username,$password);
    $q="INSERT INTO users(id,name,username,password,is_admin,is_author,image) values(
        null,'$name','$username','$password',$is_admin,$is_author,'$image'
    )";
    return executeQuery($q);
}

function updatedUser($id,$name,$image,$username,$password,$is_admin,$is_author){
    $passwordStatement='';
    if($password!=''){
        $password=getHash($username,$password);
        $passwordStatement=",password='$password'";
    }
    $q="UPDATE users set name='$name',username='$username',is_author=$is_author,is_admin=$is_admin
        ,image='$image' $passwordStatement WHERE id=$id;"; 
     return executeQuery($q);
}

function deleteUser($id){
    $q="delete from users where id=$id";
    return executeQuery($q);
}
function setAdmin($id){
    $q="update users set is_admin=1 where id=$id";
    return executeQuery($q);
}
function setNotAdmin($id){
    $q="update users set is_admin=0 where id=$id";
    return executeQuery($q);
}
function setAuthor($id){
    $q="update users set is_author=1 where id=$id";
    return executeQuery($q);
}
function setNotAuthor($id){
    $q="update users set is_author=0 where id=$id";
    return executeQuery($q);
}

function getHash($username,$password){
    return md5($username.$password);
}

