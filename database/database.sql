CREATE TABLE products (
    id INT AUTO_INCREMENT PRIMARY KEY,
    name VARCHAR(255) NOT NULL,
    description TEXT,
    price DECIMAL(10, 2) NOT NULL,
    image_url VARCHAR(255)
);

INSERT INTO products (name, description, price, image_url) VALUES
('Chocolade Reep', 'Heerlijke chocolade reep met karamel.', 2.50, 'assets/img/products/chocolade_reep.jpg'),
('Drop Lolly', 'Zoete drop lolly voor de liefhebber.', 1.00, 'assets/img/products/drop_lolly.jpg'),
('Fruit Gummies', 'Zachte fruit gummies in diverse smaken.', 3.00, 'assets/img/products/fruit_gummies.jpg'),
('Zure Beren', 'Zure gummy beren in verschillende smaken.', 2.75, 'assets/img/products/zure_beren.jpg'),
('Kauwgomballen', 'Kleurrijke kauwgomballen met een fruitsmaak.', 1.50, 'assets/img/products/kauwgomballen.jpg'),
('Kaneelstokken', 'Krokante kaneelstokken met een warme smaak.', 2.00, 'assets/img/products/kaneelstokken.jpg'),
('Marshmallows', 'Zachte marshmallows, perfect om te roosteren.', 3.25, 'assets/img/products/marshmallows.jpg'),
('Luxe Bonbons', 'Een selectie van luxe bonbons met diverse vullingen.', 5.00, 'assets/img/products/luxe_bonbons.jpg'),
('Trekdrop', 'Zoute trekdrop voor de echte drop liefhebber.', 1.75, 'assets/img/products/trekdrop.jpg'),
('Pepermunt', 'Verfrissende pepermuntjes voor een frisse adem.', 1.25, 'assets/img/products/pepermunt.jpg'),
('Winegums', 'Klassieke winegums in diverse fruit smaken.', 2.25, 'assets/img/products/winegums.jpg'),
('Chocolade Munten', 'Gouden chocolade munten, leuk om te geven en te krijgen.', 3.50, 'assets/img/products/chocolade_munten.jpg'),
('Salmiak Ruiten', 'Sterke salmiak ruiten voor de liefhebber van zoute drop.', 2.50, 'assets/img/products/salmiak_ruiten.jpg'),
('Boterbabbelaars', 'Zachte, romige boterbabbelaars uit Zeeland.', 3.00, 'assets/img/products/boterbabbelaars.jpg'),
('Autodrop', 'Verschillende smaken autodrop in één zak.', 2.80, 'assets/img/products/autodrop.jpg'),
('Tum Tum', 'Zoete en fruitige tum tum snoepjes.', 1.90, 'assets/img/products/tum_tum.jpg'),
('Engelse Drop', 'Een mix van verschillende soorten drop.', 2.60, 'assets/img/products/engelse_drop.jpg'),
('Duimdrop', 'Zachte drop in de vorm van een duim.', 2.10, 'assets/img/products/duimdrop.jpg'),
('Zoute Haringen', 'Zachte, zoute drop in de vorm van haringen.', 2.30, 'assets/img/products/zoute_haringen.jpg'),
('Katjes', 'Zachte drop in de vorm van katjes.', 2.40, 'assets/img/products/katjes.jpg'),
('Big Ben', 'Harde, zoete dropstaven.', 1.80, 'assets/img/products/big_ben.jpg'),
('Napoleon', 'Zoetzure snoepjes met een poeder vulling.', 2.90, 'assets/img/products/napoleon.jpg'),
('King Pepermunt', 'Extra sterke pepermunt voor een langdurige frisse adem.', 1.60, 'assets/img/products/king_pepermunt.jpg'),
('Wilhelmina Pepermunt', 'Klassieke pepermunt met een koninklijk tintje.', 1.70, 'assets/img/products/wilhelmina_pepermunt.jpg'),
('Mentos', 'Kauw snoepjes met een zachte binnenkant en een harde buitenkant.', 2.70, 'assets/img/products/mentos.jpg'),
('Stimorol', 'Kauwgom met verschillende smaken.', 2.60, 'assets/img/products/stimorol.jpg'),
('Fruittella', 'Zachte fruit snoepjes met natuurlijke kleur- en smaakstoffen.', 2.80, 'assets/img/products/fruittella.jpg'),
('Look-o-Look', 'Verrassende snoepmixen in verschillende vormen en smaken.', 3.10, 'assets/img/products/look_o_look.jpg'),
('Jelly Beans', 'Kleurrijke jelly beans met diverse fruit smaken.', 3.30, 'assets/img/products/jelly_beans.jpg'),
('Skittles', 'Kleurrijke snoepjes met een fruit smaak.', 3.00, 'assets/img/products/skittles.jpg'),
('M&Ms', 'Chocolade snoepjes met een gekleurd suikerlaagje.', 3.20, 'assets/img/products/m_ms.jpg');

CREATE TABLE customers (
    id INT AUTO_INCREMENT PRIMARY KEY,
    first_name VARCHAR(255) NOT NULL,
    last_name VARCHAR(255) NOT NULL,
    email VARCHAR(255) NOT NULL UNIQUE,
    address VARCHAR(255),
    city VARCHAR(255),
    zip_code VARCHAR(10)
);

INSERT INTO customers (first_name, last_name, email, address, city, zip_code) VALUES
('Jan', 'Jansen', 'jan.jansen@example.com', 'Dorpsstraat 1', 'Utrecht', '3511XX'),
('Piet', 'Pietersen', 'piet.pietersen@example.com', 'Stationsweg 2', 'Amsterdam', '1012AB'),
('Marie', 'de Vries', 'marie.devries@example.com', 'Marktplein 3', 'Rotterdam', '3011AA');

CREATE TABLE orders (
    id INT AUTO_INCREMENT PRIMARY KEY,
    customer_id INT NOT NULL,
    order_date DATETIME DEFAULT CURRENT_TIMESTAMP,
    total_amount DECIMAL(10, 2) NOT NULL,
    status ENUM('pending', 'processing', 'shipped', 'delivered', 'cancelled') DEFAULT 'pending',
    FOREIGN KEY (customer_id) REFERENCES customers(id)
);

INSERT INTO orders (customer_id, total_amount, status) VALUES
(1, 25.50, 'pending'),
(2, 12.00, 'processing'),
(3, 37.75, 'shipped');

CREATE TABLE orderline (
    id INT AUTO_INCREMENT PRIMARY KEY,
    order_id INT NOT NULL,
    product_id INT NOT NULL,
    quantity INT NOT NULL,
    price DECIMAL(10, 2) NOT NULL,
    FOREIGN KEY (order_id) REFERENCES orders(id),
    FOREIGN KEY (product_id) REFERENCES products(id)
);

INSERT INTO orderline (order_id, product_id, quantity, price) VALUES
(1, 1, 2, 2.50),
(1, 3, 1, 3.00),
(1, 10, 5, 1.25),
(2, 2, 3, 1.00),
(2, 5, 2, 1.50),
(3, 4, 1, 2.75),
(3, 8, 2, 5.00),
(3, 12, 3, 3.50);

CREATE TABLE users (
    id INT AUTO_INCREMENT PRIMARY KEY,
    username VARCHAR(255) NOT NULL UNIQUE,
    password VARCHAR(255) NOT NULL
);

INSERT INTO users (username, password) VALUES
('admin', '$2y$10$e0NR0n6Qw8QyQqQw8QyQqOQw8QyQqQw8QyQqQw8QyQqQw8QyQqQy');