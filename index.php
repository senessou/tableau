<?php
require_once (__DIR__ . '/config/database.php');

if(isset($_SESSION['user'])) {
  header("Location: dashboard.php");
  exit();
}

if($_POST) {

  $stm = $pdo->query("SELECT * FROM user WHERE email='".$_POST['email']."'");
  $user = $stm->fetch(PDO::FETCH_ASSOC);
  
  if(password_verify($_POST['password'], $user['password'])) {

    $_SESSION['user'] = $user['name'];
    
    if($user['privilege'] == "Admin") {
      header("Location: dashboard.php");
      exit();
    }
    else {
      header("Location: accueil.php");
      exit();
    }
    
  }

}
require_once (__DIR__ . '/includes/header.php');
?>

<div class="container">

<!-- Outer Row -->
<div class="row justify-content-center">

  <div class="col-xl-6 col-lg-6 col-md-6">

    <div class="card o-hidden border-0 shadow-lg my-5">
<div class="card-body p-0">
        <!-- Nested Row within Card Body -->
        <div class="row">
          <div class="col-lg-12">
            <div class="p-5">
              <div class="text-center">
                <h1 class="h4 text-gray-900 mb-4">Login Here!</h1>
              </div>

                <form class="user" action="" method="POST">

                    <div class="form-group">
                    <input type="email" name="email" class="form-control form-control-user" placeholder="Enter Email Address...">
                    </div>
                    <div class="form-group">
                    <input type="password" name="password" class="form-control form-control-user" placeholder="Password">
                    </div>
            
                    <button type="submit" name="login_btn" class="btn btn-primary btn-user btn-block"> Login </button>
                    <hr>
                </form>

                <a class="btn btn-primary" href="./register.php">Register here</a>
            </div>
          </div>
        </div>
      </div>  
    </div>

  </div>

</div>

</div>


<?php
require_once (__DIR__ . '/includes/scripts.php');
?>