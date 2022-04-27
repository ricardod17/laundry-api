<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCategoryTransaction extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('category_transaction', function (Blueprint $table) {
            $table->bigInteger('category_id')->unsigned();
            $table->foreign('category_id')
                ->references('id')
                ->on('category')->onDelete('cascade');
            $table->bigInteger('transaction_id')->unsigned();
            $table->foreign('transaction_id')
                ->references('id')
                ->on('transaction')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('category_transaction');
    }
}
