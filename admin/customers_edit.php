<?php
session_start();
if (!isset($_SESSION['admin'])) {
    header("Location: login.php");
    exit();
}

include_once './admin_header.php';
include_once '../database/db-connection.php';

function sanitizeInput($data) {
    return htmlspecialchars(trim($data), ENT_QUOTES, 'UTF-8');
}

$error = null;
$success = false;

// Get customer ID from the URL
$customer_id = isset($_GET['id']) ? $_GET['id'] : 0;

// Fetch the customer from the database
try {
    $stmt = $pdo->prepare("SELECT * FROM customers WHERE id = ?");
    $stmt->execute([$customer_id]);
    $customer = $stmt->fetch(PDO::FETCH_ASSOC);
} catch (PDOException $e) {
    echo "<div class='alert alert-danger'>Error fetching customer: " . htmlspecialchars($e->getMessage()) . "</div>";
    $customer = null;
}

if (!$customer) {
    echo "<div class='container'>Klant niet gevonden.</div>";
    exit();
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $first_name = sanitizeInput($_POST['first_name'] ?? '');
    $last_name = sanitizeInput($_POST['last_name'] ?? '');
    $email = sanitizeInput($_POST['email'] ?? '');
    $address = sanitizeInput($_POST['address'] ?? '');
    $city = sanitizeInput($_POST['city'] ?? '');
    $zip_code = sanitizeInput($_POST['zip_code'] ?? '');

    try {
        $stmt = $pdo->prepare("UPDATE customers SET first_name = ?, last_name = ?, email = ?, address = ?, city = ?, zip_code = ? WHERE id = ?");
        $stmt->execute([$first_name, $last_name, $email, $address, $city, $zip_code, $customer_id]);
        $success = true;
        // Refresh customer data
        $stmt = $pdo->prepare("SELECT * FROM customers WHERE id = ?");
        $stmt->execute([$customer_id]);
        $customer = $stmt->fetch(PDO::FETCH_ASSOC);
    } catch (PDOException $e) {
        $error = "Error updating customer: " . $e->getMessage();
    }
}
?>
<div class="container mt-4">
    <h1 class="main-title">Klant Bewerken</h1>
    <?php if ($error): ?>
        <div class="alert alert-danger"><?php echo htmlspecialchars($error); ?></div>
    <?php endif; ?>
    <?php if ($success): ?>
        <div class="alert alert-success">Klant succesvol bijgewerkt!</div>
    <?php endif; ?>
    <form method="post" class="mb-4">
        <div class="mb-3">
            <label for="first_name" class="form-label">Voornaam</label>
            <input type="text" class="form-control" id="first_name" name="first_name" required value="<?php echo htmlspecialchars($customer['first_name']); ?>">
        </div>
        <div class="mb-3">
            <label for="last_name" class="form-label">Achternaam</label>
            <input type="text" class="form-control" id="last_name" name="last_name" required value="<?php echo htmlspecialchars($customer['last_name']); ?>">
        </div>
        <div class="mb-3">
            <label for="email" class="form-label">E-mail</label>
            <input type="email" class="form-control" id="email" name="email" required value="<?php echo htmlspecialchars($customer['email']); ?>">
        </div>
        <div class="mb-3">
            <label for="address" class="form-label">Adres</label>
            <input type="text" class="form-control" id="address" name="address" value="<?php echo htmlspecialchars($customer['address']); ?>">
        </div>
        <div class="mb-3">
            <label for="city" class="form-label">Plaats</label>
            <input type="text" class="form-control" id="city" name="city" value="<?php echo htmlspecialchars($customer['city']); ?>">
        </div>
        <div class="mb-3">
            <label for="zip_code" class="form-label">Postcode</label>
            <input type="text" class="form-control" id="zip_code" name="zip_code" value="<?php echo htmlspecialchars($customer['zip_code']); ?>">
        </div>
        <button type="submit" class="btn btn-primary">Opslaan</button>
        <a href="customers.php" class="btn btn-secondary">Annuleren</a>
    </form>
</div>
<?php include '../includes/footer.php'; ?>
