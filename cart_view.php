<?php
include 'includes/header.php';
include_once 'database/db-connection.php';

// Function to get product details
function getProductDetails($pdo, $product_id) {
    $stmt = $pdo->prepare("SELECT * FROM products WHERE id = ?");
    $stmt->execute([$product_id]);
    return $stmt->fetch(PDO::FETCH_ASSOC);
}

?>

<div class="container">
    <h1>Winkelwagen</h1>
    <?php if (empty($_SESSION['cart'])): ?>
        <p>Je winkelwagen is leeg.</p>
    <?php else: ?>
        <table class="table">
            <thead>
                <tr>
                    <th>Product</th>
                    <th>Naam</th>
                    <th>Prijs</th>
                    <th>Aantal</th>
                    <th>Totaal</th>
                    <th>Verwijderen</th>
                </tr>
            </thead>
            <tbody>
                <?php
                $total = 0;
                foreach ($_SESSION['cart'] as $product_id => $quantity):
                    $product = getProductDetails($pdo, $product_id);
                    $item_total = $product['price'] * $quantity;
                    $total += $item_total;
                    ?>
                    <tr>
                        <td><img src="<?php echo htmlspecialchars($product['image_url']); ?>" alt="<?php echo htmlspecialchars($product['name']); ?>" style="width: 50px;"></td>
                        <td><?php echo htmlspecialchars($product['name']); ?></td>
                        <td>€<?php echo htmlspecialchars($product['price']); ?></td>
                        <td><?php echo $quantity; ?></td>
                        <td>€<?php echo number_format($item_total, 2); ?></td>
                        <td>
                            <form action="cart.php" method="post" style="display:inline;">
                                <input type="hidden" name="remove_product_id" value="<?php echo $product_id; ?>">
                                <button type="submit" class="btn btn-danger btn-sm">Verwijder</button>
                            </form>
                        </td>
                    </tr>
                <?php endforeach; ?>
            </tbody>
            <tfoot>
                <tr>
                    <td colspan="5" style="text-align: right;"><strong>Totaal:</strong></td>
                    <td>€<?php echo number_format($total, 2); ?></td>
                </tr>
            </tfoot>
        </table>
        <a href="checkout.php" class="btn btn-success">Afrekenen</a>
    <?php endif; ?>
</div>

<?php include 'includes/footer.php'; ?>
