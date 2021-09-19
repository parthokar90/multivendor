<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTempAttributesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('temp_attributes', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('vendor_id');
            $table->unsignedBigInteger('type_id');
            $table->unsignedBigInteger('value_id');
            $table->integer('quantity')->default(0);
            $table->integer('alert_quantity')->default(0);
            $table->decimal('regular_price')->default(0);
            $table->decimal('sell_price')->default(0);
            $table->decimal('cost_price')->default(0);
            $table->string('image')->nullable();
            $table->tinyInteger('status')->default(1);
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
        Schema::dropIfExists('temp_attributes');
    }
}
