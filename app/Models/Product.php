<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

use ElasticScoutDriverPlus\Searchable;

class Product extends Model
{
    use Searchable, HasFactory;

    protected $fillable = [
        'slug',
        'title',
        'description',
        'price',
        'category_id'
    ];

    public function category()
    {
        return $this->belongsTo(\App\Models\Category::class);
    }

    public function searchableAs(): string
    {
        return 'products_index';
    }
    
    public function toSearchableArray(): array
    {
        return [
            'id' => $this->id,
            'category' => $this->category->title,
            'slug' => $this->slug,
            'description' => $this->description,
            'price' => $this->price
        ];
    }
}
