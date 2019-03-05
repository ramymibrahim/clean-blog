<?php

require_once('helpers/posts.php');
if(isset($_GET['id'])){
  $post=getPost($_GET['id']);
  $head_img=$post['image'];
  $head_title=$post['title'];
  $user=$post['posted_by'];
  $user_id=$post['user_id'];
  $head_subtitle="<a href='authors.php?id=$user_id'>Created by $user</a>";
}
else{
  header('Location:index.php');
}
require_once('layouts/header.php');
?>
  <!-- Post Content -->
  <article>
    <div class="container">
      <div class="row">
        <div class="col-lg-8 col-md-10 mx-auto">
          <?php echo $post['content'];?>
        </div>
      </div>
    </div>
  </article>

  <hr>
<?php require_once('layouts/footer.php')?>