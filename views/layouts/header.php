<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link href="<?= public_dir('bootstrap.css') ?>" rel="stylesheet">
    <title><?= $Title ?? 'App' ?></title>
</head>
<body>

<nav class="navbar navbar-expand-lg bg-body-tertiary">
    <div class="container-fluid">
        <a class="navbar-brand" href="<?= route('index') ?>"><?= config('app.app_name') ?></a>
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarSupportedContent">
            <ul class="navbar-nav me-auto mb-2 mb-lg-0">
                <li class="nav-item">
                    <a class="nav-link active" aria-current="page" href="<?= route(ROUTE_PRODUCT_LIST) ?>">View Products</a>
                </li>

                <?php
                if (currentUser()?->admin) {
                    ?>
                    <li class="nav-item">
                        <a class="nav-link" aria-current="page" href="<?= route(ROUTE_PRODUCT_CREATE) ?>">Create Product</a>
                    </li>
                    <?php
                }
                ?>
            </ul>
            <div>
                <?php if (currentUser()) { ?>
                    <a class="btn btn-danger" href="<?= route(ROUTE_LOGOUT) ?>">Logout</a>
                <?php } else { ?>
                    <a class="btn btn-primary" href="<?= route(ROUTE_LOGIN) ?>">Login</a>
                    <a class="btn btn-warning" href="<?= route(ROUTE_REGISTER) ?>">Register</a>
                <?php } ?>
            </div>
        </div>
    </div>
</nav>

<?php

if (! empty($messages = getFlashMessages())) {
    foreach ($messages as $message) {
        ?>
<div class="mx-auto d-flex justify-content-between alert alert-<?= $message['type'] ?>" role="alert">
    <span><?= $message['message'] ?></span><button type="button" class=" btn btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
</div>

<?php
    }
    clearFlashMessages();
}
?>

<div class="container-fluid">
