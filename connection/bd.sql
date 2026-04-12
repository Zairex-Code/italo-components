
CREATE DATABASE italo_components;
USE italo_components;

CREATE TABLE inventory (
    id INT AUTO_INCREMENT PRIMARY KEY,
    name VARCHAR(100) NOT NULL,
    image VARCHAR(255),
    category varchar(100) NOT null,
    price DECIMAL(10,2) NOT NULL,
    stock INT DEFAULT 0
);

CREATE TABLE sales (
    id INT AUTO_INCREMENT PRIMARY KEY,
    inventory_id INT,
    customer_name VARCHAR(100) NOT NULL,
    quantity INT NOT NULL,
    sale_date TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    CONSTRAINT fk_inventory_sales 
    FOREIGN KEY (inventory_id) REFERENCES inventory(id)
);


