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
            $table->string('category');
            $table->string('thumbnail_link');
            $table->string('notice_link');
            $table->string('notice_doc_type');
            $table->text('description')->nullable();

            $table->foreignId('region_id')->constrained('x_regions')->onDelete('cascade');
            $table->string('region_name');
            $table->foreignId('division_id')->constrained('x_divisions')->onDelete('cascade');
            $table->string('division_name');
            $table->foreignId('ministry_id')->constrained('x_ministries')->onDelete('cascade');
            $table->string('ministry_name');
            $table->string('signing_authority');
            $table->string('notifier')->nullable();
            $table->string('notifier_designation')->nullable();
            $table->dateTime('publish_date')->nullable();
            $table->string('source_url')->nullable();

            $table->foreignId('operator_id')->constrained('x_users')->onDelete('cascade');
            $table->dateTime('creation_date');
            $table->foreignId('approver_id')->nullable()->constrained('x_users')->onDelete('cascade');
            $table->dateTime('approval_date')->nullable();
            $table->string('approval_status');

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
