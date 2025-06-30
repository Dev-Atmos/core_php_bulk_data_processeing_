-- Active: 1745814293599@@127.0.0.1@3306@bulk_data_processing
-- Drop existing if exists
DROP TABLE IF EXISTS payments, order_items, orders, products, categories;
DROP TABLE IF EXISTS contacts, customers, companies, locations;
DROP TABLE IF EXISTS staging_table;

-- 1. Staging Table
CREATE TABLE IF NOT EXISTS staging_table (
  id INT NOT NULL AUTO_INCREMENT,
  Customer_Id VARCHAR(50),
  First_Name VARCHAR(50),
  Last_Name VARCHAR(50),
  Company VARCHAR(150),
  City VARCHAR(50),
  Country VARCHAR(50),
  Phone_1 VARCHAR(20),
  Phone_2 VARCHAR(20),
  Email VARCHAR(100),
  Subscription_Date DATE,
  Website VARCHAR(250),
  PRIMARY KEY (id)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- 2. Companies
CREATE TABLE companies (
  id INT AUTO_INCREMENT PRIMARY KEY,
  name VARCHAR(150) NOT NULL,
  UNIQUE(name)
);

-- 3. Locations
CREATE TABLE locations (
  id INT AUTO_INCREMENT PRIMARY KEY,
  city VARCHAR(50),
  country VARCHAR(50),
  UNIQUE(city, country)
);

-- 4. Customers
CREATE TABLE customers (
  id INT AUTO_INCREMENT PRIMARY KEY,
  customer_uid VARCHAR(50) UNIQUE,
  first_name VARCHAR(50),
  last_name VARCHAR(50),
  email VARCHAR(100) UNIQUE,
  subscription_date DATE,
  company_id INT,
  location_id INT,
  FOREIGN KEY (company_id) REFERENCES companies(id),
  FOREIGN KEY (location_id) REFERENCES locations(id)
);

-- 5. Contacts
CREATE TABLE contacts (
  id INT AUTO_INCREMENT PRIMARY KEY,
  customer_id INT,
  phone_1 VARCHAR(20),
  phone_2 VARCHAR(20),
  website VARCHAR(250),
  FOREIGN KEY (customer_id) REFERENCES customers(id) ON DELETE CASCADE
);

-- 6. Product Categories
CREATE TABLE categories (
  id INT AUTO_INCREMENT PRIMARY KEY,
  name VARCHAR(100) NOT NULL,
  slug VARCHAR(100) UNIQUE
);

-- 7. Products
CREATE TABLE products (
  id INT AUTO_INCREMENT PRIMARY KEY,
  name VARCHAR(150) NOT NULL,
  slug VARCHAR(150) UNIQUE,
  description TEXT,
  price DECIMAL(10,2),
  stock INT,
  category_id INT,
  FOREIGN KEY (category_id) REFERENCES categories(id)
);

-- 8. Orders
CREATE TABLE orders (
  id INT AUTO_INCREMENT PRIMARY KEY,
  customer_id INT,
  order_date DATETIME DEFAULT CURRENT_TIMESTAMP,
  total DECIMAL(10,2) DEFAULT 0.00,
  status ENUM('pending', 'paid', 'shipped', 'cancelled') DEFAULT 'pending',
  FOREIGN KEY (customer_id) REFERENCES customers(id)
);

-- 9. Order Items
CREATE TABLE order_items (
  id INT AUTO_INCREMENT PRIMARY KEY,
  order_id INT,
  product_id INT,
  quantity INT,
  price DECIMAL(10,2),
  FOREIGN KEY (order_id) REFERENCES orders(id),
  FOREIGN KEY (product_id) REFERENCES products(id)
);

-- 10. Payments
CREATE TABLE payments (
  id INT AUTO_INCREMENT PRIMARY KEY,
  order_id INT,
  payment_date DATETIME DEFAULT CURRENT_TIMESTAMP,
  amount DECIMAL(10,2),
  method ENUM('credit_card', 'bank_transfer', 'upi', 'cod') DEFAULT 'cod',
  status ENUM('pending', 'completed', 'failed') DEFAULT 'pending',
  FOREIGN KEY (order_id) REFERENCES orders(id)
);
