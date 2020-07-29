<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateIssuingAuthoritiesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('x_issuing_authorities', function (Blueprint $table) {
            $table->id();

            $table->string('name')->nullable();
            $table->string('designation');
            $table->string('unit_name');
            $table->string('unit_type')->nullable();

            $table->timestamps();

            //SETTING THE UNIQUE KEYS (PRIMARY IDENTIFYING KEYS)
            $table->unique(['name','designation', 'unit_name']);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('x_issuing_authorities');
    }
}
