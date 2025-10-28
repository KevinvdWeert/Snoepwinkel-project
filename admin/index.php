<?php
session_start();
if (!isset($_SESSION['admin'])) {
    header("Location: login.php");
    exit();
}

include_once './admin_header.php';
include_once '../database/db-connection.php';

// Get some stats for dashboard
$productCount = $orderCount = $customerCount = 0;
try {
    $productCount = $pdo->query("SELECT COUNT(*) FROM products")->fetchColumn();
    $orderCount = $pdo->query("SELECT COUNT(*) FROM orders")->fetchColumn();
    $customerCount = $pdo->query("SELECT COUNT(*) FROM customers")->fetchColumn();
} catch (PDOException $e) {
    // ignore for dashboard
}
?>
<div class="container mt-4">
    <h1 class="main-title">Admin Dashboard</h1>
    <p class="text-center">Welkom, beheer hier eenvoudig producten, bestellingen en klanten van Sweetshop Candy.</p>
    <div class="row mb-4">
        <div class="col-md-4 mb-3">
            <div class="admin-dashboard-card">
                <div class="dashboard-title">Producten</div>
                <div class="dashboard-value"><?php echo $productCount; ?></div>
                <a href="products.php" class="button dashboard-link">Bekijk Producten</a>
            </div>
        </div>
        <div class="col-md-4 mb-3">
            <div class="admin-dashboard-card">
                <div class="dashboard-title">Bestellingen</div>
                <div class="dashboard-value"><?php echo $orderCount; ?></div>
                <a href="orders.php" class="button dashboard-link">Bekijk Bestellingen</a>
            </div>
        </div>
        <div class="col-md-4 mb-3">
            <div class="admin-dashboard-card">
                <div class="dashboard-title">Klanten</div>
                <div class="dashboard-value"><?php echo $customerCount; ?></div>
                <a href="customers.php" class="button dashboard-link disabled" tabindex="-1" aria-disabled="true">Klantenlijst</a>
            </div>
        </div>
    </div>
    <div class="card homepage-about">
        <h3>Beheer Paneel</h3>
        <p>
            Gebruik het menu hierboven om producten toe te voegen, te bewerken of te verwijderen, bestellingen te beheren en meer. 
            Vergeet niet uit te loggen als je klaar bent!
        </p>
    </div>
</div>
<?php include '../includes/footer.php'; ?>
