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
        $category = new Category();
        $category->name = 'Notification';
        $category->caption = 'Notification';
        $category->save();

        $category = new Category();
        $category->name = 'Job';
        $category->caption = 'Notification';
        $category->save();

        $category = new Category();
        $category->name = 'Policy';
        $category->caption = 'Policy';
        $category->save();

        $category = new Category();
        $category->name = 'Tender';
        $category->caption = 'Tender';
        $category->save();

        $category = new Category();
        $category->name = 'Tender';
        $category->level_1 = 'EOL';
        $category->caption = 'EOL';
        $category->save();

        $category = new Category();
        $category->name = 'Tender';
        $category->level_1 = 'RFP';
        $category->caption = 'RFP';
        $category->save();
    }
}
