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

        // populate table 'x_users'
        DB::table('x_users')->insert([
                'user_name' => 'root',
                'email' =>$faker->unique()->email,
                'category' => 'ADMIN',
                'email_verified_at' => $faker->date,
                'password' => 'root'
            ]);

        DB::table('x_users')->insert([
                'user_name' => $faker->unique()->userName,
                'email' =>$faker->unique()->email,
                'category' => 'DATA_OPERATOR',
                'email_verified_at' => $faker->date,
                'password' => '1234'
            ]);

        foreach (range(1,3) as $index) {
            DB::table('x_users')->insert([
                'user_name' => $faker->unique()->userName,
                'email' =>$faker->unique()->email,
                'category' => 'GUEST',
                'email_verified_at' => $faker->date,
                'password' => '1234'
            ]);
        }
    }
}
