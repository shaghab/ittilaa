<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateRolesPermissionsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('x_roles_permissions', function (Blueprint $table) {
            $table->id();

            //FOREIGN KEY CONSTRAINTS
            $table->foreignId('role_id')->constrained('x_roles')->onDelete('cascade');
            $table->foreignId('permission_id')->constrained('x_permissions')->onDelete('cascade');

            //SETTING THE PRIMARY KEYS
            $table->unique(['role_id','permission_id']);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('x_roles_permissions');
    }
}
