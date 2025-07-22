<style>
    .trending-scroll-wrapper {
        position: relative;
    }

    .trending-scroll {
        display: flex;
        overflow-x: auto;
        scroll-behavior: smooth;
        gap: 2rem;
        padding: 1rem 0;
    }

    .trending-card {
        flex: 0 0 auto;
        width: 120px;
        background-color: transparent;
        color: white;
        text-align: center;
        position: relative;
    }

    .trending-card img {
        height: 180px;
        width: 100%;
        object-fit: cover;
        border-radius: 6px;
        box-shadow: 0 2px 5px rgba(0, 0, 0, 0.4);
    }

    .vertical-title {
        writing-mode: vertical-rl;
        text-orientation: mixed;
        transform: rotate(180deg);
        font-size: 0.9rem;
        color: white;
        margin: 0 auto;
        height: 180px;
        display: flex;
        align-items: center;
        justify-content: center;
        white-space: nowrap;
        overflow: hidden;
        text-overflow: ellipsis;
    }

    .title-wrapper {
        position: absolute;
        top: 0;
        left: -40px;
        width: 40px;
        height: 100%;
        display: flex;
        align-items: center;
        justify-content: center;
    }

    .card-number {
        margin-top: 0.4rem;
        font-size: 0.9rem;
        color: #f88ac5;
    }

    .scroll-btn {
        position: absolute;
        top: 50%;
        transform: translateY(-50%);
        z-index: 2;
        background: rgba(0, 0, 0, 0.5);
        border: none;
        color: white;
        padding: 0.5rem 1rem;
        font-size: 1.5rem;
        cursor: pointer;
    }

    .scroll-btn-left {
        left: 0;
    }

    .scroll-btn-right {
        right: 0;
    }
</style>

<div class="container-fluid bg-dark pt-4">
    <div class="row justify-content-center">
        <h3 style="color: #f88ac5;">Trending</h3>
        <div class="trending-scroll-wrapper">
            <button class="scroll-btn scroll-btn-left" onclick="scrollTrending(-1)">&#8249;</button>
            <div class="trending-scroll" id="trendingScroll">
                <?php foreach ($data['movies'] as $index => $movie): ?>
                    <div class="trending-card ms-2 me-2">
                        <div class="title-wrapper">
                            <div class="vertical-title"><?= $movie['title'] ?></div>
                        </div>
                        <a href="<?= URLROOT ?>/movie/watch?id=<?= $movie['id'] ?>"><img src="<?= URLROOT ?>/uploads/<?= $movie['thumbnail_path'] ?>" alt="<?= $movie['title'] ?>"></a>
                        <div class="card-number"><?= str_pad($index + 1, 2, '0', STR_PAD_LEFT) ?></div>
                    </div>
                <?php endforeach; ?>
            </div>
            <button class="scroll-btn scroll-btn-right" onclick="scrollTrending(1)">&#8250;</button>
        </div>
    </div>
</div>

<script>
    function scrollTrending(direction) {
        const scrollContainer = document.getElementById('trendingScroll');
        const scrollAmount = 140 * 5 + 2 * 5 * 16;
        scrollContainer.scrollBy({
            left: direction * scrollAmount,
            behavior: 'smooth'
        });
    }
</script>
