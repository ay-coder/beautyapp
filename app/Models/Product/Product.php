<?php namespace App\Models\Product;

/**
 * Class Product
 *
 * @author Anuj Jaha 
 */

use App\Models\BaseModel;
use App\Models\Product\Traits\Attribute\Attribute;
use App\Models\Product\Traits\Relationship\Relationship;

class Product extends BaseModel
{
    use Attribute, Relationship;

    /**
     * Database Table
     *
     */
    protected $table = "data_products";

    /**
     * Fillable Database Fields
     *
     */
    protected $fillable = [
        'title',
        'description',
        'product_code',
        'price',
        'qty',
        'image',
        'image1',
        'image2',
        'image3',
        'company_name',
        'product_type',
        'product_sub_type',
        'barcode',
        'manufacturer_sku',
        'retailer_sku'
    ];

    /**
     * Guarded ID Column
     *
     */
    protected $guarded = ["id"];
}