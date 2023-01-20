<?php
namespace App\Services;

use App\Models\File;


class FileService extends ServiceHelper{
    public function __construct()
    {
        $this->model=new File();
        $this->attributes=$this->model->getFillable();
    }


}



?>
