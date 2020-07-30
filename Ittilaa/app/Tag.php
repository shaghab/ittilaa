<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Tag extends Model
{
    //The table associated with the model.
    protected $table = 'x_tags';

    protected $fillable = [
    	'name', 
    ];

    public function notifications() { 
        return $this->belongsToMany(Notification::class,'x_notifications_tags');
    }

    public static function getId($tagName) {
        $tag = Tag::where('name',$tagName)->first();   
        return $tag->id;
    }
}
