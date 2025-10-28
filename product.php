<?php
include 'includes/header.php';
include_once 'database/db-connection.php';
?>

<!DOCTYPE html>
<html lang="nl">
<head>
    <meta charset="UTF-8">
    <title>Producten - Snoepwinkel</title>
    <link rel="stylesheet" href="assets/css/kids-theme.css">
</head>
<body>
    <header>
        <h1>Onze Snoepjes</h1>
        <nav>
            <!-- ...existing code... -->
        </nav>
    </header>
    <main>
        <?php
        // Get the product ID from the URL
        $product_id = isset($_GET['id']) ? $_GET['id'] : 0;

        // Fetch the product from the database
        try {
            $stmt = $pdo->prepare("SELECT * FROM products WHERE id = ?");
            $stmt->execute([$product_id]);
            $product = $stmt->fetch(PDO::FETCH_ASSOC);
        } catch (PDOException $e) {
            echo "Error fetching product: " . $e->getMessage();
            $product = null;
        }

        if (!$product) {
            echo "<div class='container'>Product niet gevonden.</div>";
        } else {
            ?>
            <div class="container">
                <div class="row align-items-center product-row-minheight">
                    <div class="col-md-6 mb-4 mb-md-0">
                        <div class="product-image-wrapper">
                            <img src="<?php echo htmlspecialchars($product['image_url']); ?>" alt="<?php echo htmlspecialchars($product['name']); ?>" class="product-img">
                        </div>
                    </div>
                    <div class="col-md-6">
                        <h1><?php echo htmlspecialchars($product['name']); ?></h1>
                        <p><?php echo htmlspecialchars($product['description']); ?></p>
                        <p>€<?php echo htmlspecialchars($product['price']); ?></p>
                        <form action="cart.php" method="post">
                            <input type="hidden" name="product_id" value="<?php echo $product['id']; ?>">
                            <button type="submit" class="button">Toevoegen aan winkelwagen</button>
                        </form>
                    </div>
                </div>
                <div class="row justify-content-center">
                    <div class="col-lg-10">
                        <div class="product-info-extra mt-4 mb-5" style="box-shadow: 0 8px 32px rgba(255,182,193,0.13);">
                            <h3>Waarom kiezen voor Sweetshop Candy?</h3>
                            <div class="row justify-content-center">
                                <div class="col-md-10 mx-auto">
                                    <p>
                                        Bij Sweetshop Candy vind je altijd de lekkerste en meest verse snoepjes, direct uit ons uitgebreide assortiment.<br>
                                        Bestel eenvoudig online of kom langs in onze winkel voor de beste aanbiedingen en een glimlach bij elke aankoop!
                                    </p>
                                    <p>
                                        Heb je vragen over dit product of wil je meer weten over onze aanbiedingen? Neem gerust <a href="contact.php">contact</a> met ons op!
                                    </p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <?php
        }
        ?>
    </main>
    <footer>
        &copy; <?php echo date('Y'); ?> Snoepwinkel. Alle rechten voorbehouden.
    </footer>
</body>
</html>
