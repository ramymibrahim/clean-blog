<?php
//Add base url for images,css and js files
//Add Base dir for include or require
$base_url = "/clean-blog";
$base_dir = $_SERVER["DOCUMENT_ROOT"].'/clean-blog';
require_once $base_dir.'/helpers/session.php';
$loggedIn = ($user != null);
require_once $base_dir.'/helpers/categories.php';

$cat = getCategories();
?>
<!DOCTYPE html>
<html lang="en">

<head>

  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <meta name="description" content="">
  <meta name="author" content="">

  <title>Clean Blog - Native PHP - AMIT Project</title>

  <!-- Bootstrap core CSS -->
  <link href="<?php echo $base_url?>/vendor/bootstrap/css/bootstrap.min.css" rel="stylesheet">

  <!-- Custom fonts for this template -->
  <link href="<?php echo $base_url?>/vendor/fontawesome-free/css/all.min.css" rel="stylesheet" type="text/css">
  <link href='https://fonts.googleapis.com/css?family=Lora:400,700,400italic,700italic' rel='stylesheet' type='text/css'>
  <link href='https://fonts.googleapis.com/css?family=Open+Sans:300italic,400italic,600italic,700italic,800italic,400,300,600,700,800' rel='stylesheet' type='text/css'>

  <!-- Custom styles for this template -->
  <link href="<?php echo $base_url?>/css/clean-blog.min.css" rel="stylesheet">

</head>

<body>

  <!-- Navigation -->
  <nav class="navbar navbar-expand-lg navbar-light fixed-top" id="mainNav">
    <div class="container">
      <a class="navbar-brand" href="<?php echo $base_url; ?>">Start Bootstrap</a>
      <button class="navbar-toggler navbar-toggler-right" type="button" data-toggle="collapse" data-target="#navbarResponsive" aria-controls="navbarResponsive" aria-expanded="false" aria-label="Toggle navigation">
        Menu
        <i class="fas fa-bars"></i>
      </button>
      <div class="collapse navbar-collapse" id="navbarResponsive">
        <ul class="navbar-nav ml-auto">
          <li class="nav-item">
            <a class="nav-link" href="<?php echo $base_url; ?>">Home</a>
          </li>
          <li class="nav-item dropdown">
            <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">Categories</a>
            <div class="dropdown-menu" aria-labelledby="navbarDropdown">
              <a class="dropdown-item" href="<?php echo $base_url; ?>">All</a>
              <div class="dropdown-divider"></div>
              <?php
foreach ($cat as $cats) {
    echo '<a class="dropdown-item" href="' . $base_url . '/categories.php?id=' . $cats['id'] . '">' . $cats['name'] . '</a>';
}
?>
            </div>
          </li>
          <?php
if (!$loggedIn) {
    ?>


          <li class="nav-item">
            <a class="nav-link" href="login.php">Login</a>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="register.php">Register</a>
          </li>
          <?php
} else {
    if ($user['is_author']) {
        ?>

<li class="nav-item dropdown">
            <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">Author</a>
            <div class="dropdown-menu" aria-labelledby="navbarDropdown">
              <a class="dropdown-item" href="admin/posts.php">Posts</a>
              </div>
              </li>


<?php
}
    if ($user['is_admin']) {
        ?>
<?php
}
    ?>
            <li class="nav-item">
            <a class="nav-link" href="logout.php">Logout</a>
          </li>
            <?php
}
?>
        </ul>
      </div>
    </div>
  </nav>
<?php
if (!isset($head_img)) {
    $head_img = $base_url.'/img/home-bg.jpg';
}
if (!isset($head_title)) {
    $head_title = 'Clean Blog';
}
if (!isset($head_subtitle)) {
    $head_subtitle = 'A Blog Theme by Start Bootstrap';
}
?>
  <!-- Page Header -->
  <header class="masthead" style="background-image: url('<?php echo $head_img; ?>')">
    <div class="overlay"></div>
    <div class="container">
      <div class="row">
        <div class="col-lg-8 col-md-10 mx-auto">
          <div class="site-heading">
            <h1><?php echo $head_title; ?></h1>
            <span class="subheading"><?php echo $head_subtitle; ?></span>
          </div>
        </div>
      </div>
    </div>
  </header>