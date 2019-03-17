<?php
require_once '../layouts/header.php';
require_once '../helpers/categories.php';
require_once '../helpers/admin.php';
//Check if the user can view the posts page
if(!canView()){
    header("Location:$base_url/index.php");
    die();
}

//Check if a delete request is sent from this page
if(isset($_POST['id'])){    
         
        if(canDelete(0)){            
            deleteCategory($_POST['id']);
        }    
}

if($user['is_admin']){
    $categories=getCategories();
}

?>
<a href="addCategory.php" class="btn btn-success">Add Category</a>
<table class='table'>
    <tr>
        <th>id</th>
        <th>name</th>
        <th>image</th>
        <th>edit</th>
        <th>delete</th>
    </tr>
    <?php
    foreach($categories as $category){
    ?>
    <tr>
        <td><?php echo $category['id'];?></td>
        <td><?php echo $category['name'];?></td>
        <td><img src="<?php echo $base_url.'/'.$category['image'];?>" width="250" height="250" /></td>
        <td>
            <a href="editCategory.php?id=<?php echo $category['id'];?>" class="btn btn-primary">
            Edit
            </a>
        </td>
        <td>
            <form action="categories.php" method="POST">
                <input type="hidden" value="<?php echo $category['id'];?>" name="id" />
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