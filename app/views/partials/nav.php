<nav class="navbar navbar-dark fixed-top bg-transparent">
        <div class="container-fluid d-flex align-items-center justify-content-between">

            <!-- Left: Toggle and Brand -->
            <div class="d-flex align-items-center">
                <button class="navbar-toggler me-2" type="button" data-bs-toggle="offcanvas" data-bs-target="#offcanvasMenu"
                    aria-controls="offcanvasMenu">
                    <span class="navbar-toggler-icon"></span>
                </button>
                <a class="navbar-brand mb-0 ms-3" href="<?= URLROOT ?>">
                    <h3>GoWatch</h3>
                </a>
            </div>

            <form class="d-flex flex-grow-1 justify-content-center mx-3" role="search" style="max-width: 500px;">
                <input class="form-control me-2" type="search" placeholder="Search" aria-label="Search" />
                <button class="btn btn-outline-light bg-dark" type="submit">Search</button>
            </form>
            <div>

            </div>
            <?php if (isset($_SESSION['user_id'])): ?>
                <div class="d-flex align-items-center">
                    <span class="text-white me-3">
                        WELCOME, <?= htmlspecialchars(strtoupper($_SESSION['user_name'])) ?>
                    </span>
                    <a href="<?= URLROOT ?>/auth/logout" class="btn btn-theme"><i class="fa-solid fa-right-from-bracket"></i></a>
                </div>
            <?php else: ?>
                <button class="btn btn-theme" type="button" data-bs-toggle="modal" data-bs-target="#loginModal">Login</button>
            <?php endif; ?>
        </div>
    </nav>


    <!-- Offcanvas drawer -->
    <div class="offcanvas offcanvas-start text-bg-dark" tabindex="-1" id="offcanvasMenu"
        aria-labelledby="offcanvasMenuLabel">
        <div class="offcanvas-header">
            <h5 class="offcanvas-title" id="offcanvasMenuLabel">Menu</h5>
            <button type="button" class="btn-close btn-close-white" data-bs-dismiss="offcanvas"
                aria-label="Close"></button>
        </div>
        <div class="offcanvas-body">
            <ul class="navbar-nav">
                <li class="nav-item">
                    <a class="nav-link text-white" href="<?= URLROOT ?>">Home</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link text-white" href="#">Link</a>
                </li>
            </ul>
        </div>
    </div>