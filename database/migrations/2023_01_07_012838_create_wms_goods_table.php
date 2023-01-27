<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('wms_goods', function (Blueprint $table) {
            $table->uuid('id')->primary();
            $table->string('name', 80)->nullable();
            $table->string('code', 25)->nullable()->comment('or sku');
            $table->string('description', 200)->nullable();
            $table->integer('minimum_stock')->default(0);
            $table->integer('price')->default(0);
            $table->integer('stock')->default(0);
            $table->foreignUuid('unit_id')->nullable();
            $table->foreignUuid('created_by')->nullable();
            $table->foreignUuid('updated_by')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('wms_goods');
    }
};
