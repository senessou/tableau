<?php
require_once (__DIR__ . '/config/database.php');

if($_POST) {
    if($_POST['password'] == $_POST['confirmpassword']) {
        $data = [
            'name' => $_POST['name'],
            'lastname' => $_POST['lastname'],
            'type' => $_POST['type'],
            'email' => $_POST['email'],
            'password' => $_POST['password'],
            'id' => $_GET['id']
        ];
        $sql = "UPDATE user SET name=:name, lastName=:lastname, privilege=:type, email=:email, password=:password WHERE id=:id";
        $stm = $pdo->prepare($sql)->execute($data);
            
        header("Location: dashboard.php");
        exit();
    }
    else {
        echo "mode de passe incorrecte";
    }
}

if($_GET) {
    $stm = $pdo->query("SELECT * FROM user WHERE id=" . $_GET['id']);
    $compte = $stm->fetch(PDO::FETCH_ASSOC);
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
                                        <input type="text" id="nom" name="username" class="form-control" placeholder="Enter Username" value="<?=$compte['name']?>">
                                    </div>
                                    <div class="form-group">
                                        <label for="prenom">LastName</label>
                                        <input type="text" id="prenom" name="lastname" class="form-control" placeholder="Enter Username"
                                        value="<?=$compte['lastName']?>">
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
                                        <input type="email" id="email" name="email" class="form-control" placeholder="Enter Email" value="<?=$compte['email']?>">
                                    </div>
                                    <div class="form-group">
                                        <label for="pass">Password</label>
                                        <input type="password" id="pass" name="password" class="form-control" placeholder="Enter Password" value="<?=$compte['password']?>">
                                    </div>
                                    <div class="form-group">
                                        <label for="passconfir">Confirm Password</label>
                                        <input type="password" id="passconfir" name="confirmpassword" class="form-control" placeholder="Confirm Password" value="<?=$compte['password']?>">
                                    </div>
    
                                    <div class="form-group">
                                    <button type="submit" name="registerbtn" class="btn btn-primary">Modifier</button>
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