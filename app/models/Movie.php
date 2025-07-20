<?php
class Movie
{
    private $db;

    public function __construct()
    {
        $this->db = (new Database())->getConnection();
    }

    public function getAllPublished()
    {
        $stmt = $this->db->prepare("SELECT * FROM movies WHERE is_published = 1 ORDER BY created_at DESC");
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public function getCategoryList()
    {
        $stmt = $this->db->prepare("SELECT * FROM categories");
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }


    public function getEpisodeList()
    {
        $stmt = $this->db->prepare("SELECT * FROM episodes");
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }
    public function getTrending()
    {
        $stmt = $this->db->prepare("select * from movies where is_published = 1 ORDER BY created_at DESC limit 5");
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public function insertAnime($title, $desc, $year, $category_id, $video_id, $thumbnail_path, $is_published, $is_trending)
    {
        $sql = "insert into movies (title, description, year, category_id, video_id, thumbnail_path, is_published, is_trending) values
                                    (:title, :description, :year, :category_id, :video_id, :thumbnail_path, :is_published, :is_trending)";
        $stmt = $this->db->prepare($sql);
        $stmt->bindParam(':title', $title);
        $stmt->bindParam(':description', $desc);
        $stmt->bindParam(':year', $year);
        $stmt->bindParam(':category_id', $category_id);
        $stmt->bindParam(':video_id', $video_id);
        $stmt->bindParam(':thumbnail_path', $thumbnail_path);
        $stmt->bindParam(':is_published', $is_published);
        $stmt->bindParam(':is_trending', $is_trending);
        return $stmt->execute();
    }


    public function addEpisode($movieId, $title, $epNo, $videoUrl, $duration, $is_published)
    {
        $sql = "insert into episodes (movie_id, title, ep_no, video_url, duration, is_published) values
                                    (:movie_id, :title, :ep_no, :video_url, :duration, :is_published)";
        $stmt = $this->db->prepare($sql);
        $stmt->bindParam(':movie_id', $movieId);
        $stmt->bindParam(':title', $title);
        $stmt->bindParam(':ep_no', $epNo);
        $stmt->bindParam(':video_url', $videoUrl);
        $stmt->bindParam(':duration', $duration);
        $stmt->bindParam(':is_published', $is_published);
        return $stmt->execute();
    }
}
