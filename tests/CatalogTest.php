<?php

namespace NestedCatalog;

use PHPUnit\Framework\TestCase;

class CatalogTest extends TestCase
{
    public function test1() {

        $catalog = new Catalog();
        $catalog->createCategory('test');
        $catalog->rebuild();
        $data = $catalog->getData();

        print_r($data);



    }

}
