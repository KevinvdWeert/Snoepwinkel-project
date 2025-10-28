<?php
include 'includes/header.php';
include_once 'database/db-connection.php';

// Fetch 3 most ordered products
try {
    $stmt = $pdo->query("
        SELECT p.*, COALESCE(SUM(ol.quantity),0) AS total_ordered
        FROM products p
        LEFT JOIN orderline ol ON p.id = ol.product_id
        GROUP BY p.id
        ORDER BY total_ordered DESC
        LIMIT 3
    ");
    $products = $stmt->fetchAll(PDO::FETCH_ASSOC);
} catch (PDOException $e) {
    echo "Error fetching products: " . $e->getMessage();
    $products = [];
}
?>
<header>
    <h1>Welkom bij Sweetshop Candy</h1>
</header>

<div class="container">
    <section class="about-section card" style="max-width: 800px;">
        <p>
            Welkom bij Sweetshop Candy, dé ultieme bestemming voor alle zoetekauwen in de regio! Als de goedkoopste snoepwinkel van Veenendaal staan we garant voor een heerlijke ervaring vol smaak en plezier.
        </p>
        <p>
            Ons uitgebreide assortiment omvat een overvloed aan lekkernijen, variërend van snoepjes en bonbons tot koekjes, fudge en nog veel meer, en dat alles tegen de meest betaalbare prijzen die je in de omgeving zult vinden. Of je nu op zoek bent naar een traktatie voor de kinderen, een geschenk voor een speciale gelegenheid of gewoon iets zoets voor jezelf, bij Sweetshop Candy vind je altijd wat je zoekt.
        </p>
        <p>
            We zijn er trots op dat we niet alleen de goedkoopste snoepwinkel in Veenendaal zijn, maar ook deel uitmaken van een groter netwerk van 11 winkels in verschillende steden, waaronder Amersfoort, Delft, Gouda, H.I.Ambacht, Krimpen a.d. IJssel, Oud Beijerland, en diverse locaties in Rotterdam. Hierdoor kunnen we onze klanten nog meer keuze en gemak bieden.
        </p>
        <p>
            Bij Sweetshop Candy is er altijd iets nieuws te ontdekken, want we presenteren elke week verse aanbiedingen tegen super lage prijzen. Je vindt onze nieuwste aanbiedingen en ons volledige assortiment op onze website:
        </p>
        <p>
            <strong>WWW.CANDYSHOPONLINE.NL</strong>
        </p>
        <p>
            Kom langs bij Sweetshop Candy en trakteer jezelf op een wereld van zoetigheden zonder je portemonnee te belasten. We kijken ernaar uit om je te verwelkomen in onze winkel en je te laten genieten van de heerlijke smaken die we te bieden hebben!
        </p>
    </section>

    <section class="featured-products">
        <h2 class="text-center" style="margin-top: 40px;">Meest Bestelde Producten</h2>
        <div class="row justify-content-center">
            <?php foreach ($products as $product): ?>
                <div class="col-md-4 mb-4 d-flex">
                    <div class="card flex-fill">
                        <img src="<?php echo htmlspecialchars($product['image_url']); ?>" class="product-img" alt="<?php echo htmlspecialchars($product['name']); ?>">
                        <div class="card-body">
                            <h5 class="card-title"><?php echo htmlspecialchars($product['name']); ?></h5>
                            <p class="card-text"><?php echo htmlspecialchars(substr($product['description'], 0, 50)); ?>...</p>
                            <p class="card-text"><strong>€<?php echo htmlspecialchars($product['price']); ?></strong></p>
                            <a href="product.php?id=<?php echo $product['id']; ?>" class="button">Bekijk Product</a>
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