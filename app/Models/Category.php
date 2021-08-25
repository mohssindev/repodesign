<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    public const TABLE = 'categories';
    public const ID_COLUMN = 'id';
    public const NAME_COLUMN = 'name';
    public const PARENT_ID_COLUMN = 'parent_id';

    protected $table = self::TABLE;
    protected $guarded = [];

    /** @var Category */
    private $parentCategory;

    public function getId(): int
    {
        return $this->getAttribute(self::ID_COLUMN);
    }

    public function getName(): string
    {
        return $this->getAttribute(self::NAME_COLUMN);
    }

    public function getParentId(): ?int
    {
        return $this->getAttribute(self::PARENT_ID_COLUMN);
    }

    public function getParentCategory(): ?Category
    {
        return $this->parentCategory;
    }

    public function setParentCategory(Category $parentCategory): self
    {
        $this->parentCategory = $parentCategory;

        return $this;
    }
}
