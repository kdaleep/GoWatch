<?php
class AuthController extends Controller
{
    public function login()
    {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $email = trim($_POST['email']);
            $password = $_POST['password'];

            $userModel = $this->model('user');
            $user = $userModel->findByEmail($email);

            if ($user && password_verify($password, $user['password_hash'])) {
                $_SESSION['user_id'] = $user['id'];
                $_SESSION['user_name'] = $user['name'];
                $_SESSION['is_admin'] = $user['is_admin'];

                if ($_SESSION['is_admin'] == 1) {
                    header("Location:" . URLROOT . "/admin");
                } else {
                    header("Location:" . URLROOT);
                }
                exit;
            } else {
                echo "<script>alert('login failed check your credentials.');</script>";
                header("Location:" . URLROOT);
                exit;
            }
        }
    }

    public function logout()
    {
        session_destroy();
        header("Location:" . URLROOT);
        exit;
    }

    public function register()
    {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $name = $_POST['name'];
            $email = trim($_POST['email']);
            $password = $_POST['password'];
            $conf_password = $_POST['confirm_password'];
            if ($password === $conf_password) {
                $userModel = $this->model('user');
                $hashedPassword = password_hash($password, PASSWORD_DEFAULT);
                if ($userModel->registerUser($name, $email, $hashedPassword)) {
                    echo "<script>alert('User registered')</script>";
                    header("Location:" . URLROOT);
                    exit;
                } else {
                    echo "<script>alert('Registration failed. Please try again later.');</script>";
                    exit;
                }
            } else {
                echo "<script>alert('Password mismatch. Check and re-enter.');</script>";
                exit;
            }
        }
    }
}
