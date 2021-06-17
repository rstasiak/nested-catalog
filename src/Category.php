<?php


namespace NestedCatalog;


class Category
{

    private array $categories = [];

    private int $lft;

    private int $rgt;

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


}