<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Faker\Factory as Faker;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        $faker = Faker::create();

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
                'approval_date' => $faker->date
            ]);
        }
    }
}
