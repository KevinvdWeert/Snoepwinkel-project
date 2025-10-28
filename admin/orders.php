<?php
session_start();
if (!isset($_SESSION['admin'])) {
    header("Location: login.php");
    exit();
}

include_once './admin_header.php';
include_once '../database/db-connection.php';

// Fetch orders with customer info
try {
    $stmt = $pdo->query("SELECT o.*, c.first_name, c.last_name FROM orders o JOIN customers c ON o.customer_id = c.id");
    $orders = $stmt->fetchAll(PDO::FETCH_ASSOC);
} catch (PDOException $e) {
    echo "Error fetching orders: " . $e->getMessage();
    $orders = [];
}
?>

<div class="container">
    <h1>Orders</h1>
    <table class="table">
        <thead>
            <tr>
                <th>Order ID</th>
                <th>Klant</th>
                <th>Date</th>
                <th>Total</th>
                <th>Status</th>
                <th>Actions</th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($orders as $order): ?>
                <tr>
                    <td><?php echo htmlspecialchars($order['id']); ?></td>
                    <td><?php echo htmlspecialchars($order['first_name'] . ' ' . $order['last_name']); ?></td>
                    <td><?php echo htmlspecialchars($order['order_date']); ?></td>
                    <td>€<?php echo htmlspecialchars($order['total_amount']); ?></td>
                    <td><?php echo htmlspecialchars($order['status']); ?></td>
                    <td>
                        <a href="order_details.php?id=<?php echo $order['id']; ?>" class="btn btn-sm btn-primary">View Details</a>
                        <!-- Add options to change order status (e.g., Shipped, Cancelled) -->
                    </td>
                </tr>
            <?php endforeach; ?>
        </tbody>
    </table>
</div>

<?php include '../includes/footer.php'; ?>
<?php include '../includes/footer.php'; ?>
