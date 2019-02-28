<?php
function getPosts(){
    $q="
    SELECT posts.id,title,content,created_at as posted_at,user_id,users.name as posted_by
    from posts inner join users on users.id=posts.user_id";

    $con=mysqli_connect('localhost','root','','clean_blog');    
    $query=mysqli_query($con,$q);

    $posts=[];

    while($row=mysqli_fetch_array($query)){
        array_push($posts,$row);
    }

    mysqli_close($con);
    return $posts;
}
?>