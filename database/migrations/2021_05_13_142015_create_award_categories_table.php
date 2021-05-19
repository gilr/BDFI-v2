<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateAwardCategoriesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('award_categories', function (Blueprint $table) {
            $table->increments('id');
            $table->string('name', 128);

            $table->unsignedInteger('award_id');
            $table->foreign('award_id')
                ->references('id')
                ->on('awards')
                ->onDelete('restrict');

            $table->unsignedInteger('internal_order');
            $table->enum('type', ['roman','novella','nouvelle','anthologie','recueil','auteur','special','autre']);
            $table->enum('genre', ['imaginaire','sf','fantastique','fantasy','horreur','mainstream','autre']);
            $table->string('subgenre', 256)->nullable();

            $table->text('description')->nullable();

            $table->timestamps();
            $table->unsignedSmallInteger('created_by')->nullable();
            $table->unsignedSmallInteger('updated_by')->nullable();            
            $table->unsignedSmallInteger('deleted_by')->nullable();            
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
        Schema::dropIfExists('award_categories');
    }
}
