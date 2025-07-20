<?php
class AdminController extends Controller
{
    public function index()
    {
        $movieModel = $this->model('Movie');
        $movies = $movieModel->getAllPublished();
        $categoryList = $movieModel->getCategoryList();
        $episodeList = $movieModel->getEpisodeList();
        $this->view('admin/index', ['movies' => $movies, 'categoryList' => $categoryList, 'episodeList' => $episodeList]);
    }

    public function addAnime()
    {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $title = $_POST['title'];
            $description = $_POST['description'];
            $year = $_POST['year'];
            $categoryId = $_POST['category_id'];
            $videoId = $this->generateVideoId();
            $thumbnailPath = $_POST['thumbnail_path'];
            $isPublished = isset($_POST['is_published']) ? 1 : 0;
            $isTrending = isset($_POST['is_trending']) ? 1 : 0;

            if (isset($_FILES['thumbnail_path']) && $_FILES['thumbnail_path']['error'] === 0) {
                $fileTmp = $_FILES['thumbnail_path']['tmp_name'];
                $fileName = basename($_FILES['thumbnail_path']['name']);
                $uploadDir = '../public/uploads/';
                $uploadPath = $uploadDir . $fileName;

                if (!is_dir($uploadDir)) {
                    mkdir($uploadDir, 0755, true);
                }

                if (move_uploaded_file($fileTmp, $uploadPath)) {
                    $thumbnailPath = $fileName; // For database
                } else {
                    echo "Failed to upload file.";
                    exit;
                }
            } else {
                echo "No thumbnail uploaded.";
                exit;
            }
            $movieModel = $this->model('movie');
            $anime = $movieModel->insertAnime($title, $description, $year, $categoryId, $videoId, $thumbnailPath, $isPublished, $isTrending);

            if ($anime) {
                header("Location:" . URLROOT . "/admin/manage_anime");
                exit;
            } else {
                echo "<script>alert('Something goes wrong.');</script>";
                header("Location:" . URLROOT);
                exit;
            }
        }
    }
    public function addEpisode()
    {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $title = $_POST['title'];
            $movieId = $_POST['anime_id'];
            $epNo = $_POST['ep_no'];
            $VideoUrl = $_POST['video_url'];
            $duration = $_POST['duration'];
            $isPublished = isset($_POST['is_published']) ? 1 : 0;

            $movieModel = $this->model('movie');
            $episode = $movieModel->addEpisode($movieId, $title, $epNo, $VideoUrl, $duration,$isPublished);

            if ($episode) {
                header("Location:" . URLROOT . "/admin/manage_anime");
                exit;
            } else {
                echo "<script>alert('Something goes wrong.');</script>";
                header("Location:" . URLROOT);
                exit;
            }
        }
    }

    public function generateVideoId($length = 6)
    {
        $characters = 'ABCDEFGHIJKLMNOPQRSTUVWXYZabcdefghijklmnopqrstuvwxyz0123456789';
        $videoId = '';
        for ($i = 0; $i < $length; $i++) {
            $videoId .= $characters[rand(0, strlen($characters) - 1)];
        }
        return $videoId;
    }
}
