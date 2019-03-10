<?php
require_once '../layouts/header.php';
require_once '../helpers/posts.php';
if($user==null){
    header('Location:/index.php');
    die();
}
if($user['is_admin']){
    $posts=getPosts();
}
else if($user['is_author']){
    $posts=getPostsByAuthorId($user['id']);
}
else{
    header('Location:/index.php');
    die();
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
            <form action="deletePost.php" method="POST">
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