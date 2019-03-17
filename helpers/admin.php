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
    $base_dir = $_SERVER["DOCUMENT_ROOT"].'/clean-blog/';    
    if($image['type']!='image/png' 
    && $image['type']!='image/jpg' 
    && $image['type']!='image/jpeg'){
        return false;
    }      
    $farr = explode(".",$image['name']);
    $ext = ".".$farr[count($farr)-1];
    $picture_name='img/'.date("U").(microtime(true)*10000).$ext;        
    $uploaded = move_uploaded_file($image['tmp_name'],$base_dir.$picture_name);
    if(!$uploaded){
        return false;
    }
    return $picture_name;
}