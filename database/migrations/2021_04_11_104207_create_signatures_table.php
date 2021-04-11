<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateSignaturesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('signatures', function (Blueprint $table) {
            $table->increments('id');

            $table->integer('author_id')
                ->constrained('authors')
                ->onDelete('restrict');
            $table->integer('signature_id')
                ->constrained('authors')
                ->onDelete('restrict');

            $table->timestamps();
            $table->smallInteger('created_by')->nullable();
            $table->smallInteger('updated_by')->nullable();            
            $table->smallInteger('deleted_by')->nullable();            
            $table->softdeletes(); 
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('signatures');
    }
}
