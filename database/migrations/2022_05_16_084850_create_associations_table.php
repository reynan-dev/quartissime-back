<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateAssociationsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('associations', function (Blueprint $table) {
            $table->id();
            $table->text('name');
            $table->text('adress');
            $table->tinyInteger('adress_public')->default(0);
            $table->text('website');
            $table->text('facebook')->nullable();
            $table->text('email');
            $table->text('tel')->nullable();
            $table->longText('description')->nullable();
            $table->float('latitude', 9, 7);
            $table->float('longitude', 9, 7);
            $table->integer('committee_id');
            $table->tinyInteger('accept')->default(0);
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
        Schema::dropIfExists('association');
        Schema::dropIfExists('associations');
    }
}
