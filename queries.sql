CREATE DATABASE computer_shop;

CREATE TABLE user
(
    id         BIGINT             NOT NULL DEFAULT UUID_SHORT() PRIMARY KEY,
    first_name VARCHAR(50)        NOT NULL,
    last_name  VARCHAR(50)        NOT NULL,
    username   VARCHAR(50) UNIQUE NOT NULL,
    email      VARCHAR(50) UNIQUE NOT NULL,
    password   VARCHAR(64)        NOT NULL,
    address    VARCHAR(255)       NOT NULL,
    phone      VARCHAR(16)        NOT NULL
);

CREATE TABLE product
(
    id          BIGINT        NOT NULL DEFAULT UUID_SHORT() PRIMARY KEY,
    brand       VARCHAR(50)   NOT NULL,
    model       VARCHAR(50)   NOT NULL,
    name        VARCHAR(50)   NOT NULL,
    description VARCHAR(255)  NOT NULL,
    price       DOUBLE(10, 2) NOT NULL,
    createdAt   TIMESTAMP     NOT NULL DEFAULT CURRENT_TIMESTAMP
);

CREATE TABLE purchase
(
    id         INT       NOT NULL AUTO_INCREMENT PRIMARY KEY,
    product_id BIGINT    NOT NULL,
    user_id    BIGINT    NOT NULL,
    date_time  TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP,
    purchased  BIT       NOT NULL DEFAULT 0,
    quantity   INT       NOT NULL DEFAULT 1,
    FOREIGN KEY (product_id) REFERENCES product (id),
    FOREIGN KEY (user_id) REFERENCES user (id)
);

# username: admin  password: admin
INSERT INTO user (first_name, last_name, username, email, password, address, phone)
VALUES ('Lesley', 'Lafen', 'admin', 'admin@comptech.com',
        '$2y$10$l3jF161dOnkWOcUuE6jFtO12NW2ZEUJpzr3sg4458U2O8THRj4p52', 'Girne, TRNC', '+90123456789');

# username: johndoe  password: john@doe
INSERT INTO user (first_name, last_name, username, email, password, address, phone)
VALUES ('John', 'Doe', 'johndoe', 'johndoe@example.com', '$2y$10$5SFupZ1baREeYoj4XcAIkuvPwbaA2SeFV.TrA0M6PiAuIzJ8BCkom',
        'Some Place, Some Country', '+90123456789');


INSERT INTO product (name, brand, model, description, price)
VALUES ('IPS Monitor', 'AOC', '27BEH',
        'Full HD monitor with accurate color display. Perfect for movies and video games.', 350);