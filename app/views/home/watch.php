<div class="col-md-9 p-4">
            <div class="card shadow-sm">
                <div class="card-header bg-primary text-white">
                    Welcome, <?= htmlspecialchars(strtoupper($_SESSION['user_name'])) ?>
                </div>
                <div class="card-body">
                    <h5 class="card-title">Dashboard Overview</h5>
                    <p class="card-text">Use the left panel to manage Anime, Users, or logout.</p>

                    <!-- Quick Stats -->
                    <div class="row mt-4">
                        <div class="col-md-4">
                            <div class="card text-white bg-success mb-3">
                                <div class="card-body">
                                    <h5 class="card-title">Total Anime</h5>
                                    <p class="card-text fs-4">52</p>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="card text-white bg-warning mb-3">
                                <div class="card-body">
                                    <h5 class="card-title">Total Users</h5>
                                    <p class="card-text fs-4">123</p>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="card text-white bg-info mb-3">
                                <div class="card-body">
                                    <h5 class="card-title">Active Sessions</h5>
                                    <p class="card-text fs-4">5</p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>