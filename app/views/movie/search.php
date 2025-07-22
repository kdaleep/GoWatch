<?php include('../app/views/partials/header.php'); ?>
<?php include('../app/views/partials/nav.php'); ?>


<div class="container-fluid bg-dark pt-5">
    <h4 class="text-light mt-5 mb-4">
        Search Results for: <span style="color:#f88ac5;"><?= htmlspecialchars($data['query']) ?></span>
    </h4>

    <?php if (count($data['movies']) === 0): ?>
        <div class="alert alert-secondary text-center">No movies found.</div>
    <?php else: ?>
        <div class="row">
            <?php foreach ($data['movies'] as $movie): ?>
                <div class="col-md-3 mb-4">
                    <div class="card bg-dark text-white h-100 shadow border-0 movie-card" style="transition: transform 0.3s;">
                        <img src="<?= URLROOT ?>/uploads/<?= $movie['thumbnail_path'] ?>" class="card-img-top" alt="<?= $movie['title'] ?>" style="height: 250px; object-fit: cover;">
                        <div class="card-body d-flex flex-column justify-content-between">
                            <h5 class="card-title text-truncate"><?= htmlspecialchars($movie['title']) ?></h5>
                            <a href="<?= URLROOT ?>/movie/watch?id=<?= $movie['id'] ?>" class="btn btn-sm btn-success mt-2">Watch Now</a>
                        </div>
                    </div>
                </div>
            <?php endforeach; ?>
        </div>
    <?php endif; ?>
</div>

<?php include('../app/views/partials/footer.php'); ?>
<?php include('../app/views/auth/login.php'); ?>

