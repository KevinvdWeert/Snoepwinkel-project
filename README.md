# Sweetshop Candy - Snoepwinkel Project

Een moderne e-commerce website voor Sweetshop Candy, de goedkoopste snoepwinkel van Veenendaal. Dit project biedt een complete online winkelervaring voor klanten en een admin panel voor beheer.

## 📋 Inhoudsopgave

- [Over het Project](#over-het-project)
- [Functionaliteiten](#functionaliteiten)
- [Technologieën](#technologieën)
- [Installatie](#installatie)
- [Database Setup](#database-setup)
- [Gebruik](#gebruik)
- [Project Structuur](#project-structuur)
- [Admin Panel](#admin-panel)
- [Contact](#contact)

## 🍬 Over het Project

Sweetshop Candy is een webapplicatie ontwikkeld voor een snoepwinkel met meerdere vestigingen in Nederland. De website biedt klanten de mogelijkheid om:
- Het volledige productassortiment te bekijken
- Producten toe te voegen aan een winkelwagen
- Bestellingen te plaatsen
- Contact op te nemen met de winkel

Beheerders kunnen via het admin panel:
- Producten beheren (toevoegen, bewerken, verwijderen)
- Klanten beheren
- Bestellingen inzien en beheren

## ✨ Functionaliteiten

### Voor Klanten
- **Homepage** met meest bestelde producten
- **Productoverzicht** met alle beschikbare snoepjes
- **Productdetails** met volledige beschrijving en prijs
- **Winkelwagen** functionaliteit
- **Checkout** proces voor bestellingen
- **Contactpagina**

### Voor Beheerders
- **Veilig inlogsysteem** met wachtwoordencryptie
- **Productbeheer**: toevoegen, bewerken en verwijderen van producten
- **Klantenbeheer**: inzien en bewerken van klantgegevens
- **Orderbeheer**: bekijken van bestellingen en orderdetails
- **Dashboard** met overzicht

## 🛠 Technologieën

- **Backend**: PHP 7.4+
- **Database**: MySQL
- **Frontend**: HTML5, CSS3, JavaScript
- **Server**: Laragon (Apache, MySQL)
- **Security**: 
  - PDO prepared statements tegen SQL injection
  - Password hashing met `password_verify()`
  - Input sanitization
  - Session management

## 📦 Installatie

### Vereisten
- PHP 7.4 of hoger
- MySQL 5.7 of hoger
- Apache webserver
- Laragon (aanbevolen) of vergelijkbare lokale development omgeving

### Stappen

1. **Clone het project**
   ```bash
   git clone https://github.com/KevinvdWeert/Snoepwinkel-project.git
   cd Snoepwinkel-project
   ```

2. **Plaats het project in je webserver directory**
   - Voor Laragon: `C:\laragon\www\web\projecten\Snoepwinkel-project`
   - Voor XAMPP: `C:\xampp\htdocs\Snoepwinkel-project`

3. **Start je webserver en MySQL**
   - Start Laragon of je lokale development environment

## 🗄 Database Setup

1. **Maak de database aan**
   - Open phpMyAdmin (meestal via http://localhost/phpmyadmin)
   - Maak een nieuwe database aan met de naam: `snoepwinkel`

2. **Importeer het database schema**
   - Selecteer de `snoepwinkel` database
   - Ga naar de "Import" tab
   - Selecteer het bestand: `database/database.sql`
   - Klik op "Go" om te importeren

3. **Configureer de database connectie**
   - Open `database/db-connection.php`
   - Pas indien nodig de instellingen aan:
     ```php
     $host = 'localhost';
     $dbname = 'snoepwinkel';
     $username = 'root';
     $password = '';
     ```

4. **Maak een admin gebruiker aan** (optioneel)
   - Voer het SQL script uit: `temp/add_admin_user.sql`
   - Of gebruik het Python script: `temp/password_hash.py` om een wachtwoord hash te genereren

### Database Schema

De database bevat de volgende tabellen:

- **products**: Productinformatie (naam, beschrijving, prijs, afbeelding)
- **customers**: Klantgegevens (naam, email, adres)
- **orders**: Bestellingen (klant, datum, totaalbedrag, status)
- **orderline**: Orderregels (gekoppeld aan orders en products)
- **users**: Admin gebruikers (username, wachtwoord)

## 🚀 Gebruik

### Toegang tot de Website

1. **Homepage**: http://localhost/Snoepwinkel-project/
2. **Producten**: http://localhost/Snoepwinkel-project/products.php
3. **Winkelwagen**: http://localhost/Snoepwinkel-project/cart_view.php
4. **Contact**: http://localhost/Snoepwinkel-project/contact.php

### Admin Panel

1. **Login**: http://localhost/Snoepwinkel-project/admin/login.php
2. **Standaard inloggegevens** (na database import):
   - Username: `admin`
   - Password: Zie `temp/add_admin_user.sql` voor het wachtwoord

3. **Admin functies**:
   - Dashboard: `admin/index.php`
   - Producten beheren: `admin/products.php`
   - Klanten beheren: `admin/customers.php`
   - Orders bekijken: `admin/orders.php`

## 📁 Project Structuur

```
Snoepwinkel-project/
├── admin/                      # Admin panel
│   ├── admin_header.php       # Admin header template
│   ├── customers_edit.php     # Klanten bewerken
│   ├── customers.php          # Klanten overzicht
│   ├── index.php              # Admin dashboard
│   ├── login.php              # Admin login
│   ├── logout.php             # Admin logout
│   ├── order_details.php      # Order details
│   ├── orders.php             # Orders overzicht
│   ├── products_add.php       # Producten toevoegen
│   ├── products_edit.php      # Producten bewerken
│   └── products.php           # Producten overzicht
├── assets/                     # Statische bestanden
│   ├── css/
│   │   └── style.css          # Stylesheet
│   └── img/
│       └── products/          # Product afbeeldingen
├── database/                   # Database files
│   ├── database.sql           # Database schema en data
│   └── db-connection.php      # Database connectie
├── includes/                   # Herbruikbare templates
│   ├── admin_header.php       # Admin header
│   ├── footer.php             # Footer template
│   └── header.php             # Header template
├── temp/                       # Tijdelijke/hulp bestanden
│   ├── add_admin_user.sql     # SQL voor admin user
│   └── password_hash.py       # Password hash generator
├── cart_view.php              # Winkelwagen weergave
├── cart.php                   # Winkelwagen logica
├── checkout.php               # Checkout proces
├── contact.php                # Contactpagina
├── index.php                  # Homepage
├── product.php                # Product detail pagina
├── products.php               # Producten overzicht
└── README.md                  # Deze file
```

## 🔐 Admin Panel

### Inloggen
Het admin panel is beveiligd met sessie-gebaseerde authenticatie. Na het inloggen krijgen beheerders toegang tot het volledige beheerportaal.

### Beveiliging
- Wachtwoorden worden gehashed met `password_hash()` (bcrypt)
- Input sanitization op alle formulieren
- PDO prepared statements tegen SQL injection
- Session management met `session_regenerate_id()`
- Username validatie met regex

### Producten Beheren
- Voeg nieuwe producten toe met naam, beschrijving, prijs en afbeelding
- Bewerk bestaande producten
- Verwijder producten uit het assortiment

### Orders Beheren
- Bekijk alle bestellingen
- Filter op status (pending, processing, shipped, delivered, cancelled)
- Bekijk gedetailleerde orderinformatie inclusief orderregels

### Klanten Beheren
- Inzien van klantgegevens
- Bewerken van klantinformatie
- Overzicht van klantbestellingen

## 🖼 Product Afbeeldingen

Product afbeeldingen worden opgeslagen in: `assets/img/products/`

Afbeelding naming conventie: `product_naam.jpg` (kleine letters, underscores voor spaties)

Bijvoorbeeld:
- `chocolade_reep.jpg`
- `fruit_gummies.jpg`
- `luxe_bonbons.jpg`

## 🔧 Configuratie

### Database Connectie
Bewerk `database/db-connection.php` om je database instellingen aan te passen.

### Session Settings
Sessions worden gebruikt voor:
- Admin authenticatie
- Winkelwagen persistentie
- User preferences

## 📝 Licentie

Dit project is ontwikkeld voor educatieve doeleinden.

## 👤 Contact

**Kevin van de Weert**
- GitHub: [@KevinvdWeert](https://github.com/KevinvdWeert)

Voor vragen of support, neem contact op via het contactformulier op de website.

---

**Sweetshop Candy** - De goedkoopste snoepwinkel van Veenendaal! 🍭
