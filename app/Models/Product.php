<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    public const TABLE = 'products';

    public const ID_COLUMN = 'id';
    public const NAME_COLUMN = 'name';
    public const DESCRIPTION_COLUMN = 'description';
    public const PRICE_COLUMN = 'price';
    public const IMAGE_COLUMN = 'image';
    public const CATEGORY_ID_COLUMN = 'category_id';

    protected $guarded = [];
    protected $table = self::TABLE;

    /** @var Category */
    private $category;

    public function getId(): int
    {
        return $this->getAttribute(self::ID_COLUMN);
    }

    public function getName(): string
    {
        return $this->getAttribute(self::NAME_COLUMN);
    }

    public function getDescription(): string
    {
        return $this->getAttribute(self::DESCRIPTION_COLUMN);
    }

    public function getPrice(): float
    {
        return $this->getAttribute(self::PRICE_COLUMN);
    }

    public function getImage(): string
    {
        return $this->getAttribute(self::IMAGE_COLUMN);
    }

    public function getCategoryId(): int
    {
        return $this->getAttribute(self::CATEGORY_ID_COLUMN);
    }

    public function getCategory(): Category
    {
        return $this->category;
    }

    public function setCategory(Category $category): self
    {
        $this->category = $category;

        return $this;
    }
}
