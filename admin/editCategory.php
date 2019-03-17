<?php
require_once '../layouts/header.php';
require_once '../helpers/categories.php';
require_once '../helpers/admin.php';
if(!isset($_GET['id'])){
    header('Location:categories.php');
    die();
}
$id=$_GET['id'];
$category=getCategory($id);
if($category==null){
    header('Location:categories.php');
    die();
}
if(!canEdit(0)){
    header("Location:$base_url/index.php");
    die();
}

if(isset($_POST['name'])){
    $error='';
    if(!empty($_FILES['image']['name'])){        
        $image=uploadImage($_FILES['image']);
        if(!$image){
            $error=$error."<br />Error while uploading image";
        }
    }
    else{
        $image=$category['image'];
    }
    if($error==''){        
        $result=updatedCategory($category['id'],$_POST['name'],$image);
        if($result){
            header('Location:categories.php');
            die();
        }
        else{
            $error=$error."<br />Error while update";
        }
    }
}
?>
<form action="editCategory.php?id=<?php echo $category['id'];?>" method="POST" enctype="multipart/form-data">
    <input type="text" placeholder="Name" class="form-control" name="name" value="<?php echo $category['name']?>"/>    
    <img width="250" height="250" src="<?php echo $base_url.'/'.$category['image'];?>" /><br />
    <input type="file" name="image" />
    <br />
    <button type="submit" class="btn btn-success">Update Cateogory</button>
</form>
<?php
if(isset($error)){
    echo "<div class='alert alert-danger'>$error</div>";
}
?>
<?php
require_once '../layouts/footer.php';