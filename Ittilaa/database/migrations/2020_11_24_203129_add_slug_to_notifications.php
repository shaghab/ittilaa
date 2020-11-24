<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

use App\Notification;

class AddSlugToNotifications extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('x_notifications', function (Blueprint $table) {
            $table->string('slug', 300)->after('title')->unique()->nullable();
        });

        $notifications = Notification::all();
        foreach($notifications as $notification) {
            $slug = $notification->updateSlug();
        }
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('x_notifications', function (Blueprint $table) {
            $table->dropColumn('slug');
        });
    }
}
