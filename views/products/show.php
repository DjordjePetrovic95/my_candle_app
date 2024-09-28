<?php
$Title = 'Product'
/** @var \App\Models\Product $product */
?>
<?php require_once __DIR__ . '/../layouts/header.php'; ?>

<div class="card mx-auto" style="max-width: 50rem">
    <div class="card-body">
        <div class="card-title d-flex justify-content-between">
            <div><h3><strong><?= $product->name ?></strong></h3></div>
            <?php
            if (currentUser()?->admin) {
            ?>
            <div>
                <a class="btn btn-warning" href="<?= route(ROUTE_PRODUCT_UPDATE, [
                    'id' => $product->id,
                ]) ?>">Edit</a>
                <a class="btn btn-danger" href="<?= route(ROUTE_PRODUCT_DELETE, [
                    'id' => $product->id,
                ]) ?>" onclick="return confirm('Are you sure?')">Delete</a>
            </div>
            <?php
            }
            ?>
        </div>
        <div class="d-grid gap-4">
            <div class="row">
                <div class="col"><strong>ID</strong></div>
                <div class="col"><?= $product->id ?></div>
            </div>
            <div class="row">
                <div class="col"><strong>Name</strong></div>
                <div class="col"><?= $product->name ?></div>
            </div>
            <div class="row">
                <div class="col"><strong>Description</strong></div>
                <div class="col"><?= $product->description ?></div>
            </div>
            <div class="row">
                <div class="col"><strong>Image</strong></div>
                <div class="col">
                    <img class="img-fluid rounded" src="<?= $product->getImage() ?>" alt="<?= $product->name ?>">
                </div>
            </div>
        </div>
    </div>
</div>

<?php require_once __DIR__ . '/../layouts/footer.php'; ?>