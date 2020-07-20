<?php

use Illuminate\Database\Seeder;

use App\Ministry;

class MinistrySeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // for data refer to: http://www.pakistan.gov.pk/ministries_divisions.html

        $ministry = new Ministry();
        $ministry->name = 'Cabinet Secretariat' ;
        $ministry->save();
    }
}
