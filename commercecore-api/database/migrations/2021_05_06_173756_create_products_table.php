<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\DB;

class CreateProductsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('products', function (Blueprint $table) {
            $table->id();
            $table->string( 'title' )->nullable( false );
            $table->integer( 'unit_price_usd' )->nullable( false );
            $table->integer( 'amount' );
            $table->smallInteger( 'discount' )->nullable();
            $table->smallInteger( 'discounted_price' )->nullable();
            $table->string( 'json_options', 200 );
            $table->timestamps();
        });

        DB::table( 'products' )->insert([
            "title" => "3x Watch",
            "unit_price_usd" => 7691,
            "amount" => 3,
            "discounted_price" => 3749,
            "discount" => 75,
            "json_options" => '{"best_seller": true, "popularity": 3}'
        ]);

        DB::table( 'products' )->insert([
            "title" => "1x Watch",
            "unit_price_usd" => 7691,
            "amount" => 1,
            "discounted_price" => 4999,
            "discount" => 50,
            "json_options" => '{"best_seller": false, "popularity": 1}'
        ]);

        DB::table( 'products' )->insert([
            "title" => "2x Watch",
            "unit_price_usd" => 7691,
            "amount" => 2,
            "discounted_price" => 4999,
            "discount" => 50,
            "json_options" => '{"best_seller": false, "popularity": 2}'
        ]);

        DB::table( 'products' )->insert([
            "title" => "4x Watch",
            "unit_price_usd" => 7691,
            "amount" => 2,
            "discounted_price" => 3437,
            "discount" => 72,
            "json_options" => '{"best_seller": false, "popularity": 2}'
        ]);
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('products');
    }
}
