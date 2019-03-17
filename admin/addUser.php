<?php
require_once '../layouts/header.php';
require_once '../helpers/users.php';
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
        $is_admin=0;$is_author=0;
        if(isset($_POST['is_admin']))
            $is_admin=1;
        if(isset($_POST['is_author']))
            $is_author=1;
        $result=insertUser($_POST['name'],$image,$_POST['username'],$_POST['password'],$is_admin,$is_author);
        if($result){
            header('Location:users.php');
            die();
        }
        else{
            $error=$error."<br />Error while insert";
        }
    }
}
?>
<form action="addUser.php" method="POST" enctype="multipart/form-data">    
    <input type="text" placeholder="Name" class="form-control" name="name" />    
    <input type="text" placeholder="UserName" class="form-control" name="username" value="<?php echo $user['username']?>"/>    
<input type="text" placeholder="Password" class="form-control" name="password" value="<?php echo $user['password']?>"/>    
 <label>IS Author</label><input type="checkbox"name="is_author" value="<?php echo $user['is_author']?>"/>    
 <label>IS Admin</label><input type="checkbox"  name="is_admin" value="<?php echo $user['is_admin']?>"/>
    <input type="file" name="image" />
    <br />
    <button type="submit" class="btn btn-success">Add User</button>
</form>
<?php
if(isset($error)){
    echo "<div class='alert alert-danger'>$error</div>";
}
?>
<?php
require_once '../layouts/footer.php';