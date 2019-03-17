<?php
require_once('database.php');
function getCategories(){
    return getRows("SELECT id,name,image from categories");
}

function getCategory($id){
    return getRow("SELECT id,name,image from categories where id=$id");
}

function insertCategory($name,$image){
    $q="INSERT INTO categories(id,name,image) values(
        null,'$name','$image'
    )";
    return executeQuery($q);
}

function updatedCategory($id,$name,$image){
    $q="UPDATE categories set name='$name'
    ,image='$image' WHERE id=$id;";     
     return executeQuery($q);
}

function deleteCategory($id){
    $q="delete from categories where id=$id";
    return executeQuery($q);
}


?>