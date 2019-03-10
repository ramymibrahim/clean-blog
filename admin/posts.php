<?php
require_once '../layouts/header.php';
require_once '../helpers/posts.php';
require_once '../helpers/admin.php';
//Check if the user can view the posts page
if(!canView()){
    header("Location:$base_url/index.php");
    die();
}

//Check if a delete request is sent from this page
if(isset($_POST['id'])){
    //Get the post by id
    $temp_post=getPost($_POST['id']);
    //continue if the post is exists
    if($temp_post!=null){
        //check if the user has the permission to delete
        if(canDelete($temp_post['user_id'])){
            //delete the post
            deletePost($temp_post['id']);
        }
    }    
}

if($user['is_admin']){
    $posts=getPosts();
}
else if($user['is_author']){
    $posts=getPostsByAuthorId($user['id']);
}

?>
<a href="addPost.php" class="btn btn-success">Add Post</a>
<table class='table'>
    <tr>
        <th>id</th>
        <th>title</th>
        <th>author</th>
        <th>edit</th>
        <th>delete</th>
    </tr>
    <?php
    foreach($posts as $post){
    ?>
    <tr>
        <td><?php echo $post['id'];?></td>
        <td><?php echo $post['title'];?></td>
        <td><?php echo $post['posted_by'];?></td>
        <td>
            <a href="editPost.php?id=<?php echo $post['id'];?>" class="btn btn-primary">
            Edit
            </a>
        </td>
        <td>
            <form action="posts.php" method="POST">
                <input type="hidden" value="<?php echo $post['id'];?>" name="id" />
                <button type="submit" class="btn btn-danger" onclick="return confirm('Are you sure?')">Delete</button>
            </form>            
        </td>
    </tr>
    <?php
    }
    ?>
</table>
<?php
require_once '../layouts/footer.php';