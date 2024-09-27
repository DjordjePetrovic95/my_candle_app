<?php

namespace App\Models;

class Product extends AbstractModel
{
    public string $name;

    public ?string $description = null;

    public string $image;
}