<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin - Sweetshop Candy</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="../assets/css/style.css">
</head>
<body>
<nav class="navbar navbar-expand-lg admin-navbar">
    <div class="container-fluid">
        <a class="navbar-brand d-flex align-items-center" href="index.php">
            <img src="../assets/img/logo.png" alt="Sweetshop Candy Logo" class="logo me-2">
            <span>Admin Sweetshop Candy</span>
        </a>
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#adminNavbar"
                aria-controls="adminNavbar" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="adminNavbar">
            <ul class="navbar-nav ms-auto">
                <li class="nav-item">
                    <a class="nav-link<?php if(basename($_SERVER['PHP_SELF'])=='products.php') echo ' active'; ?>" href="products.php">Producten</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link<?php if(basename($_SERVER['PHP_SELF'])=='orders.php') echo ' active'; ?>" href="orders.php">Bestellingen</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link<?php if(basename($_SERVER['PHP_SELF'])=='customers.php') echo ' active'; ?>" href="customers.php">klanten</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link text-danger" href="logout.php">Uitloggen</a>
                </li>
            </ul>
        </div>
    </div>
</nav>
