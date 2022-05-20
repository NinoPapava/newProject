<?php
    require_once 'connection.php';

   $statement = $pdo->prepare('SELECT * FROM products');
    $statement->execute();
    $products = $statement->fetchAll(PDO::FETCH_ASSOC);

    header('Location: index.php');
?>