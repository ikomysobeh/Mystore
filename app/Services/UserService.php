<?php
namespace App\Services;
use App\Models\User;
class UserService extends ServiceHelper{

    public function __construct(){

        $this->model=new User();
        $this->attributes=$this->model->getFillable();
        $this->searchBy=[
            'name',
        ];
    }
}
?>
