<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateOrdersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('orders', function (Blueprint $table) {
            $table->id();
            $table->bigInteger('user_id')->unsigned()->index()->nullable();
            $table->string('firstname')->index();
            $table->string('lastname')->index();
            $table->text('address');
            $table->string('phone')->index();
            $table->string('email')->index();
            $table->decimal('subtotal',12,2)->index();
            $table->decimal('delivery',12,2)->index();
            $table->decimal('discount',12,2)->index();
            $table->decimal('total',12,2)->index();
            $table->timestamps();
            $table->foreign('user_id')->references('id')->on('users');
        });

    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('orders');
    }
}
