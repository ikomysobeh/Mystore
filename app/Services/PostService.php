<?php
namespace App\Services;
use App\Models\Post;
class PostService extends ServiceHelper{

    public function __construct(){
        $this->model=new Post();
        $this->attributes=$this->model->getFillable();
    }
}
?>
