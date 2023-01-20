<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Purchase extends Model
{
    use HasFactory;
    protected $fillable = [
        'uniqueId',
        'userId',
        'postId',

    ];
    public function getUserAttribute(){
        return $this->hasMany(user::class,'uniqueId','userId')->get();
    }
    public function getPostAttribute(){
        return $this->hasMany(post::class,'uniqueId','postId')->get();
    }
}

