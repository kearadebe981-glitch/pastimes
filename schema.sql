-- Pastimes database schema
-- Run this once in phpMyAdmin or the MySQL command line to set up the database.

CREATE DATABASE IF NOT EXISTS pastimes;
USE pastimes;

CREATE TABLE IF NOT EXISTS users (
    id INT AUTO_INCREMENT PRIMARY KEY,
    name VARCHAR(100) NOT NULL,
    email VARCHAR(150) NOT NULL UNIQUE,
    password_hash VARCHAR(255) NOT NULL,
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
);

CREATE TABLE IF NOT EXISTS activities (
    id INT AUTO_INCREMENT PRIMARY KEY,
    name VARCHAR(150) NOT NULL,
    category VARCHAR(50) NOT NULL,
    description TEXT NOT NULL,
    location VARCHAR(150) NOT NULL,
    created_by INT,
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    FOREIGN KEY (created_by) REFERENCES users(id) ON DELETE SET NULL
);

-- A few starter activities so the site isn't empty on first run
INSERT INTO activities (name, category, description, location, created_by) VALUES
('Weekend Hiking Group', 'Outdoors', 'A relaxed group hike exploring local trails, suitable for beginners.', 'Melville Koppies', NULL),
('Board Game Night', 'Social', 'Weekly meet-up for strategy and party board games, all skill levels welcome.', 'Braamfontein', NULL),
('Beginner Pottery Class', 'Arts & Crafts', 'Hands-on introduction to the pottery wheel and hand-building techniques.', 'Maboneng', NULL),
('5-a-side Football', 'Sport', 'Casual weekday football games, new players always welcome.', 'Sunward Park', NULL),
('Book Club: Monthly Reads', 'Social', 'A friendly book club that picks a new title each month and meets to discuss it.', 'Online / Boksburg', NULL);
