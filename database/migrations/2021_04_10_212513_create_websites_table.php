<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateWebsitesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('websites', function (Blueprint $table) {
            $table->increments('id');

            $table->bigInteger('author_id')
                ->constrained()
                ->onDelete('restrict');

            $table->string('url', 256);

            $table->tinyInteger('website_type_id')
                ->constrained()
                ->onDelete('restrict');

            $table->smallInteger('country_id')
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
        Schema::dropIfExists('websites');
    }
}
