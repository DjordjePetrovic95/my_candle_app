<?php $Title = 'Login'; ?>
<?php require_once __DIR__ . '/../layouts/header.php'; ?>

<div class="card mx-auto" style="max-width: 600px">
    <div class="card-body">
        <div class="card-title">Login</div>
        <form method="POST">
            <div class="mb-3">
                <label for="username" class="form-label">Username</label>
                <input type="text" class="form-control" id="username" name="username" value="<?= $_POST['username'] ?? '' ?>">
            </div>
            <div class="mb-3">
                <label for="password" class="form-label">Password</label>
                <input type="password" class="form-control" id="password" name="password">
            </div>
            <button type="submit" class="btn btn-primary btn-sm">Login</button>
        </form>
    </div>
</div>

<?php require_once __DIR__ . '/../layouts/footer.php'; ?>
