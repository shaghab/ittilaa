<?php

use Illuminate\Database\Seeder;

use App\Division;
use App\Ministry;

class DivisionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // for data refer to: http://www.pakistan.gov.pk/ministries_divisions.html

        $div1 = new Division();
        $div1->name = 'Aviation Division';
        $div1->ministry_id = Ministry::GetId('Cabinet Secretariat');
        $div1->save();

        $div2 = new Division();
        $div2->name = 'Cabinet Division';
        $div2->ministry_id = Ministry::GetId('Cabinet Secretariat');
        $div2->save();

        $div3 = new Division();
        $div3->name = 'Capital Administration & Development Division';
        $div3->ministry_id = Ministry::GetId('Cabinet Secretariat');
        $div3->save();

        $div4 = new Division();
        $div4->name = 'Establishment Division';
        $div4->ministry_id = Ministry::GetId('Cabinet Secretariat');
        $div4->save();

        $div5 = new Division();
        $div5->name = 'National Security Division';
        $div5->ministry_id = Ministry::GetId('Cabinet Secretariat');
        $div5->save();
    }
}
