<?php

declare(strict_types=1);

namespace App\Models;

class Product extends AbstractModel
{
    public string $name;

    public ?string $description = null;

    private string $image;

    public function getImage(): string
    {
        if (empty($this->image)) {
            return '';
        }

        $mime = getimagesizefromstring($this->image)['mime'] ?? null;

        if (empty($mime)) {
            return '';
        }

        return 'data:' . $mime . ';base64,' . base64_encode($this->image);
    }

    public function setImage(string $image): void
    {
        $image = file_get_contents($image);

        if (empty($image)) {
            throw new \Exception('Invalid image');
        }

        $this->image = $image;
    }
}
