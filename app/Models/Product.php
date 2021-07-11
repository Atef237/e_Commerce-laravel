<?php

namespace App\Models;

use Astrotomic\Translatable\Translatable;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Product extends Model
{
    use Translatable,
        SoftDeletes;

    protected $with = ['translations'];

    protected $fillable =[
        'brand_id',
        'slug',
        'sku',
        'price',
        'special_price',
        'special_price_type',
        'special_price_start',
        'special_price_end',
        'selling_price',
        'manage_stock',
        'qty',
        'in_stock',
        'is_active'
    ];

    protected $casts = [  //Returns data in boolean format
        'manage_stock' => 'boolean',
        'in_stock' => 'boolean',
        'is_active' => 'boolean',
    ];

    protected $dates = [       // Returns data in date format
        'special_price_start',
        'special_price_end',
        'start_date',
        'end_date',
        'deleted_at',
    ];

    protected $translatedAttributes = ['name', 'description', 'short_description']; // field name in translation table

    public function brand()   //relationship oneToMany with brand table
    {
        return $this->belongsTo(Brand::class)->withDefault();
    }

    public function categories()  //relationship manyToMany with Category table
    {
        return $this->belongsToMany(Category::class, 'product_categories');
    }

    public function tags()   //relationship manyToMany with Tag table
    {
        return $this->belongsToMany(Tag::class, 'product_tags');
    }
}