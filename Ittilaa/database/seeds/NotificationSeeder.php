<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Faker\Factory as Faker;

use App\User;
use App\Region;
use App\Ministry;
use App\Division;
use App\Tag;
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
        $rand = 0;
        for ($index=0; $index < 10; $index++) { 

            $notification = new Notification();
            $notification->title = 'Ghori Town Phase 4-A and 5-A Sealed';
            $notification->category = 'NOTICE';

            if ($index%3 == 0) {
                $notification->notice_link = 'notifications/documents/notif.pdf';
                $notification->notice_doc_type = 'PDF';
            }
            else {
                $notification->notice_link = 'notifications/documents/notif.jpg';
                $notification->notice_doc_type = 'IMAGE';
            }

            $notification->thumbnail_link = 'notifications/thumbnails/notif.jpg';

            $notification->description = "Due to huge number of COVID-19 cases in the areas of Ghori Town Phase 4-A and 5-A, the mentioned areas have been sealed till further orders. Due to huge number of COVID-19 cases in the areas of Ghori Town Phase 4-A and 5-A, the mentioned areas have been sealed till further orders.";

            $notification->region_id = Region::GetId('Islamabad');
            $notification->region_name = 'Islamabad';

            $notification->ministry_id = Ministry::GetId('Cabinet Secretariat');
            $notification->ministry_name = 'Cabinet Secretariat';

            $notification->division_id = Division::GetId('Capital Administration & Development Division');
            $notification->division_name = 'Capital Administration & Development Division';

            $notification->signing_authority = 'Office of the District Magistrate Islamabad Capital Territory, Islamabad';

            $datetime = new DateTime(); 
            $datetime->setDate('2020', '06', '25');
            $notification->publish_date = $datetime;

            $notification->operator_id = User::GetId('admin');
            $notification->creation_date = Carbon\Carbon::now();
            $notification->approval_status = config('enum.approval_status.pending');

            $notification->save();

            $tags = Tag::all();
            foreach ($tags as $tag){
                $notification->tags()->attach($tag);
                if ($rand++%3 == 0)
                    break;
            }
        }
    }
}
