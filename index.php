<?php 
session_start();
var_dump($_SESSION['user']['is_admin']);
require_once 'layouts/header.php';
require_once 'helpers/posts.php';
$posts=getPosts();
?>

  <!-- Main Content -->
  <div class="container">
    <div class="row">
      <div class="col-lg-8 col-md-10 mx-auto">
        <?php
//foreach on the posts
//echo title, content, posted_by,posted_at in the correct place
//href  = posts.php?id=1
          foreach ($posts as $p) {
            //var_dump($p);
          ?>
        <div class="post-preview">
          <a href="posts.php?id=<?php echo $p['id'];?>">
            <h2 class="post-title">
              <?php echo $p['title'];?>
            </h2>
            <h3 class="post-subtitle">
            <?php echo $p['content'];?>
            </h3>
          </a>
          <p class="post-meta">Posted by
            <a href="#"><?php echo $p['posted_by'];?></a>
            on <?php echo $p['posted_at'];?></p>
        </div>
        <hr>

          <?php
          }
          ?>
        <!-- Pager -->
        <div class="clearfix">
          <a class="btn btn-primary float-right" href="#">Older Posts &rarr;</a>
        </div>
      </div>
    </div>
  </div>

  <hr>

  <?php require_once 'layouts/footer.php';?>