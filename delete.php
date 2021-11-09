<?php
require_once (__DIR__ . '/config/database.php');

if($_GET) {
    $rows = $pdo->exec("DELETE FROM user WHERE id=" .$_GET['id']);

    if($rows > 0) {
        header("Location: dashboard.php");
    }
    else {
        echo "Erreur";
    }
}

?>