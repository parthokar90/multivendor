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
            $table->unsignedBigInteger('vendor_id');
            $table->unsignedBigInteger('user_id');
            $table->unsignedBigInteger('coupon_id');
            $table->unsignedBigInteger('charge_id');
            $table->text('ship_address');
            $table->text('ship_location');
            $table->unsignedBigInteger('ship_country');
            $table->string('ship_city');
            $table->unsignedBigInteger('ship_district');
            $table->unsignedBigInteger('ship_zipcode');
            $table->unsignedBigInteger('status_id');
            $table->date('order_date');
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
        Schema::dropIfExists('orders');
    }
}
