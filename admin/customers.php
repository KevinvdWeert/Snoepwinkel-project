<?php
session_start();
if (!isset($_SESSION['admin'])) {
    header("Location: login.php");
    exit();
}

include_once './admin_header.php';
include_once '../database/db-connection.php';

// Handle delete customer
if (isset($_GET['delete_id'])) {
    $id_to_delete = $_GET['delete_id'];
    try {
        $stmt = $pdo->prepare("DELETE FROM customers WHERE id = ?");
        $stmt->execute([$id_to_delete]);
        header("Location: customers.php");
        exit();
    } catch (PDOException $e) {
        echo "<div class='alert alert-danger'>Error deleting customer: " . htmlspecialchars($e->getMessage()) . "</div>";
    }
}

// Fetch customers from the database
try {
    $stmt = $pdo->query("SELECT * FROM customers");
    $customers = $stmt->fetchAll(PDO::FETCH_ASSOC);
} catch (PDOException $e) {
    echo "<div class='alert alert-danger'>Error fetching customers: " . htmlspecialchars($e->getMessage()) . "</div>";
    $customers = [];
}
?>
<div class="container mt-4">
    <h1 class="main-title">Klantenbeheer</h1>
    <div class="table-responsive">
        <table class="table table-striped align-middle">
            <thead class="table-warning">
                <tr>
                    <th>ID</th>
                    <th>Voornaam</th>
                    <th>Achternaam</th>
                    <th>Email</th>
                    <th>Adres</th>
                    <th>Plaats</th>
                    <th>Postcode</th>
                    <th>Acties</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($customers as $customer): ?>
                    <tr>
                        <td><?php echo htmlspecialchars($customer['id']); ?></td>
                        <td><?php echo htmlspecialchars($customer['first_name']); ?></td>
                        <td><?php echo htmlspecialchars($customer['last_name']); ?></td>
                        <td><?php echo htmlspecialchars($customer['email']); ?></td>
                        <td><?php echo htmlspecialchars($customer['address']); ?></td>
                        <td><?php echo htmlspecialchars($customer['city']); ?></td>
                        <td><?php echo htmlspecialchars($customer['zip_code']); ?></td>
                        <td>
                            <a href="customers_edit.php?id=<?php echo $customer['id']; ?>" class="btn btn-sm btn-primary">Bewerken</a>
                            <a href="customers.php?delete_id=<?php echo $customer['id']; ?>" class="btn btn-sm btn-danger" onclick="return confirm('Weet je zeker dat je deze klant wilt verwijderen?')">Verwijderen</a>
                        </td>
                    </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
    </div>
</div>
<?php include '../includes/footer.php'; ?>
