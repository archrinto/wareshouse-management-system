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
        Schema::create('wms_goods_transaction', function (Blueprint $table) {
            $table->uuid('id')->primary();
            $table->integer('transaction_at')->nullable();
            $table->foreignUuid('category_id')->nullable();
            $table->foreignUuid('supplier_id')->nullable();
            $table->foreignUuid('shipper_id')->nullable();
            $table->string('description')->nullable();
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
        Schema::dropIfExists('wms_goods_transaction');
    }
};
