<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

use App\Tag;

class TagSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        
        $tag1 = new Tag();
        $tag1->name = "tag1";
        $tag1->save();

        $tag2 = new Tag();
        $tag2->name = "tag2";
        $tag2->save();
        
        $tag3 = new Tag();
        $tag3->name = "tag3";
        $tag3->save();
        
        $tag4 = new Tag();
        $tag4->name = "tag4";
        $tag4->save();
        
        $tag5 = new Tag();
        $tag5->name = "tag5";
        $tag5->save();
    }
}
