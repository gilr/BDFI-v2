<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateRelationshipsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('relationships', function (Blueprint $table) {
            $table->increments('id');

            $table->integer('author1_id')
                ->constrained('authors')
                ->onDelete('restrict');
            $table->integer('author2_id')
                ->constrained('authors')
                ->onDelete('restrict');
            $table->tinyInteger('relationship_type_id')
                ->constrained()
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
        Schema::dropIfExists('relationships');
    }
}
