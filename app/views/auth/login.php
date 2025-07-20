<div class="modal fade" id="loginModal" tabindex="-1" aria-labelledby="loginModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content bg-dark bg-opacity-75 text-white border-0 rounded-4 shadow-lg">
            <div class="modal-header border-0">
                <h5 class="modal-title w-100 text-center" id="modalTitle">Welcome back!</h5>
                <button type="button" class="btn-close btn-close-white position-absolute end-0 me-3" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>

            <div class="container ms-2 me-2">
                <!-- Login Form -->
                <form id="loginForm" action="<?= URLROOT ?>/auth/login" method="POST">
                    <div class="modal-body">
                        <?php if (!empty($data['error'])): ?>
                            <div class="alert alert-danger"><?= $data['error'] ?></div>
                        <?php endif; ?>

                        <div class="mb-3">
                            <label class="form-label">Email</label>
                            <input type="email" name="email" class="form-control" placeholder="name@email.com" required />
                        </div>

                        <div class="mb-3">
                            <label class="form-label">Password</label>
                            <input type="password" name="password" class="form-control" placeholder="password" required />
                        </div>

                        <div class="mb-0">
                            <a href="#" class="text-color text-end d-block">Forget Password?</a>
                        </div>
                    </div>

                    <div class="modal-footer border-0">
                        <button type="submit" class="btn btn-theme w-100">Login</button>
                    </div>

                    <div class="mb-3 text-center">
                        <h6>Don't have an account? <a href="#" class="text-color" onclick="toggleForm('register')">Register</a></h6>
                    </div>
                </form>

                <!-- Register Form -->
                <form id="registerForm" action="<?= URLROOT ?>/auth/register" method="POST" style="display: none;">
                    <div class="modal-body">

                        <div class="mb-3">
                            <label class="form-label">Name</label>
                            <input type="text" name="name" class="form-control" placeholder="Full name" required />
                        </div>

                        <div class="mb-3">
                            <label class="form-label">Email</label>
                            <input type="email" name="email" class="form-control" placeholder="name@email.com" required />
                        </div>

                        <div class="mb-3">
                            <label class="form-label">Password</label>
                            <input type="password" name="password" class="form-control" placeholder="password" required />
                        </div>

                        <div class="mb-3">
                            <label class="form-label">Confirm Password</label>
                            <input type="password" name="confirm_password" class="form-control" placeholder="confirm password" required />
                        </div>
                    </div>

                    <div class="modal-footer border-0">
                        <button type="submit" class="btn btn-theme w-100">Register</button>
                    </div>

                    <div class="mb-3 text-center">
                        <h6>Already have an account? <a href="#" class="text-color" onclick="toggleForm('login')">Login</a></h6>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

