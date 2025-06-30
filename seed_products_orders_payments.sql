INSERT INTO categories (name, slug) VALUES
('Electronics', 'electronics'),
('Books', 'books'),
('Clothing', 'clothing'),
('Home & Kitchen', 'home_kitchen'),
('Beauty & Health', 'beauty_health'),
('Toys & Games', 'toys_games'),
('Sports & Outdoors', 'sports_outdoors'),
('Automotive', 'automotive'),
('Grocery', 'grocery'),
('Office Supplies', 'office_supplies');

INSERT INTO products (name, slug, description, price, stock, category_id) VALUES
('Wireless Noise Cancelling Headphones', 'wireless-noise-cancelling-headphones', 'Enjoy immersive sound with long battery life.', 159.99, 120, 1),
('Ergonomic Office Chair', 'ergonomic-office-chair', 'Comfortable chair with lumbar support.', 89.50, 75, 4),
('Smart LED TV 42-inch', 'smart-led-tv-42-inch', 'Full HD Smart TV with built-in apps.', 289.99, 34, 1),
('Organic Baby Shampoo', 'organic-baby-shampoo', 'Gentle and natural baby care product.', 7.99, 230, 5),
('Classic White T-Shirt', 'classic-white-t-shirt', '100% cotton everyday wear.', 12.00, 200, 3),
('Bluetooth Speaker Compact', 'bluetooth-speaker-compact', 'Portable speaker with powerful sound.', 35.49, 150, 1),
('Gaming Mouse RGB', 'gaming-mouse-rgb', 'High DPI with customizable buttons.', 22.75, 60, 10),
('Non-stick Frying Pan 12-inch', 'non-stick-frying-pan-12-inch', 'Durable and easy to clean.', 24.99, 95, 4),
('Adventure Novel Hardcover', 'adventure-novel-hardcover', 'Thrilling story packed with action.', 15.00, 100, 2),
('Resistance Bands Set', 'resistance-bands-set', 'Perfect for home workouts.', 18.50, 85, 7);
