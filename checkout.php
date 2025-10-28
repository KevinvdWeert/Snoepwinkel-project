<?php
include 'includes/header.php';
include_once 'database/db-connection.php';

function sanitizeInput($data) {
    return htmlspecialchars(trim($data), ENT_QUOTES, 'UTF-8');
}

// Helper: get product details
function getProductDetails($pdo, $product_id) {
    $stmt = $pdo->prepare("SELECT * FROM products WHERE id = ?");
    $stmt->execute([$product_id]);
    return $stmt->fetch(PDO::FETCH_ASSOC);
}

$errors = [];
$success = false;

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Collect and validate customer data
    $first_name = sanitizeInput($_POST['first_name'] ?? '');
    $last_name = sanitizeInput($_POST['last_name'] ?? '');
    $email = sanitizeInput($_POST['email'] ?? '');
    $address = sanitizeInput($_POST['address'] ?? '');
    $city = sanitizeInput($_POST['city'] ?? '');
    $zip_code = sanitizeInput($_POST['zip_code'] ?? '');

    if ($first_name === '' || $last_name === '' || $email === '') {
        $errors[] = "Voornaam, achternaam en e-mail zijn verplicht.";
    }

    if (empty($_SESSION['cart'])) {
        $errors[] = "Je winkelwagen is leeg.";
    }

    if (empty($errors)) {
        // Check if customer exists
        $stmt = $pdo->prepare("SELECT id FROM customers WHERE email = ?");
        $stmt->execute([$email]);
        $customer = $stmt->fetch(PDO::FETCH_ASSOC);

        if ($customer) {
            $customer_id = $customer['id'];
            // Optionally update customer info
            $stmt = $pdo->prepare("UPDATE customers SET first_name=?, last_name=?, address=?, city=?, zip_code=? WHERE id=?");
            $stmt->execute([$first_name, $last_name, $address, $city, $zip_code, $customer_id]);
        } else {
            // Insert new customer
            $stmt = $pdo->prepare("INSERT INTO customers (first_name, last_name, email, address, city, zip_code) VALUES (?, ?, ?, ?, ?, ?)");
            $stmt->execute([$first_name, $last_name, $email, $address, $city, $zip_code]);
            $customer_id = $pdo->lastInsertId();
        }

        // Calculate total
        $total = 0;
        foreach ($_SESSION['cart'] as $product_id => $quantity) {
            $product = getProductDetails($pdo, $product_id);
            $total += $product['price'] * $quantity;
        }

        // Insert order
        $stmt = $pdo->prepare("INSERT INTO orders (customer_id, total_amount, status) VALUES (?, ?, 'pending')");
        $stmt->execute([$customer_id, $total]);
        $order_id = $pdo->lastInsertId();

        // Insert orderlines
        foreach ($_SESSION['cart'] as $product_id => $quantity) {
            $product = getProductDetails($pdo, $product_id);
            $stmt = $pdo->prepare("INSERT INTO orderline (order_id, product_id, quantity, price) VALUES (?, ?, ?, ?)");
            $stmt->execute([$order_id, $product_id, $quantity, $product['price']]);
        }

        unset($_SESSION['cart']);
        $success = true;
    }
}

if ($success):
?>
<div class="container">
    <h1>Bedankt voor je bestelling!</h1>
    <p>Je bestelling is succesvol geplaatst en wordt zo snel mogelijk verwerkt.</p>
</div>
<?php
else:
?>
<div class="container">
    <h1>Afrekenen</h1>
    <?php if ($errors): ?>
        <div class="alert alert-danger">
            <?php foreach ($errors as $err) echo htmlspecialchars($err) . "<br>"; ?>
        </div>
    <?php endif; ?>
    <form method="post">
        <div class="mb-3">
            <label for="first_name" class="form-label">Voornaam</label>
            <input type="text" class="form-control" id="first_name" name="first_name" required value="<?php echo htmlspecialchars($_POST['first_name'] ?? ''); ?>">
        </div>
        <div class="mb-3">
            <label for="last_name" class="form-label">Achternaam</label>
            <input type="text" class="form-control" id="last_name" name="last_name" required value="<?php echo htmlspecialchars($_POST['last_name'] ?? ''); ?>">
        </div>
        <div class="mb-3">
            <label for="email" class="form-label">E-mail</label>
            <input type="email" class="form-control" id="email" name="email" required value="<?php echo htmlspecialchars($_POST['email'] ?? ''); ?>">
        </div>
        <div class="mb-3">
            <label for="address" class="form-label">Adres</label>
            <input type="text" class="form-control" id="address" name="address" value="<?php echo htmlspecialchars($_POST['address'] ?? ''); ?>">
        </div>
        <div class="mb-3">
            <label for="city" class="form-label">Plaats</label>
            <input type="text" class="form-control" id="city" name="city" value="<?php echo htmlspecialchars($_POST['city'] ?? ''); ?>">
        </div>
        <div class="mb-3">
            <label for="zip_code" class="form-label">Postcode</label>
            <input type="text" class="form-control" id="zip_code" name="zip_code" value="<?php echo htmlspecialchars($_POST['zip_code'] ?? ''); ?>">
        </div>
        <button type="submit" class="btn btn-success">Bestelling plaatsen</button>
    </form>
</div>
<?php
endif;
include 'includes/footer.php';
?>
