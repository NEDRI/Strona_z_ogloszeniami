CREATE TABLE users (
  id INT AUTO_INCREMENT PRIMARY KEY,
  email VARCHAR(100) NOT NULL UNIQUE,
  password VARCHAR(100) NOT NULL,
  phone_number VARCHAR(15),
  created_at DATETIME NOT NULL
);

CREATE TABLE addresses (
  id INT AUTO_INCREMENT PRIMARY KEY,
  user_id INT NOT NULL,
  street VARCHAR(100) NOT NULL,
  city VARCHAR(100) NOT NULL,
  postal_code VARCHAR(20) NOT NULL,
  country VARCHAR(100) NOT NULL,
  FOREIGN KEY (user_id) REFERENCES users(id)
);

CREATE TABLE categories (
  id INT AUTO_INCREMENT PRIMARY KEY,
  name VARCHAR(100) NOT NULL UNIQUE,
  description TEXT,
  parent_category_id INT,
  FOREIGN KEY (parent_category_id) REFERENCES categories(id)
);

INSERT INTO `categories` (`id`, `name`, `description`, `parent_category_id`) VALUES
(1, 'Automobiles', 'Cars, trucks, motorcycles, and other vehicles', NULL),
(2, 'Real Estate', 'Houses, apartments, and commercial properties', NULL),
(3, 'Electronics', 'Phones, computers, TVs, and other electronic devices', NULL),
(4, 'Furniture', 'Sofas, chairs, tables, and other furniture items', NULL),
(5, 'Clothing', 'Shirts, pants, dresses, and other clothing items', NULL),
(6, 'Jobs', 'Job listings and employment opportunities', NULL),
(7, 'Services', 'Various services such as cleaning, repair, and maintenance', NULL),
(8, 'Pets', 'Dogs, cats, birds, and other pets for sale or adoption', NULL),
(9, 'Sports', 'Sporting goods, equipment, and gear', NULL),
(10, 'Books', 'New and used books for sale', NULL),
(11, 'Toys', 'Toys and games for children', NULL),
(12, 'Health & Beauty', 'Cosmetics, skincare products, and wellness items', NULL),
(13, 'Home & Garden', 'Tools, appliances, and gardening equipment', NULL),
(14, 'Music & Instruments', 'Musical instruments and audio equipment', NULL),
(15, 'Art & Collectibles', 'Paintings, sculptures, and collectible items', NULL),
(16, 'Antiques', 'Vintage and antique items for sale', NULL),
(17, 'Travel', 'Travel packages, flights, and accommodations', NULL),
(18, 'Food & Beverages', 'Food items, beverages, and groceries', NULL),
(19, 'Events', 'Tickets and information for events and entertainment', NULL),
(20, 'Education', 'Courses, classes, and educational materials', NULL),
(21, 'Beauty & Wellness', 'Spas, salons, and wellness services', NULL),
(22, 'Photography', 'Cameras, lenses, and photography services', NULL),
(23, 'Gaming', 'Video games, consoles, and gaming accessories', NULL),
(24, 'Collectibles', 'Rare and unique collectible items', NULL),
(25, 'Jewelry', 'Rings, necklaces, bracelets, and other jewelry items', NULL),
(26, 'Other', 'Other categories', NULL); -- Dodana kategoria "Other"

CREATE TABLE listings (
  id INT AUTO_INCREMENT PRIMARY KEY,
  title VARCHAR(255) NOT NULL,
  description TEXT,
  price DECIMAL(10,2) NOT NULL,
  currency VARCHAR(3) NOT NULL,
  user_id INT NOT NULL,
  category_id INT NOT NULL,
  status ENUM('active', 'pending', 'sold') NOT NULL DEFAULT 'active',
  created_at DATETIME NOT NULL,
  updated_at DATETIME,
  description_until DATE, -- Dodana kolumna
  FOREIGN KEY (user_id) REFERENCES users(id),
  FOREIGN KEY (category_id) REFERENCES categories(id)
);

CREATE TABLE images (
  id INT AUTO_INCREMENT PRIMARY KEY,
  url VARCHAR(500) NOT NULL,
  listing_id INT NOT NULL,
  FOREIGN KEY (listing_id) REFERENCES listings(id)
);

CREATE TABLE reviews (
  id INT AUTO_INCREMENT PRIMARY KEY,
  reviewer_id INT NOT NULL,
  listing_id INT NOT NULL,
  rating INT NOT NULL CHECK (rating BETWEEN 1 AND 5),
  review_text TEXT,
  created_at DATETIME NOT NULL,
  FOREIGN KEY (reviewer_id) REFERENCES users(id),
  FOREIGN KEY (listing_id) REFERENCES listings(id)
);
