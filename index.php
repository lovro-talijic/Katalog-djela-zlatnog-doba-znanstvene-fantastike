<?php
session_start();

if (!isset($_SESSION["user"])) {
    header("Location: login.php");
    exit;
}

$currentPage = 'home';
?>

<!DOCTYPE html>
<html lang="hr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="PPDI - CSS.css">
    <title>Početna - SF Katalog</title>
</head>

<body class="body">

<!-- HEADER -->
<section class="top" style="
    background-color: rgba(0, 0, 0, 0.6);
    padding: 40px;
    border-radius: 12px;
    text-align: center;
    display: flex;
    flex-direction: column;
    gap: 15px;
">
    <div>
        <h1>Zlatno doba znanstvene fantastike</h1>
        <h2>Početna stranica</h2>
    </div>
</section>

<!-- NAV -->
<nav style="
    display: flex;
    gap: 15px;
    background-color: rgba(0, 0, 0, 0.7);
    padding: 10px 20px;
    align-items: center;
">

    <?php if ($currentPage !== 'home'): ?>
        <a href="index.php" style="color:white; text-decoration:none;">Početna</a>
    <?php endif; ?>

    <?php if ($currentPage !== 'katalog'): ?>
        <a href="knjige.php" style="color:white; text-decoration:none;">Katalog</a>
    <?php endif; ?>

    <?php if ($currentPage !== 'o'): ?>
        <a href="o_projektu.php" style="color:white; text-decoration:none;">O projektu</a>
    <?php endif; ?>

</nav>

<!-- MAIN -->
<section class="mainsection" style="
    display: flex;
    justify-content: center;
    align-items: center;
    min-height: 100vh;
    color: white;
">

    <div style="
        background-color: rgba(0, 0, 0, 0.6);
        padding: 40px;
        border-radius: 12px;
        text-align: center;
        display: flex;
        flex-direction: column;
        gap: 15px;
    ">
        <h2>Dobrodošli u katalog knjiga zlatnog doba znanstvene fantastike</h2>

        <a href="knjige.php">
            <button>Ulazak u katalog</button>
        </a>
    </div>

</section>

</body>
</html>