<?php
require_once 'helpers/posts.php';
require_once 'helpers/session.php';
if (isset($_GET['id'])) {
    $post = getPost($_GET['id']);
    $head_img = $post['image'];
    $head_title = $post['title'];
    $user_name = $post['posted_by'];
    $user_id = $post['user_id'];
    $head_subtitle = "<a href='authors.php?id=$user_id'>Created by $user_name</a>";
} else {
    header('Location:index.php');
}

$commentError='';
if(isset($_POST['comment']) && isset($user)){
  if(!insertComment($user['id'],$post['id'],$_POST['comment'])){
    $commentError='Error while adding comment';
  }
}

$comments=getComments($post['id']);
require_once 'layouts/header.php';
?>
  <!-- Post Content -->
  <article>
    <div class="container">
      <div class="row">
        <div class="col-lg-8 col-md-10 mx-auto">
          <?php echo $post['content']; ?>
        </div>
      </div>
    </div>
  </article>

<?php
foreach($comments as $comment){
  ?>
    <article>
    <div class="container">
      <div class="row">
        <div class="col-lg-8 col-md-10 mx-auto">
          <?php echo $comment['comment']." - Posted By ".$comment['user_name']." - Posted At:".$comment['created_at']; ?>
        </div>
      </div>
    </div>
  </article>
  <hr>
  <?php
}
if (isset($user)) {
    ?>
  <div class="row">
    <div class="col-md-8 offset-md-2">
      <form action="posts.php?id=<?php echo $post['id'];?>" method="POST">
        <textarea name="comment" class="form-control"></textarea>
        <button class="btn btn-primary" type="submit">Please Type your Comment</button>
      </form>
      <?php 
      if($commentError!=''){
        echo "<div class='alert alert-danger'>$commentError</div>"; 
      }      
  ?>
    </div>
  </div>
  <?php
}
?>
  
<?php require_once 'layouts/footer.php'?>