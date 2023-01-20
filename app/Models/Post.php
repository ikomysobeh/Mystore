<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Post extends Model
{
    use HasFactory;
    protected $fillable = [
        'uniqueId',
        'userId',
        'categoryId',
        'description',
        'title',
        'price',
    ];
    public function getUserAttribute(){
        return $this->hasOne(user::class,'uniqueId','userId')->firstOrFail();
    }
    public function getCategoriesAttribute(){
        return $this->hasMany(Category::class,'uniqueId','categoryId')->get();
    }
    public function getFilesAttribute(){
        return $this->hasMany(File::class,'postId','uniqueId')->get();
    }

}
