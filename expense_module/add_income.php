<?php

require_once '../config.php';

session_start();

if (!isset($_SESSION['user_id'])) {

    header("Location: ../login/login.php");
    exit();
}

$user_id = $_SESSION['user_id'];

$success = '';
$error   = '';

/*
|--------------------------------------------------------------------------
| ADD INCOME
|--------------------------------------------------------------------------
*/

if(isset($_POST['add'])){

    $amount = (float) $_POST['amount'];

    $description = trim($_POST['description']);

    $income_date = $_POST['income_date'];

    /*
    |--------------------------------------------------------------------------
    | INSERT INTO TRANSACTIONS
    |--------------------------------------------------------------------------
    */

    $transaction = $conn->prepare("

        INSERT INTO transactions
        (
            user_id,
            type,
            amount,
            description,
            transaction_date
        )

        VALUES
        (
            ?, 'income', ?, ?, ?
        )

    ");

    $transaction->execute([

        $user_id,
        $amount,
        $description,
        $income_date
    ]);

    $success = "Income added successfully!";
}

?>

<!DOCTYPE html>
<html>

<head>

    <title>Add Income</title>

    <link rel="icon" type="image/x-icon" href="../logo/logo.png">
    <link rel="stylesheet" href="style.css">

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

.success{
    background:#16a34a;
    padding:10px;
    margin-bottom:15px;
}

.error{
    background:#dc2626;
    padding:10px;
    margin-bottom:15px;
}

    </style>

</head>

<body>

<div class="wrapper">

    <div class="sidebar">

        <h2>
            <?= htmlspecialchars($_SESSION['name']) ?>
        </h2>

        <a href="../dashboard.php">Dashboard</a>

        <a href="../expense_module/view_expense.php">Expenses</a>

        <a href="../transaction_module/view_transaction.php">
            Transactions
        </a>

        <a href="../report/report.php">Reports</a>

        <a href="../category_management/index.php">
            Category
        </a>

        <a href="../profile/show_profile.php">Profile</a>

        <a href="../login/logout.php">Logout</a>

    </div>

    <div class="main">

        <div class="form-box">

            <h1>💰 Add Income</h1>

            <?php if($success): ?>

                <div class="success">

                    <?= $success ?>

                </div>

            <?php endif; ?>

            <?php if($error): ?>

                <div class="error">

                    <?= $error ?>

                </div>

            <?php endif; ?>

            <form method="POST">

                <input
                    type="number"
                    step="0.01"
                    name="amount"
                    placeholder="Income Amount"
                    required
                >

                <input
                    type="text"
                    name="description"
                    placeholder="Income Source"
                    required
                >

                <input
                    type="date"
                    name="income_date"
                    required
                >

                <button type="submit" name="add">

                    Add Income

                </button>

            </form>

        </div>

    </div>

</div>

</body>
</html>