<section id="hero">
    <div id="heroCarousel" class="carousel slide" data-bs-ride="carousel">
        <div class="carousel-inner">
            <?php foreach ($data['trending'] as $index => $movie): ?>
                <div class="carousel-item <?= $index === 0 ? 'active' : '' ?>">
                    <div class="hero-slide position-relative text-white py-5" style="background: url('<?= URLROOT ?>/uploads/<?= $movie['thumbnail_path'] ?>') center/cover no-repeat;">

                        <div class="position-absolute top-0 start-0 w-100 h-100" style="background: rgba(0, 0, 0, 0.75);"></div>

                        <div class="h-100 d-flex justify-content-center align-items-center position-relative z-1 mt-5">
                            <div class="col-md-6 bg-dark bg-opacity-75 p-4 rounded">
                                <h1 class="h5 text-color">#<?= htmlspecialchars(++$index) ?> Spotlight</h1>
                                <h1 class="h3"><?= htmlspecialchars($movie['title']) ?></h1>
                                <p class="small"><?= htmlspecialchars($movie['description']) ?></p>
                                <a href="<?= URLROOT ?>/movie/watch?id=<?= $movie['id'] ?>" class="btn btn-theme rounded-pill mt-2">
                                    <i class="fa-solid fa-circle-play"></i> Watch Now
                                </a>
                                <a href="<?= URLROOT ?>/movie/detail/<?= $movie['id'] ?>" class="btn btn-outline-light rounded-pill ms-2 mt-2">
                                    Detail <i class="fa-solid fa-chevron-right"></i>
                                </a>
                            </div>
                        </div>

                    </div>
                </div>
            <?php endforeach; ?>
        </div>


        <button class="carousel-control-prev" type="button" data-bs-target="#heroCarousel" data-bs-slide="prev">
            <span class="carousel-control-prev-icon"></span>
        </button>
        <button class="carousel-control-next" type="button" data-bs-target="#heroCarousel" data-bs-slide="next">
            <span class="carousel-control-next-icon"></span>
        </button>
    </div>
</section>