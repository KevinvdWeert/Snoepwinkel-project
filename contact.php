<?php
include 'includes/header.php';
?>
<header>
    <h1>Contacteer ons!</h1>
    <nav>
        <!-- ...existing code... -->
    </nav>
</header>
<main>
    <div class="card" style="max-width: 700px; margin: 30px auto;">
        <div class="container">
            <h1>Contact</h1>
            <p>Neem contact met ons op via onderstaand formulier of gebruik de onderstaande gegevens:</p>
            <div class="mb-4" style="text-align:left;">
                <strong>Adres:</strong> Marktstraat 12, 3901 DM Veenendaal<br>
                <strong>Telefoon:</strong> 0318-123456<br>
                <strong>Email:</strong> info@sweetshopcandy.nl<br>
                <strong>Openingstijden:</strong><br>
                Maandag t/m vrijdag: 09:00 - 18:00<br>
                Zaterdag: 09:00 - 17:00<br>
                Zondag: Gesloten
            </div>
            <form>
                <div class="mb-3">
                    <label for="name" class="form-label">Naam</label>
                    <input type="text" class="form-control" id="name" name="name" required>
                </div>
                <div class="mb-3">
                    <label for="email" class="form-label">Email</label>
                    <input type="email" class="form-control" id="email" name="email" required>
                </div>
                <div class="mb-3">
                    <label for="message" class="form-label">Bericht</label>
                    <textarea class="form-control" id="message" name="message" rows="5" required></textarea>
                </div>
                <button type="submit" class="button">Verstuur</button>
            </form>
        </div>
    </div>
</main>
<footer>
    &copy; <?php echo date('Y'); ?> Snoepwinkel. Alle rechten voorbehouden.
</footer>
</body>
</html>
