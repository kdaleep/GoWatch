<div class="col-md-9 p-4">
    <div class="card shadow-sm">
        <div class="card-body">
            <h5 class="card-title d-flex justify-content-end">
                <form class="d-flex me-2" role="search" action="<?= URLROOT ?>/admin/searchUser" method="GET">
                    <input class="form-control me-2" name="query" type="search" placeholder="Search" aria-label="Search" />
                    <button class="btn btn-outline-success" type="submit"><i class="fa-solid fa-search"></i></button>
                </form>
                <button class="btn btn-success" type="button" data-bs-toggle="modal" data-bs-target="#addUserModal">Add User</button>
            </h5>
            <div class="table-responsive">
                <table class="table table-striped table-bordered-0">
                    <thead class="table-light">
                        <tr>
                            <th>#</th>
                            <th>Name</th>
                            <th>Email</th>
                            <th>Is Admin</th>
                            <th>Created At</th>
                            <th>Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php $index = 1; ?>
                        <?php foreach ($data['users'] as $user): ?>
                            <tr>
                                <td><?= $index++ ?></td>
                                <td><?= htmlspecialchars($user['name']) ?></td>
                                <td><?= htmlspecialchars($user['email']) ?></td>
                                <td><?= $user['is_admin'] ? 'Yes' : 'No' ?></td>
                                <td><?= $user['created_at'] ?></td>
                                <td class="d-flex justify-content-center">
                                    <button class="btn btn-sm btn-warning" data-bs-toggle="modal" data-bs-target="#editUserModal"
                                        data-id="<?= $user['id'] ?>"
                                        data-name="<?= htmlspecialchars($user['name']) ?>"
                                        data-email="<?= htmlspecialchars($user['email']) ?>"
                                        data-is_admin="<?= $user['is_admin'] ?>">
                                        <i class="fa-solid fa-edit"></i>
                                    </button>
                                    <a href="/GoWatch/public/admin/deleteUser?id=<?= $user['id'] ?>" class="btn btn-sm btn-danger ms-2">
                                        <i class="fa-solid fa-remove"></i>
                                    </a>
                                </td>
                            </tr>
                        <?php endforeach; ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>

<!-- Add User Modal -->
<div class="modal fade" id="addUserModal" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <form action="<?= URLROOT ?>/admin/addUser" method="POST">
                <div class="modal-header">
                    <h5 class="modal-title">Add User</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                </div>

                <div class="modal-body">
                    <div class="mb-3">
                        <label for="name">Name</label>
                        <input type="text" class="form-control" name="name" required>
                    </div>
                    <div class="mb-3">
                        <label for="email">Email</label>
                        <input type="email" class="form-control" name="email" required>
                    </div>
                    <div class="mb-3">
                        <label for="password">Password</label>
                        <input type="password" class="form-control" name="password" required>
                    </div>
                    <div class="form-check mb-3">
                        <input type="checkbox" class="form-check-input" name="is_admin" value="1">
                        <label class="form-check-label">Is Admin</label>
                    </div>
                </div>

                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
                    <button type="submit" class="btn btn-primary">Add User</button>
                </div>
            </form>
        </div>
    </div>
</div>

<!-- Edit User Modal -->
<div class="modal fade" id="editUserModal" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <form action="<?= URLROOT ?>/admin/updateUser" method="POST">
                <input type="hidden" name="id" id="edit_user_id">
                <div class="modal-header">
                    <h5 class="modal-title">Edit User</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                </div>

                <div class="modal-body">
                    <div class="mb-3">
                        <label for="edit_user_name">Name</label>
                        <input type="text" class="form-control" name="name" id="edit_user_name" required>
                    </div>
                    <div class="mb-3">
                        <label for="edit_user_email">Email</label>
                        <input type="email" class="form-control" name="email" id="edit_user_email" required>
                    </div>
                    <div class="form-check mb-3">
                        <input type="checkbox" class="form-check-input" id="edit_user_is_admin" name="is_admin" value="1">
                        <label class="form-check-label" for="edit_user_is_admin">Is Admin</label>
                    </div>
                </div>

                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
                    <button type="submit" class="btn btn-primary">Update User</button>
                </div>
            </form>
        </div>
    </div>
</div>

<script>
    document.addEventListener('DOMContentLoaded', function () {
        const editUserModal = document.getElementById('editUserModal');
        editUserModal.addEventListener('show.bs.modal', function (event) {
            const button = event.relatedTarget;

            document.getElementById('edit_user_id').value = button.getAttribute('data-id');
            document.getElementById('edit_user_name').value = button.getAttribute('data-name');
            document.getElementById('edit_user_email').value = button.getAttribute('data-email');
            document.getElementById('edit_user_is_admin').checked = button.getAttribute('data-is_admin') === "1";
        });
    });
</script>
