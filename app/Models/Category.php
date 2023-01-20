<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    use HasFactory;
    protected $fillable = [
        'description',
        'cover',
        'name',

    ];
    public function getPostsAttribute(){
        return $this->hasMany(Post::class,'categoryId','uniqueId')->get();
    }

}
