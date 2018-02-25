<?php namespace App\Models\Ingredient;

/**
 * Class Ingredient
 *
 * @author Anuj Jaha 
 */

use App\Models\BaseModel;
use App\Models\Ingredient\Traits\Attribute\Attribute;
use App\Models\Ingredient\Traits\Relationship\Relationship;

class Ingredient extends BaseModel
{
    use Attribute, Relationship;

    /**
     * Database Table
     *
     */
    protected $table = "product_ingredients";

    /**
     * Fillable Database Fields
     *
     */
    protected $fillable = [
        'title',
        'status'
    ];

    /**
     * Guarded ID Column
     *
     */
    protected $guarded = ["id"];
}