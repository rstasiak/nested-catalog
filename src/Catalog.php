<?php


namespace NestedCatalog;


class Catalog
{

    private array $categories = [];
    private int $index = 0;
    private array $parentIndex;

    public function __construct()
    {
        $this->categories['root'] = new Category('root');
    }


    public function createCategory(string $name, string $parentName = 'root')
    {
        $this->categories[$name] = new Category($name);
        $this->categories[$parentName]->add($name);
        $this->parentIndex[$name] = $parentName;
    }

    public function rebuild(string $parent = 'root') {

        $this->index++;
        $this->log('otwieram rebuild dla ' . $parent . ', lft = ' . $this->index);
        $this->categories[$parent]->updateLft($this->index);
        $this->log('update lft (bloop) ' . $this->index . ' dla ' . $parent);

        $names = $this->categories[$parent]->getChildren();
        $this->log('pobrałem ' . implode(', ', $names) . ' dla ' . $parent);

        foreach($names as $name)
        {
            $this->index++;
            $this->categories[$name]->updateLft($this->index);
            $this->log('update lft (loop) ' . $this->index . ' dla ' . $name);

            $children = $this->categories[$name]->getChildren();
            $this->log('pobrałem ' . implode(', ', $children) . ' dla ' . $name);

            foreach($children as $child)
            {
                $this->rebuild($child);
            }

            $this->index++;

            $this->categories[$name]->updateRgt($this->index);
            $this->log('update rgt (loop) ' . $this->index . ' dla ' . $name);


        }

        $this->index++;


        $this->categories[$parent]->updateRgt($this->index);
        $this->log('update rgt (aloop) ' . $this->index . ' dla ' . $parent);
        $this->log('wychodzę z rebuild dla ' . $parent);



    }

    public function removeCategory(string $name)
    {

        $parentName = $this->parentIndex[$name];

        $this->categories[$parentName]->remove($name);
        unset($this->categories[$name]);

    }

    public function moveCategory(string $name, string $newParent)
    {
        // usuń z obecnego parenta
        $parent = $this->parentIndex[$name];
        $this->categories[$parent]->remove($name);
        $this->categories[$newParent]->add($name);
    }

    public function getCategory(string $name)
    {
        return $this->categories[$name];
    }

    public function toJson() {

        return json_encode($this->parentIndex);

    }


    public function log(string $log) {

        echo $log . "\n";

    }

    public function debug()
    {
        print_r($this->categories);
    }
}