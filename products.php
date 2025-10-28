<?php
include 'includes/header.php';
include_once 'database/db-connection.php';

// Fetch all products
try {
    $stmt = $pdo->query("SELECT * FROM products");
    $products = $stmt->fetchAll(PDO::FETCH_ASSOC);
} catch (PDOException $e) {
    echo "Error fetching products: " . $e->getMessage();
    $products = [];
}
?>
<header class="homepage-header">
    <h1 class="main-title">Assortiment</h1>
</header>

<div class="container">
    <section class="all-products">
        <h2 class="featured-title">Ons Volledige Assortiment</h2>
        <div class="row justify-content-center">
            <?php foreach ($products as $product): ?>
                <div class="col-md-4 mb-4 d-flex align-items-stretch">
                    <div class="card product-card flex-fill text-center">
                        <img src="<?php echo htmlspecialchars($product['image_url']); ?>" class="product-img mx-auto" alt="<?php echo htmlspecialchars($product['name']); ?>">
                        <div class="card-body d-flex flex-column">
                            <h5 class="card-title"><?php echo htmlspecialchars($product['name']); ?></h5>
                            <p class="card-text flex-grow-1"><?php echo htmlspecialchars(substr($product['description'], 0, 70)); ?>...</p>
                            <p class="card-text product-price"><strong>€<?php echo htmlspecialchars($product['price']); ?></strong></p>
                            <a href="product.php?id=<?php echo $product['id']; ?>" class="button mt-auto">Bekijk Product</a>
                        </div>
                    </div>
                </div>
            <?php endforeach; ?>
        </div>
    </section>
</div>

<footer>
    &copy; <?php echo date('Y'); ?> Snoepwinkel. Alle rechten voorbehouden.
</footer>
</body>
</html>

<?php
include 'includes/footer.php';
?>