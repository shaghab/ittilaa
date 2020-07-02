<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateNotificationsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('x_notifications', function (Blueprint $table) {
            $table->id();
            $table->string('title');
            $table->enum('category', array('NOTICE', 'JOB', 'TENDER', 'POLICY'));
            $table->string('notice_path');
            $table->enum('notice_format', array('PDF', 'IMAGE'));
            $table->text('description')->nullable();
            $table->string('region');
            $table->string('approved_by')->nullable();
            $table->dateTime('approval_date')->nullable();
            $table->enum('approval_status', array('IN_PROCESS', 'APPROVED', 'REJECTED'));
            $table->string('publishing_authority')->nullable();
            $table->dateTime('publish_date')->nullable();
            $table->string('notifier')->nullable();
            $table->string('notifier_designation')->nullable();
            $table->string('source_url')->nullable();
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
        Schema::dropIfExists('x_notifications');
    }
}
