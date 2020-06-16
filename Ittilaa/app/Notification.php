<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Notification extends Model
{
    //The table associated with the model.
    protected $table = 'x_notifications';

    

    // The attributes that are mass assignable.
    protected $fillable = [
        'title',
        'category',
        'notice_path',
        'notice_format',
        'description',
        'region',
        'publishing_authority',
        'publish_date',
        'notifier',
        'notifier_designation',
        'source_url',
    ];

    // The attributes that should be hidden for arrays.
    protected $hidden = [
        'approved_by',
        'approval_date',
    ];


}
