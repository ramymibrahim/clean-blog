<?php
require_once '../layouts/header.php';
require_once '../helpers/users.php';
require_once '../helpers/admin.php';
if(!isset($_GET['id'])){
    header('Location:users.php');
    die();
}
$id=$_GET['id'];
$user=getUser($id);
if($user==null){
    header('Location:users.php');
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
        $image=$user['image'];
    }
    if($error==''){  
        $is_admin=0;$is_author=0;
        if(isset($_POST['is_admin']))
            $is_admin=1;
        if(isset($_POST['is_author']))
            $is_author=1;

        //$id,$name,$image,$username,$password,$is_admin,$is_author
        $result=updatedUser($user['id'],$_POST['name'],$image,$_POST['username'],$_POST['password'],$is_admin,$is_author);
        if($result){
            header('Location:users.php');
            die();
        }
        else{
            $error=$error."<br />Error while update";
        }
    }
}
?>
<form action="editUser.php?id=<?php echo $user['id'];?>" method="POST" enctype="multipart/form-data">
<input type="text" placeholder="Name" class="form-control" name="name" value="<?php echo $user['name']?>"/>    
<input type="text" placeholder="UserName" class="form-control" name="username" value="<?php echo $user['username']?>"/>    
<input type="text" placeholder="Password" class="form-control" name="password" value=""/>    
<label>Is Author</label><input type="checkbox"  name="is_author" <?php if($user['is_author']){echo 'checked';}?>/>    
<label>Is Admin</label><input type="checkbox"  name="is_admin" <?php if($user['is_admin']){echo 'checked';}?>/>
    <img width="250" height="250" src="<?php echo $base_url.'/'.$user['image'];?>" /><br />
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