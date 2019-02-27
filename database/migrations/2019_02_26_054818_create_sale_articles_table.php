<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateSaleArticlesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('sale_articles', function (Blueprint $table) {
            $table->increments('id');
            $table->unsignedInteger('sale_id');
            $table->unsignedInteger('product_id')->nullable();
            $table->string('description')->nullable();
            $table->decimal('quantity',10,2);
            $table->decimal('price',10,2);
            $table->decimal('total',10,2);
            $table->decimal('revenue',10,2);
            $table->decimal('commission',10,2);
            $table->unsignedInteger('cancelled_by')->nullable();
            $table->timestamps();
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('sale_articles');
    }
}
