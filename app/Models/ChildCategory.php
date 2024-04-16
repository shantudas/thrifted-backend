<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ChildCategory extends Model
{
    use HasFactory;

    public function parentCategory()
    {
        return $this->belongsTo(ParentCategory::class);
    }

    public function category()
    {
        return $this->hasOne(Category::class);
    }
}
