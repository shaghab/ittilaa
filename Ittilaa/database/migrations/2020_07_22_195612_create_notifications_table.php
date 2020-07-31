<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Carbon\Carbon;

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
            $table->string('short_title')->nullable();
            $table->foreignId('category_id')->constrained('x_categories');
            $table->string('category');
            $table->string('d_cat_caption');
            $table->string('thumbnail_link')->unique();
            $table->string('notice_link')->unique();
            $table->text('description');
            $table->foreignId('region_id')->constrained('x_regions');
            $table->string('region_name');
            $table->dateTime('publish_date');
            
            $table->foreignId('issuer_id')->constrained('x_issuing_authorities');
            $table->string('issuing_authority')->nullable();
            $table->string('designation');
            $table->string('unit_name');
            $table->string('unit_type')->nullable();
            $table->string('source_url')->nullable();

            $table->string('caption1')->nullable();
            $table->string('caption2')->nullable();
            $table->string('caption3')->nullable();

            $table->foreignId('operator_id')->constrained('x_users');
            $table->foreignId('approver_id')->constrained('x_users')->nullable();
            $table->dateTime('approval_date')->default(Carbon::now())->nullable();
            $table->string('approval_status')->default('approved');

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
