<?php

namespace App\Models;

use App\Traits\StringManipulations;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Laravel\Scout\Searchable;

class Category extends Model
{
    use HasFactory;
    use Searchable;
    use StringManipulations;

    protected $fillable = [
        'title'
    ];
    protected $primaryKey = "title";
    public $incrementing = false;
    protected $with = [
        'products',
    ];

    public function children()
    {
        return $this->hasMany(Category::class, 'parent_title');
    }

    public function products()
    {
        return $this->hasMany(Product::class);
    }

    public function isParent()
    {
        return $this->children->count() > 0;
    }

    public function slugData()
    {
        return [
            'title' => $this->title,
        ];
    }
}
