<?php

namespace Controller;

class Catalog
{
    public function show($id = null)
    {
        if ($id !== null) {
            echo 'Catalog controller ID ' . $id;
        }
    }
    public function all($id)
    {
        for($i = 0; $i < 10; $i++){
            echo '<a href="http://127.0.0.1:8000/oop/index.php/catalog/all/'.$i.'">Read more</a>';
            echo '<br>';
        }
    }
    public function create($data)
    {
    }
    public function update($data)
    {
    }
}