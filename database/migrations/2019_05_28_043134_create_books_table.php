<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateBooksTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('books', function (Blueprint $table) {
            $table->increments('id');
            $table->string('title',50);
            $table->string('desc');
            $table->integer('created_by')->unsigned();
            $table->enum('active',[0,1]);
            $table->dateTime('created_at');
            $table->dateTime('updated_at')->nullable();
            $table->integer('updated_by')->unsigned()->nullable();
            $table->dateTime('deleted_at')->nullable();

            //make relation with user table
            $table->foreign('created_by')
                    ->references('id')
                    ->on('users');
            $table->foreign('updated_by')
                    ->references('id')
                    ->on('users');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('books');
    }
}
