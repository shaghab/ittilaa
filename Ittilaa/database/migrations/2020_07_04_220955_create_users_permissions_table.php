<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateUsersPermissionsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('x_users_permissions', function (Blueprint $table) {
            $table->id();

            //FOREIGN KEY CONSTRAINTS
            $table->foreignId('user_id')->constrained('x_users')->onDelete('cascade');
            $table->foreignId('permission_id')->constrained('x_permissions')->onDelete('cascade');
 
            //SETTING UNIQUE KEY PAIR
            $table->unique(['user_id','permission_id']);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('x_users_permissions');
    }
}
