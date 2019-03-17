<?php
require_once '../layouts/header.php';
require_once '../helpers/users.php';
require_once '../helpers/admin.php';
//Check if the user can view the posts page
if(!canView()){
    header("Location:$base_url/index.php");
    die();
}

//Check if a delete request is sent from this page
if(isset($_POST['id']) && isset($_POST['action'])){    
    if(canDelete(0)){
        if($_POST['action']=='delete')
            deleteUser($_POST['id']);
        elseif($_POST['action']=='setadmin')
            setAdmin($_POST['id']);
        elseif($_POST['action']=='setnotadmin')
            setNotAdmin($_POST['id']);
        elseif($_POST['action']=='setauthor')
            setAuthor($_POST['id']);
        elseif($_POST['action']=='setnotauthor')
            setNotAuthor($_POST['id']);
    }    
}

if($user['is_admin']){
    $search='';
    if(isset($_GET['search']))
        $search=$_GET['search'];
    $users=getUsers($search);
}

?>
<form action="users.php" method="GET">
<input name="search" class="form-control" value="<?php echo $search;?>" />
<button type="submit">Search</button>
</form>
<a href="addUser.php" class="btn btn-success">Add User</a>
<table class='table'>
    <tr>
        <th>id</th>
        <th>name</th>
        <th>username</th>
        <th>image</th>
        <th>edit</th>
        <th>delete</th>
        <th>IsAdmin</th>
        <th>IsAuthor</th>
    </tr>
    <?php
    foreach($users as $user){
    ?>
    <tr>
        <td><?php echo $user['id'];?></td>
        <td><?php echo $user['name'];?></td>
        <td><?php echo $user['username'];?></td>        
        <td><img src="<?php echo $base_url.'/'.$user['image'];?>" width="250" height="250" /></td>
        <td>
            <a href="editUser.php?id=<?php echo $user['id'];?>" class="btn btn-primary">
            Edit
            </a>
        </td>
        <td>
            <form action="users.php" method="POST">
                <input type="hidden" value="<?php echo $user['id'];?>" name="id" />
                <input type="hidden" value="delete" name="action" />
                <button type="submit" class="btn btn-danger" onclick="return confirm('Are you sure?')">Delete</button>
            </form>            
        </td>

        <td>
            <form action="users.php" method="POST">
                <input type="hidden" value="<?php echo $user['id'];?>" name="id" />
                <?php
                if($user['is_admin']){
?>
<input type="hidden" value="setnotadmin" name="action" />
<button type="submit" class="btn btn-secondary" onclick="return confirm('Are you sure?')">Set NotAdmin</button>
<?php
                }
                else{
?>
<input type="hidden" value="setadmin" name="action" />
<button type="submit" class="btn btn-secondary" onclick="return confirm('Are you sure?')">Set Admin</button>
<?php
                }
                ?>
                
            </form>            
        </td>

        <td>
            <form action="users.php" method="POST">
                <input type="hidden" value="<?php echo $user['id'];?>" name="id" />
                <?php
                if($user['is_author']){
?>
<input type="hidden" value="setnotauthor" name="action" />
<button type="submit" class="btn btn-secondary" onclick="return confirm('Are you sure?')">Set NotAuthor</button>
<?php
                }
                else{
?>
<input type="hidden" value="setauthor" name="action" />
<button type="submit" class="btn btn-secondary" onclick="return confirm('Are you sure?')">Set Author</button>
<?php
                }
                ?>

            </form>            
        </td>
    </tr>
    <?php
    }
    ?>
</table>
<?php
require_once '../layouts/footer.php';