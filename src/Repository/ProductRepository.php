<?php

declare(strict_types=1);

namespace App\Repository;

use App\Models\Product;

/**
 * @extends AbstractRepository<Product>
 */
class ProductRepository extends AbstractRepository
{
    public function __construct()
    {
        parent::__construct(Product::class, 'products');
    }
}
