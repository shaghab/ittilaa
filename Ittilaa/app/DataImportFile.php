<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class DataImportFile extends Model
{
    //The table associated with the model.
    protected $table = 'x_data_import_files';

    protected $fillable = [
        'file_name',
        'has_header_row',
        'file_data',
    ];

}
