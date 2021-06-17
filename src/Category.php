<?php


namespace NestedCatalog;


class Category
{

    private array $categories = [];

    private int $lft = 0;

    private int $rgt = 0;

    private string $name;


    public function __construct(string $name)
    {
        $this->name = $name;
    }

    public function add(string $child)
    {
        $this->categories[] = $child;
    }

    public function getChildren(): array
    {
        return $this->categories;
    }


    public function hasChildren()
    {

        return ! empty($this->categories);
    }

    public function updateLft(int $lft)
    {
        $this->lft = $lft;
    }

    public function updateRgt(int $rgt)
    {
        $this->rgt = $rgt;
    }

    /**
     * @return string
     */
    public function getName(): string
    {
        return $this->name;
    }

    /**
     * @return int
     */
    public function getLft(): int
    {
        return $this->lft;
    }

    /**
     * @return int
     */
    public function getRgt(): int
    {
        return $this->rgt;
    }






}