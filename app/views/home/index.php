<?php include('../app/views/partials/header.php'); ?>
<?php include('../app/views/partials/nav.php'); ?>


<?php include('../app/views/home/hero.php'); ?>

<div class="container mt-4">
    <h2>Latest Movies</h2>
    <div class="row">
        <?php foreach ($data['movies'] as $movie): ?>
            <div class="col-md-3">
                <div class="card mb-4">
                    <img src="<?= URLROOT ?>/uploads/<?= $movie['thumbnail_path'] ?>" class="card-img-top" alt="<?= $movie['title'] ?>">
                    <div class="card-body">
                        <h5 class="card-title"><?= $movie['title'] ?></h5>
                        <a href="<?= URLROOT ?>/movie/detail/<?= $movie['id'] ?>" class="btn btn-primary btn-sm">Watch</a>
                    </div>
                </div>
            </div>
        <?php endforeach; ?>
    </div>
</div>

<?php include('../app/views/partials/footer.php'); ?>
<?php include APPROOT . '/views/auth/login.php'; ?>

<?php if (!empty($data['open_modal'])): ?>
    <script>
        const loginModal = new bootstrap.Modal(document.getElementById('loginModal'));
        loginModal.show();
    </script>
<?php endif; ?>