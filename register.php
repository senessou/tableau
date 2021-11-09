<?php

require_once (__DIR__ . '/config/database.php');

if($_POST) {
  $name = htmlspecialchars($_POST['username']);
  $lastname = htmlspecialchars($_POST['lastname']);
  $email = htmlspecialchars($_POST['email']);
  $type = htmlspecialchars($_POST['type']);
  $pass = htmlspecialchars($_POST['password']);
  $confir_password = htmlspecialchars($_POST['confirmpassword']);

    if($pass == $confir_password ) {

        $sql = "INSERT INTO user (name, lastName, privilege, email, password) VALUES (?, ?, ?, ?, ?)";

        $password = password_hash($pass, PASSWORD_BCRYPT);
        

        $stm = $pdo->prepare($sql)->execute(array($name, $lastname, $type, $email, $password));

        header("Location: login.php");
        exit();
    }
    else {
        $ereur = "Mode de passe incorrect";
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
                                <h1 class="h4 text-gray-900 mb-4">Register Here!</h1>
                            </div>

                            <form method="POST">

                                <div class="modal-body">

                                    <div class="form-group">
                                        <label for="nom">FirtsName</label>
                                        <input type="text" id="nom" name="username" class="form-control" placeholder="Enter Username">
                                    </div>
                                    <div class="form-group">
                                        <label for="prenom">LastName</label>
                                        <input type="text" id="prenom" name="lastname" class="form-control" placeholder="Enter Username">
                                    </div>
                                    <div class="form-group">
                                        <label for="type">Privilège</label>
                                        <select name="type" id="type" class="form-control">
                                            <option value="Admin">Administrateur</option>
                                            <option value="User">Utilisateur</option>
                                        </select>
                                    </div>
                                    <div class="form-group">
                                        <label for="email">Email</label>
                                        <input type="email" id="email" name="email" class="form-control" placeholder="Enter Email">
                                    </div>
                                    <div class="form-group">
                                        <label for="pass">Password</label>
                                        <input type="password" id="pass" name="password" class="form-control" placeholder="Enter Password">
                                    </div>
                                    <div class="form-group">
                                        <label for="passconfir">Confirm Password</label>
                                        <input type="password" id="passconfir" name="confirmpassword" class="form-control" placeholder="Confirm Password">
                                    </div>

                                    <?php if($password != $confir_password) { ?>
                                        <p class="text-danger"><?=$ereur?></p>
                                    <?php } ?>
    
                                    <div class="form-group">
                                    <button type="submit" name="registerbtn" class="btn btn-primary">Inscription</button>
                                    </div>
                                </div>

                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>

    </div>

</div>

</div>
