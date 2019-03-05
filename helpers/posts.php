<?php
require_once('database.php');

function getPosts($cat_id=null){
    $q="SELECT posts.id,title,content,created_at as posted_at
    ,user_id,users.name as posted_by
    from posts inner join users on users.id=posts.user_id";

    if($cat_id!=null){
        $q=$q." WHERE posts.category_id=$cat_id";
    }
    return getRows($q);
}

function getPost($id){
    $q="SELECT posts.id,title,content,posts.image,created_at as posted_at
    ,user_id,users.name as posted_by
    from posts inner join users on users.id=posts.user_id 
    WHERE posts.id=$id";
    return getRow($q);
}
?>