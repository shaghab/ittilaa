<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class Category extends Model
{
   //The table associated with the model.
    protected $table = 'x_categories';

    protected $fillable = [
        'name',
        'level_1',
        'caption'
    ];

    public static function getId($name) {

        $cat = explode("/", $name);
        $catLevels = count($cat);
        
        switch ($catLevels) {
            case 1:
                $category = Category::where('name', $cat[0])->first();
                return ($category) ? $category->id : -1;
            case 2:
                $category = Category::where([
                                            ['name', '=', $cat[0]], 
                                            ['level_1', '=', $cat[1]]
                                            ])->first();
                return ($category) ? $category->id : -1;
        }
                
        return -1;
    }

    public static function getCategories() {
        $all = Category::all();

        $categories = [];
        foreach($all as $cat ){
            if (!empty($cat->level_1)) {
                $categories[$cat->id] = ['id' => $cat->id, 'name' => $cat->name . "/" . $cat->level_1];
            }
            else {
                $categories[$cat->id] = ['id' => $cat->id, 'name' => $cat->name];
            }
        }

        return $categories;
    }

    public static function createNew($name, $caption = "") {

        // TODO: throw exception if $name is empty
        if (empty($name)){
            throw new Exception('category name is empty');
        }

        $id = Category::getId($name);
        if ($id == -1) {
        
            $cat = explode("/", $name);
            $catLevels = count($cat);

            switch ($catLevels) {
                case 1:
                    if (empty($caption)) $caption = $cat[0];
                    return Category::create(['name' => $cat[0],
                                             'caption' => $caption]);
                case 2:
                    if (empty($caption)) $caption = $cat[1];
                    return Category::create(['name' => $cat[0],
                                             'level_1' => $cat[1],
                                             'caption' => $caption]);
            }
        }

        return Category::find($id);
    }
}
