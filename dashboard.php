<?php
require_once (__DIR__ . '/config/database.php');

$rows = [];

if($_POST) {
    if(isset($_POST['registerbtn'])) {
        if($_POST['pass'] == $_POST['pass1']) {
            $sql = "INSERT INTO user (name, lastName, privilege, email, password) VALUES (?, ?, ?, ?, ?) ";
            $pass = password_hash($_POST['pass'], PASSWORD_BCRYPT);
            $stm = $pdo->prepare($sql);
            $stm->execute(array($_POST['firstname'], $_POST['lastname'], $_POST['privilege'], $_POST['email'], $_POST['pass']));
            
        }
    }

    $stm = $pdo->prepare("SELECT * FROM user WHERE name LIKE  ? ");
    $stm->bindValue(1, '%' .$_POST['name']. '%');
    $stm->execute();

    $rows = $stm->fetchAll(PDO::FETCH_ASSOC);
}
else {
    $stm = $pdo->query("SELECT * FROM user");
    $rows = $stm->fetchAll(PDO::FETCH_ASSOC);
}

require_once (__DIR__ . '/includes/header.php');
require_once (__DIR__ . '/includes/navbar.php');

?>

    <div class="modal fade" id="addadminprofile" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Add Admin Data</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <form action="" method="POST">

                    <div class="modal-body">

                        <div class="form-group">
                            <label for="nom"> Nom </label>
                            <input type="text" id="nom" name="firstname" class="form-control" placeholder="Enter Username">
                        </div>
                        <div class="form-group">
                            <label for="prenom"> Prenom </label>
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
                            <label for="mail">Email</label>
                            <input type="email" id="mail" name="email" class="form-control" placeholder="Enter Email">
                        </div>
                        <div class="form-group">
                            <label for="pass">Password</label>
                            <input type="password" id="pass" name="password" class="form-control" placeholder="Enter Password">
                        </div>
                        <div class="form-group">
                            <label for="pass1">Confirm Password</label>
                            <input type="password" id="pass1" name="confirmpassword" class="form-control" placeholder="Confirm Password">
                        </div>

                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                        <button type="submit" name="registerbtn" class="btn btn-primary">Save</button>
                    </div>
                </form>

            </div>
        </div>
    </div>


    <div class="container-fluid">

        <!-- DataTales Example -->
        <div class="card shadow mb-4">
            <div class="card-header py-3">
                <h6 class="m-0 font-weight-bold text-primary">Admin Profile
                    <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#addadminprofile">
                        Add Admin Profile
                    </button>
                </h6>
            </div>

            <div class="card-body">

                <div class="table-responsive">

                    <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                        <thead>
                        <tr>
                            <th> ID </th>
                            <th>Nom</th>
                            <th>Prenom</th>
                            <th>Privilège</th>
                            <th>Email </th>
                            <th>Password</th>
                            <th>EDIT </th>
                            <th>DELETE </th>
                        </tr>
                        </thead>
                        <tbody>

                        <?php foreach( $rows as $row) {?>
                            <tr>
                                <td><?=$row['id']?></td>
                                <td><?=$row['name']?></td>
                                <td><?=$row['lastName']?></td>
                                <td><?=$row['privilege']?></td>
                                <td><?=$row['email']?></td>
                                <td><?=$row['password']?></td>
                                <td>
                                <a href="./update.php?id=<?=$row['id']?>" class="btn btn-success"> EDIT</a>
                                </td>
                                <td>
                                <a href="./delete.php?id=<?=$row['id']?>" class="btn btn-danger"> DELETE</a>
                                </td>
                            </tr>
                        <?php }?>
                        
                        </tbody>
                    </table>

                </div>
            </div>
        </div>

    </div>
    <!-- /.container-fluid -->

<?php
require_once (__DIR__ . '/includes/scripts.php');
require_once (__DIR__ . '/includes/footer.php');
?>