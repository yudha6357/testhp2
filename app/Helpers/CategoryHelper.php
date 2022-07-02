<?php

namespace App\Helpers;

use Illuminate\Database\Eloquent\Model;
use App\Models\Category;
use Request;


class CategoryHelper

{
    public static function create($param)
    {
        $data['logging_type']    = $param->type;
        $data['name']            = $param->name;
        $data['description']     = $param->description;
        $save = Category::create($data);
        if(!$save){
            return redirect()->back()->with("errors", $errors);
        }
    }

    public static function update($param)
    {
        $data['logging_type']    = $param->type;
        $data['name']            = $param->name;
        $data['description']     = $param->description;

        $save = Category::where('id','=',$param->id)->update($data);
        if(!$save){
            return redirect()->back()->with("errors", $errors);
        }
    }
    


}

