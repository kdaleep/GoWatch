<?php include('../app/views/partials/header.php'); ?>

<?php
$currentUrl = $_SERVER['REQUEST_URI'];
if (!isset($_SESSION['user_id']) || $_SESSION['is_admin'] != 1) {
    header("Location:" . URLROOT);
    exit;
}
?>

<style>
    .sidebar {
        min-height: 100vh;
        background-color: #f8f9fa;
    }

    .sidebar .list-group-item.active {
        background-color: yellowgreen;
        color: black;
        border: 2px solid #fff;
    }
</style>

<div class="container-fluid">
    <div class="row">
        <!-- Sidebar -->
        <div class="col-md-3 bg-dark sidebar p-0">
            <div class="p-4 bg-dark text-white text-center">
                <h4>Admin Panel</h4>
                <p class="mb-0"><?= htmlspecialchars(strtoupper($_SESSION['user_name'])) ?></p>
            </div>
            <div class="list-group list-group-flush">
                <a href="<?= URLROOT ?>/admin"
                    class="list-group-item list-group-item-action <?= $currentUrl === '/GoWatch/public/admin' ? 'active' : '' ?>">
                    Dashboard
                </a>

                <a href="<?= URLROOT ?>/admin/manage_anime"
                    class="list-group-item list-group-item-action <?= strpos($currentUrl, '/admin/manage_anime') !== false ? 'active' : '' ?>">
                    Manage Anime
                </a>

                <a href="<?= URLROOT ?>/admin/manage_users"
                    class="list-group-item list-group-item-action <?= strpos($currentUrl, '/admin/manage_users') !== false ? 'active' : '' ?>">
                    Manage Users
                </a>

                <a href="<?= URLROOT ?>/auth/logout"
                    class="list-group-item list-group-item-action" style="color:red;">
                    Logout
                </a>

            </div>
        </div>

        <!-- Main Content -->
        <?php if ($currentUrl === '/GoWatch/public/admin'): ?>
            <?php include('../app/views/admin/dashboard.php'); ?>

        <?php elseif ($currentUrl === '/GoWatch/public/admin/manage_anime'): ?>
            <?php include('../app/views/admin/manage_anime.php'); ?>

        <?php elseif ($currentUrl === '/GoWatch/public/admin/manage_users'): ?>
            <?php include('../app/views/admin/manage_users.php'); ?>
        <?php endif; ?>

    </div>
</div>

<?php include('../app/views/partials/footer.php'); ?>