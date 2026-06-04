<?php

require_once '../config.php';

session_start();

if(!isset($_SESSION['user_id'])){

    header("Location: ../login/login.php");
    exit();
}

$id = (int) $_GET['id'];

/*
|--------------------------------------------------------------------------
| DELETE TRANSACTION
|--------------------------------------------------------------------------
*/

$stmt = $conn->prepare("

    DELETE FROM transactions

    WHERE transaction_id = ?

");

$stmt->execute([$id]);

header("Location: view_expense.php");
exit();

?>