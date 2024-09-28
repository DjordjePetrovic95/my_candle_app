<?php $Title = 'Home' ?>
<?php require_once __DIR__ . '/../layouts/header.php'; ?>


<table class="table">
    <thead>
        <tr>
            <th class="text-center" scope="col">#</th>
            <th class="text-center" scope="col">Name</th>
            <th class="text-center" scope="col">Description</th>
            <th class="text-center" scope="col">Image</th>
            <th class="text-center" scope="col">Actions</th>
        </tr>
    </thead>
    <tbody>
    <?php
    /**
     * @var \App\Models\Product[] $products
     */
    foreach ($products as $product) {

        ?>
        <tr>
            <th class="text-center align-middle" scope="row"><?= $product->id ?></th>
            <td class="text-center align-middle"><?= $product->name ?></td>
            <td class="text-center align-middle text-wrap"><?= $product->description ?></td>
            <td class="text-center align-middle">
                <img class="rounded" src="<?= $product->getImage() ?>" alt="<?= $product->name ?>" height="100">
            </td>
            <td class="text-center align-middle text-nowrap">
                <a class="btn btn-light" href="<?= route(ROUTE_PRODUCT_SHOW, [
                    'id' => $product->id,
                ]) ?>">View</a>
                <?php
                if (currentUser()?->admin) {
                ?>
                    <a class="btn btn-danger" href="<?= route(ROUTE_PRODUCT_DELETE, [
                        'id' => $product->id,
                    ]) ?>" onclick="return confirm('Are you sure?')">Delete</a>
                <?php
                }
                ?>
            </td>
        </tr>
        <?php
    }
    ?>

    <?php require_once __DIR__ . '/../layouts/footer.php'; ?>
    </tbody>
</table>