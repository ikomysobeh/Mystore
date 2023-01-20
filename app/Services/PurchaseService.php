<?php
namespace App\Services;
use App\Models\Purchase;
class PurchaseService extends ServiceHelper{

    public function __construct(){

        $this->model=new Purchase();
        $this->attributes=$this->model->getFillable();
    }
}
?>
