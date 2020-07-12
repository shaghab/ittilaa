<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Faker\Factory as Faker;

use App\Notification;

class NotificationSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // populate fake data
        $faker = Faker::create();

        // populate table 'x_notifications'
        foreach (range(1,500) as $index) {
            DB::table('x_notifications')->insert([
                'title' => $faker->title,
                'category' => 'NOTICE',
                'notice_path' => $faker->imageUrl,
                'notice_format' => 'IMAGE',
                'description' => $faker->text,
                'region' => 'Islamabad',
                'publishing_authority' => $faker->name,
                'publish_date' => $faker->date,
                'notifier' => $faker->name,
                'notifier_designation' => $faker->jobTitle,
                'source_url' => $faker->url,
                'approved_by' => $faker->name,
                'approval_date' => $faker->date,
                'approval_status' => $faker->randomElement(array('IN_PROCESS', 'APPROVED', 'REJECTED'))
            ]);
        }

    }
}
