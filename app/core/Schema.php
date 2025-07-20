<?php
class Schema
{
    private $db;

    public function __construct()
    {
        $this->db = (new Database())->getConnection();
    }

    public function initialize()
    {
        // Users Table
        $this->db->exec("
            CREATE TABLE IF NOT EXISTS users (
                id INT AUTO_INCREMENT PRIMARY KEY,
                name VARCHAR(100) NOT NULL,
                email VARCHAR(150) NOT NULL UNIQUE,
                password_hash VARCHAR(255) NOT NULL,
                is_admin BOOLEAN NOT NULL DEFAULT 0,
                created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
            );
        ");

        // Categories Table
        $this->db->exec("
            CREATE TABLE IF NOT EXISTS categories (
                id INT AUTO_INCREMENT PRIMARY KEY,
                name VARCHAR(50) NOT NULL
            );
        ");

        // Movies Table
        $this->db->exec("
            CREATE TABLE IF NOT EXISTS movies (
                id INT AUTO_INCREMENT PRIMARY KEY,
                title VARCHAR(200) NOT NULL,
                description TEXT,
                year INT,
                category_id INT,
                video_id VARCHAR(50),
                thumbnail_path VARCHAR(255),
                is_published BOOLEAN DEFAULT 0,
                created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
                FOREIGN KEY (category_id) REFERENCES categories(id) ON DELETE SET NULL
            );
        ");

        // Watch History Table
        $this->db->exec("
            CREATE TABLE IF NOT EXISTS watch_history (
                user_id INT NOT NULL,
                movie_id INT NOT NULL,
                watched_at DATETIME DEFAULT CURRENT_TIMESTAMP,
                PRIMARY KEY (user_id, movie_id),
                FOREIGN KEY (user_id) REFERENCES users(id) ON DELETE CASCADE,
                FOREIGN KEY (movie_id) REFERENCES movies(id) ON DELETE CASCADE
            );
        ");

        // Episodes Table
        $this->db->exec("
            CREATE TABLE IF NOT EXISTS episodes (
                id INT AUTO_INCREMENT PRIMARY KEY,
                movie_id INT NOT NULL,
                title VARCHAR(255) NOT NULL,
                ep_no INT NOT NULL,
                video_url TEXT NOT NULL,
                duration VARCHAR(20),
                is_published TINYINT(1) DEFAULT 1,
                created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
                FOREIGN KEY (movie_id) REFERENCES movies(id) ON DELETE CASCADE
            );
        ");
    }
}
