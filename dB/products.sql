CREATE TABLE products (
    id INT(11) AUTO_INCREMENT PRIMARY KEY,
    product_name VARCHAR(255) NOT NULL,
    product_description TEXT NOT NULL,
    price DECIMAL(10,2) NOT NULL,
    stock_quantity INT(11) NOT NULL,
    size ENUM('Adjustable', 'Small', 'Medium', 'Large') NOT NULL,
    date_added TIMESTAMP DEFAULT CURRENT_TIMESTAMP
);
