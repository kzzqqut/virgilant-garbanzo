<?php
/**
 * Created by PhpStorm.
 * User: kzzqqut
 * Date: 10/25/17
 * Time: 8:57 PM
 */

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateObjectsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('objects', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('main_id');
            $table->integer('category_id');
            $table->integer('subcategory_id');
            $table->string('name');
            $table->text('description');
            $table->decimal('price');
            $table->integer('currency_id');
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
        Schema::dropIfExists('objects');
    }
}