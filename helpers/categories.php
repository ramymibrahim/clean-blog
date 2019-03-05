<?php
require_once('database.php');
function getCategories(){
    return getRows("SELECT id,name from categories");
}

function getCategory($id){
    return getRow("SELECT id,name,image from categories where id=$id");
}
?>