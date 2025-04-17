<div class="container mt-5">
    <div class="row justify-content-center">
        <div class="col-md-4">

            <?php if (!empty($error)): ?>
                <div class="alert alert-danger"><?= $error ?></div>
            <?php endif; ?>

            <?php if (!empty($success)): ?>
                <div class="alert alert-success"><?= $success ?></div>
            <?php endif; ?>

            <div class="card shadow rounded-4">
                <div class="card-body">
                    <h4 class="text-center mb-4">Login Admin</h4>
                    <form method="POST" action="<?= base_url('admin/login') ?>">
                        <div class="mb-3">
                            <label for="username">Username</label>
                            <input type="text" name="username" class="form-control" id="username" required>
                        </div>
                        <div class="mb-4">
                            <label for="password">Password</label>
                            <input type="password" name="password" class="form-control" id="password" required>
                        </div>
                        <button type="submit" class="btn btn-primary w-100">Login</button>
                    </form>
                </div>
            </div>

            <p class="text-center mt-3 text-muted">&copy; <?= date('Y') ?> Admin Panel</p>
        </div>
    </div>
</div>
