<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateCategoryableTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('categoryables', function (Blueprint $table) {
            //id категории из таблицы категорий categories
            $table->integer('category_id');
            //id таблицы, связанной с таблицой categories (id связанной модели)
            $table->integer('categoryable_id');
            //Строковое название связанной с categories модели, в которой искать id (categoryable_id)
            $table->string('categoryable_type');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('categoryables');
    }
}
