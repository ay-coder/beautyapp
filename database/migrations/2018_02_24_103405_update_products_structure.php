<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class UpdateProductsStructure extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('data_products', function (Blueprint $table) 
        {
            // Drop Category Id
            $table->dropColumn('category_id');

            $table->string('company_name')->nullable()->after('title');
            $table->string('product_type')->nullable()->after('company_name');
            $table->string('product_sub_type')->nullable()->after('product_type');
            $table->string('barcode')->nullable()->after('product_sub_type');
            $table->string('manufacturer_sku')->nullable()->after('barcode');
            $table->string('retailer_sku')->nullable()->after('manufacturer_sku');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        //
    }
}
