<?php
session_start();
if (!isset($_SESSION['admin'])) {
    header("Location: login.php");
    exit();
}

include_once './admin_header.php';
include_once '../database/db-connection.php';

// Get order ID from the URL
$order_id = isset($_GET['id']) ? $_GET['id'] : 0;

// Fetch the order and customer info
try {
    $stmt = $pdo->prepare("SELECT o.*, c.first_name, c.last_name, c.email, c.address, c.city, c.zip_code FROM orders o JOIN customers c ON o.customer_id = c.id WHERE o.id = ?");
    $stmt->execute([$order_id]);
    $order = $stmt->fetch(PDO::FETCH_ASSOC);
} catch (PDOException $e) {
    echo "Error fetching order: " . $e->getMessage();
    $order = null;
}

if (!$order) {
    echo "<div class='container'>Order not found.</div>";
    exit();
}

// Fetch order items from orderline, join with products
try {
    $stmt = $pdo->prepare("SELECT ol.*, p.name as product_name FROM orderline ol JOIN products p ON ol.product_id = p.id WHERE ol.order_id = ?");
    $stmt->execute([$order_id]);
    $order_items = $stmt->fetchAll(PDO::FETCH_ASSOC);
} catch (PDOException $e) {
    echo "Error fetching order items: " . $e->getMessage();
    $order_items = [];
}
?>

<div class="container">
    <h1>Order Details</h1>
    <p><strong>Order ID:</strong> <?php echo htmlspecialchars($order['id']); ?></p>
    <p><strong>Klant:</strong> <?php echo htmlspecialchars($order['first_name'] . ' ' . $order['last_name']); ?></p>
    <p><strong>Email:</strong> <?php echo htmlspecialchars($order['email']); ?></p>
    <p><strong>Adres:</strong> <?php echo htmlspecialchars($order['address'] . ', ' . $order['zip_code'] . ' ' . $order['city']); ?></p>
    <p><strong>Date:</strong> <?php echo htmlspecialchars($order['order_date']); ?></p>
    <p><strong>Status:</strong> <?php echo htmlspecialchars($order['status']); ?></p>

    <h2>Order Items</h2>
    <table class="table">
        <thead>
            <tr>
                <th>Product ID</th>
                <th>Productnaam</th>
                <th>Aantal</th>
                <th>Prijs</th>
                <th>Totaal</th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($order_items as $item): ?>
                <tr>
                    <td><?php echo htmlspecialchars($item['product_id']); ?></td>
                    <td><?php echo htmlspecialchars($item['product_name']); ?></td>
                    <td><?php echo htmlspecialchars($item['quantity']); ?></td>
                    <td>€<?php echo htmlspecialchars($item['price']); ?></td>
                    <td>€<?php echo number_format($item['price'] * $item['quantity'], 2); ?></td>
                </tr>
            <?php endforeach; ?>
        </tbody>
    </table>
</div>

<?php include '../includes/footer.php'; ?>