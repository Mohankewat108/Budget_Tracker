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
| FETCH TRANSACTION
|--------------------------------------------------------------------------
*/

$stmt = $conn->prepare("

    SELECT *
    FROM transactions

    WHERE transaction_id = ?

");

$stmt->execute([$id]);

$expense = $stmt->fetch(PDO::FETCH_ASSOC);

if(!$expense){

    die("Transaction not found.");

}

/*
|--------------------------------------------------------------------------
| UPDATE TRANSACTION
|--------------------------------------------------------------------------
*/

if(isset($_POST['update'])){

    $amount = $_POST['amount'];

    $description = $_POST['description'];

    $transaction_date = $_POST['transaction_date'];

    $update = $conn->prepare("

        UPDATE transactions

        SET
            amount = ?,
            description = ?,
            transaction_date = ?

        WHERE transaction_id = ?

    ");

    $update->execute([

        $amount,
        $description,
        $transaction_date,
        $id
    ]);

    header("Location: view_expense.php");
    exit();
}

?>

<!DOCTYPE html>
<html>

<head>

    <title>Edit Transaction</title>

    <link rel="icon" type="image/x-icon" href="../logo/logo.png">

    <style>

        body{
    margin:0;
    font-family:Arial;
    background:#0f172a;
    color:white;
}

.wrapper{
    display:flex;
}

.sidebar{
    width:220px;
    background:#1e293b;
    min-height:100vh;
    padding:20px;
}

.sidebar a{
    display:block;
    color:white;
    text-decoration:none;
    padding:12px;
    margin-bottom:10px;
}

.sidebar a:hover{
    background:#334155;
    border-radius: 6px;
}

.main{
    flex:1;
    padding:30px;
}

.form-box{
    background:#1e293b;
    padding:25px;
    border-radius:10px;
    max-width:500px;
}

input,
select{
    width:100%;
    padding:12px;
    margin-top:10px;
    margin-bottom:15px;
    border:none;
    border-radius:6px;
}

button{
    width:100%;
    padding:12px;
    background:#3b82f6;
    border:none;
    border-radius:6px;
    color:white;
}

    </style>

</head>

<body>

<div class="wrapper">

    <!-- SIDEBAR -->

    <div class="sidebar">

        <h2>
            <?= htmlspecialchars($_SESSION['name']) ?>
        </h2>

        <a href="../dashboard.php">
            Dashboard
        </a>

        <a href="view_expense.php">
            Expenses
        </a>

        <a href="../transaction_module/view_transaction.php">
            Transactions
        </a>

        <a href="../report/report.php">
            Reports
        </a>

        <a href="../category_management/index.php">
            Category
        </a>

        <a href="../profile/show_profile.php">
            Profile
        </a>

        <a href="../login/logout.php">
            Logout
        </a>

    </div>

    <!-- MAIN CONTENT -->

    <div class="main">

        <div class="form-box">

            <h2>
                ✏ Edit Transaction
            </h2>

            <form method="POST">

                <input
                    type="number"
                    step="0.01"
                    name="amount"
                    value="<?= $expense['amount'] ?>"
                    required
                >

                <input
                    type="text"
                    name="description"
                    value="<?= htmlspecialchars($expense['description']) ?>"
                    required
                >

                <input
                    type="date"
                    name="transaction_date"
                    value="<?= $expense['transaction_date'] ?>"
                    required
                >

                <button name="update">

                    Update Transaction

                </button>

            </form>

        </div>

    </div>

</div>

</body>
</html>