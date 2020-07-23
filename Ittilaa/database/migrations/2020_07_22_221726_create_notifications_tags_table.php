<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateNotificationsTagsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('x_notifications_tags', function (Blueprint $table) {
            $table->id();

            //FOREIGN KEY CONSTRAINTS
            $table->foreignId('notification_id')->constrained('x_notifications')->onDelete('cascade');
            $table->foreignId('tag_id')->constrained('x_tags')->onDelete('cascade');

            //SETTING THE UNIQUE KEYS (PRIMARY IDENTIFYING KEYS)
            $table->unique(['notification_id','tag_id']);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('x_notifications_tags');
    }
}
