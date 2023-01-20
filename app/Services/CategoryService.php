<?php
namespace App\Services;

use App\Models\Category;

class CategoryService extends ServiceHelper{
    public function __construct()
    {
        $this->model=new Category();
        $this->attributes=$this->model->getFillable();
    }

}



?>
