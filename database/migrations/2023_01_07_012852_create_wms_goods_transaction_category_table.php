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
        Schema::create('wms_goods_transaction_category', function (Blueprint $table) {
            $table->uuid('id')->primary();
            $table->string('name', 40);
            $table->string('operation', 20)->nullable()->comment('substraction or addition');
            $table->string('description', 150)->nullable();
            $table->boolean('is_receiving')->default(false);
            $table->boolean('is_dispatching')->default(false);
            $table->boolean('is_locked')->default(false);
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
        Schema::dropIfExists('wms_goods_transaction_category');
    }
};
