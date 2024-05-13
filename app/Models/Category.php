<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    use HasFactory;

    protected $guarded = [];

    public function getChild(){
        return $this->hasMany(Category::class, 'parent_id', 'id');
    }

    public function getParent(){
        return $this->hasOne(Category::class, 'id', 'parent_id');
    }
    
}
