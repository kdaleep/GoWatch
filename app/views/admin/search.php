<?php include('../app/views/partials/header.php'); ?>
<?php include('../app/views/partials/nav.php'); ?>

<div class="container-fluid bg-dark pt-5">
    <h4 class="text-light mt-5 mb-4">
        Search Results for: <span style="color:#f88ac5;"><?= htmlspecialchars($data['query']) ?></span>
    </h4>

    <div class="table-responsive">
        <table class="table table-dark table-striped table-bordered-0 text-white">
            <thead class="thead-light">
                <tr>
                    <th>#</th>
                    <th>Thumbnail</th>
                    <th>Title</th>
                    <th>Action</th>
                </tr>
            </thead>
            <tbody>
                <?php if (count($data['movies']) === 0): ?>
                    <tr>
                        <td colspan="4" class="text-center text-secondary">No movies found.</td>
                    </tr>
                <?php else: ?>
                    <?php foreach ($data['movies'] as $index => $movie): ?>
                        <tr>
                            <td><?= $index + 1 ?></td>
                            <td style="width: 100px;">
                                <img src="<?= URLROOT ?>/uploads/<?= $movie['thumbnail_path'] ?>" alt="<?= $movie['title'] ?>" style="width: 80px; height: 50px; object-fit: cover;">
                            </td>
                            <td><?= htmlspecialchars($movie['title']) ?></td>
                            <td>
                                <a href="<?= URLROOT ?>/movie/watch?id=<?= $movie['id'] ?>" class="btn btn-sm btn-success">Watch Now</a>
                            </td>
                        </tr>
                    <?php endforeach; ?>
                <?php endif; ?>
            </tbody>
        </table>
    </div>
</div>

<?php include('../app/views/partials/footer.php'); ?>
<?php include('../app/views/auth/login.php'); ?>
