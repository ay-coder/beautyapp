<?php namespace App\Models\Product\Traits\Relationship;

use App\Models\Ingredient\Ingredient;

trait Relationship
{
	public function ingredients()
	{
	    return $this->belongsToMany(Ingredient::class, 'product_ingredients_map_table');
	}
}