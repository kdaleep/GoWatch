<?php
class AdminController extends Controller
{
    public function index()
    {
        $movieModel = $this->model('Movie');
        $userModel = $this->model('User');
        $users = $userModel->getAll();
        $movies = $movieModel->getAllPublished();
        $categoryList = $movieModel->getCategoryList();
        $this->view('admin/index', ['movies' => $movies, 'categoryList' => $categoryList, 'users' => $users]);
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
                    $thumbnailPath = $fileName;
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
            echo '<pre>';
            print_r($_POST);
            echo '</pre>';


            $movieModel = $this->model('movie');
            $episode = $movieModel->addEpisode($movieId, $title, $epNo, $VideoUrl, $duration, $isPublished);

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

    public function updateAnime()
    {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $movieModel = $this->model('Movie');
            $id = $_POST['id'];
            $title = $_POST['title'];
            $description = $_POST['description'];
            $year = $_POST['year'];
            $categoryId = $_POST['category_id'];
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
                    $thumbnailPath = $fileName;
                } else {
                    echo "Failed to upload file.";
                    exit;
                }
            } else {
                $thumbnailPath = $_POST['old_thumbnail_path'];
            }

            $movieModel->updateAnime($id, [
                'title' => $title,
                'description' => $description,
                'year' => $year,
                'category_id' => $categoryId,
                'thumbnail_path' => $thumbnailPath,
                'is_published' => $isPublished,
                'is_trending' => $isTrending,
            ]);


            header("Location: " . URLROOT . "/admin/manage_anime");
        }
    }


    public function deleteAnime()
    {
        $movieModel = $this->model('Movie');
        $movieId = isset($_GET['id']) ? intval($_GET['id']) : null;

        if ($movieId) {
            $movieModel->deleteAnime($movieId);
            header("Location: " . URLROOT . "/admin/manage_anime");
            exit;
        } else {
            die("Invalid movie ID. $movieId");
        }
    }


    public function search()
    {
        $query = isset($_GET['query']) ? trim($_GET['query']) : '';

        if ($query === '') {
            $movies = [];
        } else {
            $movieModel = $this->model('Movie');
            $movies = $movieModel->searchByTitle($query);
        }

        $this->view('admin/search', ['movies' => $movies, 'query' => $query]);
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




    // manage_users
    public function addUser()
    {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $name = $_POST['name'];
            $email = $_POST['email'];
            $password = $_POST['password'];
            $isAdmin = isset($_POST['is_admin']) ? 1 : 0;
            $passwordHash = password_hash($password, PASSWORD_BCRYPT);
            $userModel = $this->model('User');
            $created = $userModel->create([
                'name' => $name,
                'email' => $email,
                'password_hash' => $passwordHash,
                'is_admin' => $isAdmin,
            ]);

            if ($created) {
                header("Location:" . URLROOT . "/admin/manage_users");
                exit;
            } else {
                header("Location:" . URLROOT);
                exit;
            }
        }
    }

    public function updateUser()
    {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $id = $_POST['id'];
            $name = $_POST['name'];
            $email = $_POST['email'];
            $isAdmin = isset($_POST['is_admin']) ? 1 : 0;

            $userModel = $this->model('User');
            $userModel->update($id, [
                'name' => $name,
                'email' => $email,
                'is_admin' => $isAdmin,
            ]);

            header("Location:" . URLROOT . "/admin/manage_users");
            exit;
        }
    }

    public function deleteUser()
    {
        $userId = isset($_GET['id']) ? intval($_GET['id']) : null;

        if ($userId) {
            $userModel = $this->model('User');
            $userModel->delete($userId);
            header("Location:" . URLROOT . "/admin/manage_users");
            exit;
        } else {
            die("Invalid user ID.");
        }
    }

    public function searchUser()
    {
        $query = isset($_GET['query']) ? trim($_GET['query']) : '';

        if ($query === '') {
            $users = [];
        } else {
            $userModel = $this->model('User');
            $users = $userModel->searchByNameOrEmail($query);
        }

        $this->view('admin/search_user', ['users' => $users, 'query' => $query]);
    }
}
