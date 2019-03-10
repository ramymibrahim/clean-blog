<?php
require_once $base_dir.'\helpers\session.php';
function canView(){    
    if(!isset($_SESSION['user'])){
        return false;
    }
    if($_SESSION['user']['is_admin'] 
    || $_SESSION['user']['is_author']){
        return true;
    }
    return false;
}

function canAdd(){
    if(!isset($_SESSION['user'])){
        return false;
    }
    if($_SESSION['user']['is_author']){
        return true;
    }
    return false;
}

function canEdit($user_id){
    if(!isset($_SESSION['user']))
        return false;
    if($_SESSION['user']['is_admin'])
        return true;
    else if($_SESSION['user']['is_author'] 
    && $_SESSION['user']['id']==$user_id)
        return true;
    return false;
}

function canDelete($user_id){
    return canEdit($user_id);
}

function uploadImage($image){
    return 'img/1.jpg';
}