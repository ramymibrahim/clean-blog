<?php
require_once('database.php');

function getPosts($cat_id=null,$page=1,$items=10,$keywords=''){
    $q="SELECT posts.id,title,content,created_at as posted_at
    ,user_id,users.name as posted_by
    from posts inner join users on users.id=posts.user_id WHERE 1=1";

    if($cat_id!=null){
        $q=$q." AND posts.category_id=$cat_id";
    }
    if(!empty($keywords)){
        $q=$q." AND (posts.title like '%$keywords%' or posts.content like '%$keywords%')";
    }
    $start=($page-1)*$items;
    $end=$start+$items;
    $q=$q." limit $start,$end";
    return getRows($q);
}

function getPost($id){
    $q="SELECT posts.id,posts.category_id,title,content,posts.image,created_at as posted_at
    ,user_id,users.name as posted_by
    from posts inner join users on users.id=posts.user_id 
    WHERE posts.id=$id";
    return getRow($q);
}
function getPostsByAuthorId($id){
    $q="SELECT posts.id,title,content,created_at as posted_at
    ,user_id,users.name as posted_by
    from posts inner join users on users.id=posts.user_id
     WHERE posts.user_id=$id";    
    return getRows($q);
}

function insertPost($title,$content,$image,$category_id,$user_id){
    $q="INSERT INTO posts(id,title,content,image,category_id,user_id) values(
        null,'$title','$content','$image',$category_id,$user_id
    )";
    return executeQuery($q);
}

function updatedPost($id,$title,$content,$image){
    $q="UPDATE posts set title='$title',content='$content'
    ,image='$image' WHERE id=$id;";     
     return executeQuery($q);
}

function deletePost($id){
    $q="delete from posts where id=$id";
    return executeQuery($q);
}

function getComments($post_id){
    $q="SELECT comments.*,users.name as user_name,users.image FROM 
    comments inner join 
    users on users.id=comments.user_id
    where post_id=$post_id";
    return getRows($q);
}

function insertComment($user_id,$post_id,$comment){
    $q="INSERT INTO comments(id,user_id,post_id,comment) values
    (null,$user_id,$post_id,'$comment')";    
    return executeQuery($q);
}

function getPostCount($cat_id=null,$keywords=''){
    $q="SELECT count(0) FROM posts where 1=1";
    if($cat_id!=null)
        $q=$q." AND category_id=$cat_id";
    if(!empty($keywords))
        $q=$q." AND (title like '%$keywords%' or content like '%$keywords%')";
    $count = getRow($q);
    return $count[0];
}
?>