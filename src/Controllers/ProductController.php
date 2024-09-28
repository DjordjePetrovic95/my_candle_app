<?php

declare(strict_types=1);

namespace App\Controllers;

use App\Models\Product;
use App\Repository\ProductRepository;

class ProductController
{
    private readonly ProductRepository $productRepository;

    public function __construct()
    {
        $this->productRepository = new ProductRepository();
    }

    public function index(): void
    {
        view('products/index');
    }

    public function load(): void
    {
        $products = $this->productRepository->findBy();

        $return = [
            'data' => array_map(fn (Product $product): array => [
                'id' => $product->id,
                'name' => $product->name,
                'description' => $product->description,
                'image' => $product->getImage(),
                'viewUrl' => route(ROUTE_PRODUCT_SHOW, [
                    'id' => $product->id,
                ]),
                'deleteUrl' => route(ROUTE_PRODUCT_DELETE, [
                    'id' => $product->id,
                ]),
            ], $products),
        ];

        json($return);
    }

    public function create(): void
    {
        if (! currentUser()?->admin) {
            abort(403);
        }

        if (getRequestMethod() !== 'POST') {
            view('products/create');

            return;
        }

        $name = $_POST['name'];
        $description = $_POST['description'];
        $image = $_FILES['image'];

        $product = new Product();
        $product->name = $name;
        $product->description = $description;
        $product->setImage($image['tmp_name']);

        $this->productRepository->create($product);

        redirect(ROUTE_PRODUCT_LIST);
    }

    public function update(int $id): void
    {
        if (! currentUser()?->admin) {
            abort(403);
        }

        $product = $this->productRepository->get($id);

        if (empty($product)) {
            abort(404);

            return;
        }

        if (getRequestMethod() !== 'POST') {
            view('products/update', compact('product'));

            return;
        }

        $name = $_POST['name'];
        $description = $_POST['description'];
        $image = $_FILES['image'];

        $product->name = $name;
        $product->description = $description;

        if (! empty($image) && $image['error'] === 0) {
            $product->setImage($image['tmp_name']);
        }

        $this->productRepository->update($product);

        redirect(ROUTE_PRODUCT_UPDATE, [
            'id' => $id,
        ]);
    }

    public function delete(int $id): void
    {
        if (! currentUser()?->admin) {
            abort(403);
        }

        $this->productRepository->delete($id);

        redirect('product_list');
    }

    public function show(int $id): void
    {
        $product = $this->productRepository->get($id);

        view('products/show', compact('product'));
    }
}
