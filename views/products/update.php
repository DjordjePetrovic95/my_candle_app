<?php
$title = 'Update Product'
/** @var \App\Models\Product $product */
?>
<?php require_once __DIR__ . '/../layouts/header.php'; ?>

<div class="card mx-auto" style="max-width: 600px">
    <div class="card-body">
        <div class="card-title">Update Product</div>

        <form action="" method="POST" enctype="multipart/form-data">
            <div class="mb-3">
                <label for="name" class="form-label">Name</label>
                <input class="form-control" type="text" name="name" id="name" value="<?= $product->name ?>">
            </div>
            <div class="mb-3">
                <label for="description" class="form-label">Description</label>
                <textarea class="form-control" name="description" id="description" cols="30" rows="10"><?= $product->description ?></textarea>
            </div>
            <div class="mb-3">
                <label for="image" class="form-label">Image</label>
                <input class="form-control" type="file" name="image" id="image" accept="image/png,image/jpeg">
                <div class="text-center">
                    <img class="mt-2" height="200" src="<?= $product->getImage() ?>" alt="<?= $product->name ?>">
                </div>
            </div>
            <div class="mb-3">
                <button class="btn btn-primary btn-sm" type="submit">Update</button>
            </div>
        </form>
    </div>
</div>

<?php require_once __DIR__ . '/../layouts/footer.php'; ?>