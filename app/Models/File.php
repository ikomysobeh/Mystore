<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class File extends Model
{
    use HasFactory;
    protected $fillable = [
        'uniqueId',
        'path',
        'description',
        'extension',
        'postId',

    ];
    public function getPostAttribute(){
        return $this->hasOne(Post::class,'uniqueId','postId')->firstOrFail();
    }
}
