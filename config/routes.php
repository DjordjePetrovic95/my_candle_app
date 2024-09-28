<?php

declare(strict_types=1);

use App\Controllers\IndexController;
use App\Controllers\ProductController;

const ROUTE_INDEX = 'index';
const ROUTE_REGISTER = 'register';
const ROUTE_LOGIN = 'login';
const ROUTE_LOGOUT = 'logout';
const ROUTE_PRODUCT_LIST = 'product_list';
const ROUTE_PRODUCT_LOAD = 'product_load';
const ROUTE_PRODUCT_SHOW = 'product_show';
const ROUTE_PRODUCT_CREATE = 'product_create';
const ROUTE_PRODUCT_UPDATE = 'product_update';
const ROUTE_PRODUCT_DELETE = 'product_delete';

/**
 * @return array<string, array{url: string, controller: string, method: string}>
 */
function routes(): array
{
    return [
        ROUTE_INDEX => [
            'url' => '/',
            'controller' => IndexController::class,
            'method' => 'index',
        ],
        ROUTE_REGISTER => [
            'url' => '/register',
            'controller' => IndexController::class,
            'method' => 'register',
        ],
        ROUTE_LOGIN => [
            'url' => '/login',
            'controller' => IndexController::class,
            'method' => 'login',
        ],
        ROUTE_LOGOUT => [
            'url' => '/logout',
            'controller' => IndexController::class,
            'method' => 'logout',
        ],
        ROUTE_PRODUCT_LIST => [
            'url' => '/product/list',
            'controller' => ProductController::class,
            'method' => 'index',
        ],
        ROUTE_PRODUCT_LOAD => [
            'url' => '/product/load',
            'controller' => ProductController::class,
            'method' => 'load',
        ],
        ROUTE_PRODUCT_SHOW => [
            'url' => '/product/{id}/show',
            'controller' => ProductController::class,
            'method' => 'show',
        ],
        ROUTE_PRODUCT_CREATE => [
            'url' => '/product/create',
            'controller' => ProductController::class,
            'method' => 'create',
        ],
        ROUTE_PRODUCT_UPDATE => [
            'url' => '/product/{id}/update',
            'controller' => ProductController::class,
            'method' => 'update',
        ],
        ROUTE_PRODUCT_DELETE => [
            'url' => '/product/{id}/delete',
            'controller' => ProductController::class,
            'method' => 'delete',
        ],
    ];
}
