<?php
require_once '../layouts/header.php';
require_once '../helpers/posts.php';
require_once '../helpers/admin.php';
if(!canAdd()){
    header('Location:/index.php');
    die();
}
if(isset($_POST['title']) && isset($_FILES['image'])){
    $image=uploadImage($_FILES['image']);
    $error='';
    if(!$image){
        $error=$error."<br />Error while uploading image";
    }
    else{
        $result=insertPost($_POST['title'],$_POST['content'],$image,$_POST['category_id'],$user['id']);
        if($result){
            header('Location:posts.php');
            die();
        }
        else{
            $error=$error."<br />Error while insert";
        }
    }
}
?>
<form action="addPost.php" method="POST" enctype="multipart/form-data">

    <select class="form-control" name="category_id">
        <?php
        
        foreach ($cat as $cats) {
            $id=$cats['id'];
            $name=$cats['name'];
            echo "<option value='$id'>$name</option>";
        }
        ?>
    </select>
    <input type="text" placeholder="Title" class="form-control" name="title" />
    <textarea class="form-control" placeholder="Content" name="content"></textarea>
    <input type="file" name="image" />
    <br />
    <button type="submit" class="btn btn-success">Add Post</button>
</form>
<?php
if(isset($error)){
    echo "<div class='alert alert-danger'>$error</div>";
}
?>
<?php
require_once '../layouts/footer.php';