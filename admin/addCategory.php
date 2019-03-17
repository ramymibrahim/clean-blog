<?php
require_once '../layouts/header.php';
require_once '../helpers/categories.php';
require_once '../helpers/admin.php';
if(!canAdd()){
    header('Location:/index.php');
    die();
}
if(isset($_POST['name']) && isset($_FILES['image'])){
    $image=uploadImage($_FILES['image']);
    $error='';
    if(!$image){
        $error=$error."<br />Error while uploading image";
    }
    else{
        $result=insertCategory($_POST['name'],$image);
        if($result){
            header('Location:categories.php');
            die();
        }
        else{
            $error=$error."<br />Error while insert";
        }
    }
}
?>
<form action="addCategory.php" method="POST" enctype="multipart/form-data">    
    <input type="text" placeholder="Name" class="form-control" name="name" />    
    <input type="file" name="image" />
    <br />
    <button type="submit" class="btn btn-success">Add Category</button>
</form>
<?php
if(isset($error)){
    echo "<div class='alert alert-danger'>$error</div>";
}
?>
<?php
require_once '../layouts/footer.php';