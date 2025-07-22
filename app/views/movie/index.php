<?php include('../app/views/partials/header.php'); ?>
<?php include('../app/views/partials/nav.php'); ?>

<?php include('../app/views/movie/watch.php'); ?>
<?php include('../app/views/partials/footer.php'); ?>
<?php include APPROOT . '/views/auth/login.php'; ?>


<?php if (!empty($data['open_modal'])): ?>
    <script>
        const loginModal = new bootstrap.Modal(document.getElementById('loginModal'));
        loginModal.show();
    </script>
<?php endif; ?>


