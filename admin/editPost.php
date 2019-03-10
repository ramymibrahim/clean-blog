<?php
require_once '../layouts/header.php';
require_once '../helpers/posts.php';
require_once '../helpers/admin.php';
if(!isset($_GET['id'])){
    header('Location:posts.php');
    die();
}
$id=$_GET['id'];
$post=getPost($id);
if($post==null){
    header('Location:posts.php');
    die();
}
if(!canEdit($post['user_id'])){
    header("Location:$base_url/index.php");
    die();
}

if(isset($_POST['title'])){
    $error='';
    if(!empty($_FILES['image']['name'])){        
        $image=uploadImage($_FILES['image']);
        if(!$image){
            $error=$error."<br />Error while uploading image";
        }
    }
    else{
        $image=$post['image'];
    }
    if($error==''){        
        $result=updatedPost($post['id'],$_POST['title'],$_POST['content'],$image);
        if($result){
            header('Location:posts.php');
            die();
        }
        else{
            $error=$error."<br />Error while update";
        }
    }
}
?>
<form action="editPost.php?id=<?php echo $post['id'];?>" method="POST" enctype="multipart/form-data">

    <select class="form-control" name="category_id" disabled>
        <?php
        
        foreach ($cat as $cats) {
            $id=$cats['id'];
            $name=$cats['name'];
            if($id==$post['category_id'])
                echo "<option value='$id' selected='selected'>$name</option>";
            else
                echo "<option value='$id'>$name</option>";
        }
        ?>
    </select>
    <input type="text" placeholder="Title" class="form-control" name="title" value="<?php echo $post['title']?>"/>
    <textarea class="form-control" placeholder="Content" name="content"><?php echo $post['content']?></textarea>
    <img width="250" height="250" src="<?php echo $base_url.'/'.$post['image'];?>" /><br />
    <input type="file" name="image" />
    <br />
    <button type="submit" class="btn btn-success">Update Post</button>
</form>
<?php
if(isset($error)){
    echo "<div class='alert alert-danger'>$error</div>";
}
?>
<?php
require_once '../layouts/footer.php';