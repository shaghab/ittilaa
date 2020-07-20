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
        'thumbnail_link',
        'notice_link',
        'notice_doc_type',
        'description',
        'region_id',
        'region_name',
        'division_id',
        'division_name',
        'ministry_id',
        'ministry_name',
        'signing_authority',
        'notifier',
        'notifier_designation',
        'publish_date',
        'source_url',
        'operator_id',
        'creation_date',
        'approver_id',
        'approval_date',
        'approval_status',
    ];
}
