CREATE TABLE user (
    id INT NOT NULL AUTO_INCREMENT PRIMARY KEY,
    first_name VARCHAR(50) NOT NULL,
    last_name VARCHAR(50) NOT NULL,
    username VARCHAR(50) UNIQUE NOT NULL,
    email VARCHAR(50) UNIQUE NOT NULL,
    password VARCHAR(64) NOT NULL,
    address VARCHAR(255) NOT NULL,
    telephone VARCHAR(16) NOT NULL
);

CREATE TABLE product (
    id INT NOT NULL AUTO_INCREMENT PRIMARY KEY,
    brand VARCHAR(50) NOT NULL,
    model VARCHAR(50) NOT NULL,
    name VARCHAR(50) NOT NULL,
    description VARCHAR(255) NOT NULL,
    price DOUBLE(10,2) NOT NULL,
    createdAt TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP
);

CREATE TABLE purchase (
    id INT NOT NULL AUTO_INCREMENT PRIMARY KEY,
    product_id INT NOT NULL,
    user_id INT NOT NULL,
    date_time TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP,
    is_purchased BIT NOT NULL DEFAULT 0,
    amount INT NOT NULL DEFAULT 1,
    FOREIGN KEY (product_id) REFERENCES product(id),
    FOREIGN KEY (user_id) REFERENCES user(id)
);

INSERT INTO user (first_name, last_name, username, email, password, address, telephone)
VALUES ('Lesley', 'Lafen', 'lafenlesley@gmail.com', '$2y$10$iQg.eRx8sWOm38my26VqAuTBgmLrp7XsZraBWocx05heQWf6eDXEG', 'Girne, TRNC', '+905338237807');

INSERT INTO product (brand, model, name, description, price)
VALUES ('HP', 'MVL650', 'LCD Monitor', 'The best monitor description', 350);