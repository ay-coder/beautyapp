<?php namespace App\Models\Ingredient\Traits\Relationship;

use App\Models\Product\Product;


trait Relationship
{
	public function products()
	{
	    return $this->belongsToMany(Product::class, 'product_ingredients_map_table');
	}
}