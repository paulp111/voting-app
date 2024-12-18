CREATE DATABASE voting_app;
USE voting_app;

CREATE TABLE products (
    id INT AUTO_INCREMENT PRIMARY KEY,
    title VARCHAR(255) NOT NULL,
    image_filename VARCHAR(255) NOT NULL,
    upvotes INT DEFAULT 0,
    downvotes INT DEFAULT 0
);

CREATE TABLE users (
    id INT AUTO_INCREMENT PRIMARY KEY,
    username VARCHAR(50) NOT NULL UNIQUE,
    password VARCHAR(255) NOT NULL
);
