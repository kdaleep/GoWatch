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


    public function getEpisodeList($movieId)
    {
        $stmt = $this->db->prepare("SELECT * FROM episodes WHERE movie_id = :movie_id");
        $stmt->bindParam(':movie_id', $movieId, PDO::PARAM_INT);
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

    public function updateAnime($movieId, $data)
    {
        $stmt = $this->db->prepare("update movies SET title = :title, description = :description, year = :year, category_id = :category_id, thumbnail_path = :thumbnail_path, is_published = :is_published, is_trending = :is_trending WHERE id = :id");

        $stmt->bindParam(':id', $movieId);
        $stmt->bindParam(':title', $data['title']);
        $stmt->bindParam(':description', $data['description']);
        $stmt->bindParam(':year', $data['year']);
        $stmt->bindParam(':category_id', $data['category_id']);
        $stmt->bindParam(':thumbnail_path', $data['thumbnail_path']);
        $stmt->bindParam(':is_published', $data['is_published']);
        $stmt->bindParam(':is_trending', $data['is_trending']);

        return $stmt->execute();
    }



    public function deleteAnime($movieId)
    {
        $stmt = $this->db->prepare("delete from movies where id = :id");
        $stmt->bindParam(':id', $movieId);
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



    public function searchByTitle($query)
    {
        $stmt = $this->db->prepare("SELECT * FROM movies WHERE title LIKE :query");
        $stmt->execute(['query' => "%$query%"]);
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }
}
