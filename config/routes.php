<?php

use App\Controllers\IndexController;
use App\Controllers\ProductController;

/**
 * @return array<string, array{url: string, name: string, controller: string, method: string}>
 */
function routes(): array
{
    return [
        'index' => [
            'url' => '/',
            'name' => 'index',
            'controller' => IndexController::class,
            'method' => 'index',
        ],
        'register' => [
            'url' => '/register',
            'name' => 'register',
            'controller' => IndexController::class,
            'method' => 'register',
        ],
        'login' => [
            'url' => '/login',
            'name' => 'login',
            'controller' => IndexController::class,
            'method' => 'login',
        ],
        'logout' => [
            'url' => '/logout',
            'name' => 'logout',
            'controller' => IndexController::class,
            'method' => 'logout',
        ],
        'product_list' => [
            'url' => '/product/list',
            'name' => 'product_list',
            'controller' => ProductController::class,
            'method' => 'index',
        ],
        'product_show' => [
            'url' => '/product/{id}/show',
            'name' => 'product_show',
            'controller' => ProductController::class,
            'method' => 'show',
        ],
        'product_create' => [
            'url' => '/product/{id}/create',
            'name' => 'product_create',
            'controller' => ProductController::class,
            'method' => 'create',
        ],
        'product_update' => [
            'url' => '/product/{id}/update',
            'name' => 'product_update',
            'controller' => ProductController::class,
            'method' => 'update',
        ],
        'product_delete' => [
            'url' => '/product/{id}/delete',
            'name' => 'product_delete',
            'controller' => ProductController::class,
            'method' => 'delete',
        ],
    ];
}
