<?php
require_once 'helpers/users.php';
if(isset($_POST['username']) && isset($_POST['password'])){
  if(checkUser($_POST['username'],$_POST['password'])){
    echo 'Success';
  }
  else{
    echo 'Fail';
  }  
}

require_once('layouts/header.php');

?>
  <!-- Post Content -->
  <article>
    <div class="container">
      <div class="row">
        <div class="col-lg-8 col-md-10 mx-auto">
          <form method="POST" action="login.php">
          <input class="form-control" type="text" placeholder="User name" name="username" />
          <input class="form-control" type="password" placeholder="Password" name="password" />
          <button class="btn btn-primary" type="submit" name="submit">Login</button>
          </form>
        </div>
      </div>
    </div>
  </article>

  <hr>
<?php require_once('layouts/footer.php')?>