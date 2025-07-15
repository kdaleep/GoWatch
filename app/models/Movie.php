<?php
class Movie {
    private $db;

    public function __construct() {
        $this->db = (new Database())->getConnection();
    }

    public function getAllPublished() {
        $stmt = $this->db->prepare("SELECT * FROM movies WHERE is_published = 1 ORDER BY created_at DESC");
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }
}
