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
            $table->bigInteger( 'product_id' )->unsigned();
            $table->integer( 'unit_price' );
            $table->integer( 'amount' );
            $table->string( 'first_name' );
            $table->string( 'last_name' );
            $table->string( 'email' );
            $table->string( 'phone' );
            $table->string( 'address' );
            $table->string( 'country' );
            $table->string( 'state' )->nullable();
            $table->string( 'city' )->nullable();
            $table->string( 'postcode' );
            $table->timestamps();

            $table->foreign( 'product_id' )->references( 'id' )->on( 'products' );
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
