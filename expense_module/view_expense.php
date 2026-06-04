<?php

require_once '../config.php';

session_start();

if(!isset($_SESSION['user_id'])){

    header("Location: ../login/login.php");
    exit();
}

$user_id = $_SESSION['user_id'];

$stmt = $conn->prepare("

    SELECT
        t.*,
        c.category_name

    FROM transactions t

    LEFT JOIN categories c
    ON t.category_id = c.category_id

    WHERE t.user_id = ?

    ORDER BY transaction_date DESC

");

$stmt->execute([$user_id]);

$expenses = $stmt->fetchAll(PDO::FETCH_ASSOC);

?>

<!DOCTYPE html>
<html>

<head>

    <title>Budget Tracker</title>
    <link rel="icon" type="image/x-icon" href="../logo/logo.png">


    <link rel="stylesheet" href="expense.css">

</head>

<body>

<div class="wrapper">

<div class="sidebar">

    <h2>
        <?= htmlspecialchars($_SESSION['name']) ?>
    </h2>
    
    <a href="../dashboard.php">Dashboard</a>

    <a href="#">Expenses</a>

    <a href="../transaction_module/view_transaction.php">Transactions</a>

    <a href="../report/report.php">Reports</a>

    <a href="../category_management/index.php">Category</a>

    <a href="../profile/show_profile.php">Profile</a>

    <a href="../login/logout.php">Logout</a>

</div>

<div class="main">

<div class="nav-buttons">

    <a href="add_expense.php">
        💸 Add Expense
    </a>

    <a href="add_income.php">
        💰 Add Income
    </a>

</div>

<h1>📋 All Details</h1>

<table>

<tr>

    <th>SN</th>
    <th>Type</th>
    <th>Category</th>
    <th>Amount</th>
    <th>Description</th>
    <th>Date</th>
    <th>Actions</th>

</tr>

<?php $sn = 1; ?>

<?php foreach($expenses as $expense): ?>

<tr>

    <td><?= $sn++ ?></td>

     <td>

        <?php if($expense['type'] == 'income'): ?>

            <span style="color:green;font-weight:bold;">
                Income
            </span>

        <?php else: ?>

            <span style="color:red;font-weight:bold;">
                Expense
            </span>

        <?php endif; ?>

    </td>

    <td>
        <?= htmlspecialchars($expense['category_name'] ?? 'Income') ?>
    </td>

    <td>
        <?= number_format($expense['amount'],2) ?>
    </td>

    <td>
        <?= htmlspecialchars($expense['description']) ?>
    </td>

    <td>
        <?= $expense['transaction_date'] ?>
    </td>

    <td>

        <a
            href="edit_expense.php?id=<?= $expense['transaction_id'] ?>"
            class="edit-btn"
        >

            Edit

        </a>

        <a
            href="delete_expense.php?id=<?= $expense['transaction_id'] ?>"
            class="delete-btn"
            onclick="return confirm('Delete expense?')"
        >

            Delete

        </a>

    </td>

</tr>

<?php endforeach; ?>

</table>

</div>

</div>

</body>
</html>