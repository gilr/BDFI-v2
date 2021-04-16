<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateWebsiteTypesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('website_types', function (Blueprint $table) {
            $table->tinyIncrements('id');

            $table->string('name', 32)->unique();
            $table->string('description', 128)->nullable();
            $table->string('displayed_text', 64)->unique();
            $table->boolean('obsolete');

            $table->timestamps();
            $table->smallInteger('created_by')->nullable();
            $table->smallInteger('updated_by')->nullable();            
            $table->smallInteger('deleted_by')->nullable();            
            $table->softdeletes();        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('website_types');
    }
}
