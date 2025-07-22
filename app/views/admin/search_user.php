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
                    <th>Name</th>
                    <th>Email</th>
                    <th>Is Admin</th>
                    <th>Created At</th>
                </tr>
            </thead>
            <tbody>
                <?php if (count($data['users']) === 0): ?>
                    <tr>
                        <td colspan="5" class="text-center text-secondary">No users found.</td>
                    </tr>
                <?php else: ?>
                    <?php foreach ($data['users'] as $index => $user): ?>
                        <tr>
                            <td><?= $index + 1 ?></td>
                            <td><?= htmlspecialchars($user['name']) ?></td>
                            <td><?= htmlspecialchars($user['email']) ?></td>
                            <td><?= $user['is_admin'] ? 'Yes' : 'No' ?></td>
                            <td><?= htmlspecialchars($user['created_at']) ?></td>
                        </tr>
                    <?php endforeach; ?>
                <?php endif; ?>
            </tbody>
        </table>
    </div>
</div>

<?php include('../app/views/partials/footer.php'); ?>
<?php include('../app/views/auth/login.php'); ?>