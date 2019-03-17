<?php 
require_once 'layouts/header.php';
require_once 'helpers/posts.php';
if(isset($_GET['cat_id']))
  $cat_id=$_GET['cat_id'];
else
  $cat_id=null;
if(isset($_GET['page']))
  $page=$_GET['page'];
else
  $page=1;
if(isset($_GET['items']))
  $items=$_GET['items'];
else
  $items=10;
if(isset($_GET['keywords']))
  $keywords=$_GET['keywords'];
else
  $keywords='';

$posts=getPosts($cat_id,$page,$items,$keywords);
$count = getPostCount($cat_id,$keywords);
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
  <nav aria-label="Page navigation example">
  <ul class="pagination">
  <?php
$pageCount=ceil($count/$items);
if($page>1){
  $prev=$page-1;
  echo "<li class='page-item'><a class='page-link' href='index.php?page=$prev&items=$items&cat_id=$cat_id&keywords=$keywords'>Previous</a></li>";
}

for($i=1;$i<=$pageCount;$i++){  
  echo "<li class='page-item'><a class='page-link' href='index.php?page=$i&items=$items&cat_id=$cat_id&keywords=$keywords'>$i</a></li>";  
}
if($page<$pageCount){
  $nxt=$page+1;
  echo "<li class='page-item'><a class='page-link' href='index.php?page=$nxt&items=$items&cat_id=$cat_id&keywords=$keywords'>Next</a></li>";
}
?>
  </ul>
</nav>
<?php require_once 'layouts/footer.php';?>