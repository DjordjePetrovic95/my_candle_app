<?php $Title = 'Create Product' ?>
<?php require_once __DIR__ . '/../layouts/header.php'; ?>

<form action="" method="POST" enctype="multipart/form-data">
    <div class="mb-3">
        <label for="name" class="form-label">Name</label>
        <input class="form-control" type="text" name="name" id="name">
    </div>
    <div class="mb-3">
        <label for="description" class="form-label">Description</label>
        <textarea class="form-control" name="description" id="description" cols="30" rows="10"></textarea>
    </div>
    <div class="mb-3">
        <label for="image" class="form-label">Image</label>
        <input class="form-control" type="file" name="image" id="image" accept="image/png,image/jpeg">
    </div>
    <div class="mb-3">
        <button type="submit">Save</button>
    </div>

</form>

<?php require_once __DIR__ . '/../layouts/footer.php'; ?>