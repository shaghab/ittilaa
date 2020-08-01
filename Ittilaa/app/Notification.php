<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class Notification extends Model
{
    //The table associated with the model.
    protected $table = 'x_notifications';

    // The attributes that are mass assignable.
    protected $fillable = [
        'short_title',
        'title',
        'category_id',
        'category',
        'd_cat_caption',
        'thumbnail_link',
        'notice_link',
        'description',
        'region_id',
        'region_name',
        'publish_date',
        'issuer_id',
        'issuing_authority',
        'designation',
        'unit_name',
        'unit_type',
        'source_url',
        'caption1',
        'caption2',
        'caption3',
        'operator_id',
        'approver_id',
        'approval_date',
        'approval_status',
    ];

    public function tags() { 
        return $this->belongsToMany(Tag::class,'x_notifications_tags');
    }

    public function getTags(){
        $tags = DB::table('x_notifications_tags')
                  ->leftJoin('x_tags', 'x_tags.id', '=', 'x_notifications_tags.tag_id')
                  ->where('notification_id', $this->id)
                  ->get();
        return $tags;
    }

    public function addTags($tags){

        if (empty(trim($tags))){
            return null;
        }

        $tagNames = explode(';', $tags);
        $tagNames = array_map('trim', $tagNames);
 
        for($index = 0; $index < count($tagNames); $index++)  {

            $tagName = $tagNames[$index];
            if (!empty($tagName)) {
 
                $tag = Tag::whereRaw("LOWER(name) = '" . strtolower($tagName) . "'")->first();
                if(!$tag) {
                    $tag = Tag::create(['name' => $tagName]);
                }

                $this->tags()->attach($tag);
            }
        }
    }

}
