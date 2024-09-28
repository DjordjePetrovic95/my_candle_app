<?php $Title = 'Home'; ?>
<?php require_once __DIR__ . '/../layouts/header.php'; ?>

<div class="card">
    <div class="card-body">
        <div class="card-title"><h2><strong>View Products</strong></h2></div>
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
            <tbody id="table-container">
            </tbody>
        </table>
    </div>
</div>

<template id="table-template">
    <tr class="product-row">
        <th class="text-center align-middle product-id" scope="row"></th>
        <td class="text-center align-middle product-name"></td>
        <td class="text-center align-middle text-wrap product-description"></td>
        <td class="text-center align-middle product-image">
            <img class="rounded" src="" alt="" height="100">
        </td>
        <td class="text-center align-middle text-nowrap">
            <a class="btn btn-light btn-sm product-action-view" href="">View</a>

            <?php
            if (currentUser()?->admin) {
                ?>
            <a class="btn btn-danger btn-sm product-action-delete" href="" onclick="return confirm('Are you sure?')">Delete</a>
            <?php
            }
?>
        </td>
    </tr>
</template>

<script>
    window.loadProductUrl = '<?= route(ROUTE_PRODUCT_LOAD) ?>';
</script>
<script src="<?= public_dir('product-list.js') ?>"></script>
<?php require_once __DIR__ . '/../layouts/footer.php'; ?>