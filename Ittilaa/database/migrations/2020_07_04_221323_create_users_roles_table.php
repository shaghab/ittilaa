<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateUsersRolesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('x_users_roles', function (Blueprint $table) {
            $table->id();

            //FOREIGN KEY CONSTRAINTS
            $table->foreignId('user_id')->constrained('x_users')->onDelete('cascade');
            $table->foreignId('role_id')->constrained('x_roles')->onDelete('cascade');

            //SETTING THE UNIQUE KEY PAIR
            $table->unique(['user_id','role_id']);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('x_users_roles');
    }
}
