<?php

use Illuminate\Database\Seeder;

use App\Category;

class CategorySeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //
        $style = 'btn btn-primary btn-sm notification-btn stretched-link';
        Category::createNew('Notification', 'Notification', 'notification-btn');
        Category::createNew('Job', 'Job', 'job-btn');
        Category::createNew('Tender', 'Tender', 'tender-btn');
        Category::createNew('Policy', 'Policy', 'policy-btn');
    }
}
