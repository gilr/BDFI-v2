<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateAuthorsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('authors', function (Blueprint $table) {
            $table->increments('id');

            $table->string('name', 32);
            $table->string('nom_bdfi', 32);
            $table->string('first_name', 32)->nullable();
            $table->string('legal_name', 128)->nullable();
            $table->string('forms', 512)->nullable();
            $table->boolean('pseudonym');
            $table->enum('gender', ['F', 'H', 'IEL', '?'])->default('?');

            $table->smallInteger('country_id')
                ->constrained()
                ->onDelete('restrict')
                ->nullable();

            $table->smallInteger('country2_id')
                ->constrained('country')
                ->onDelete('restrict')
                ->nullable();

            $table->string('birth_date', 10)->nullable();
            $table->string('birthplace', 64)->nullable();
            $table->string('date_death', 10)->nullable();
            $table->string('place_death', 64)->nullable();

            $table->text('biography')->nullable();
            $table->text('private')->nullable();

            $table->tinyInteger('quality_id')
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
        Schema::dropIfExists('authors');
    }
}
