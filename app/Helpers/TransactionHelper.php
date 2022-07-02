<?php

namespace App\Helpers;

use Illuminate\Database\Eloquent\Model;
use App\Models\Transaction;
use Request;


class TransactionHelper

{
    public static function create($param)
    {
        $nominalTemp = $param->nominal;
        $nominalReplaceRp = str_replace("Rp. ","",$nominalTemp);
        $nominal = str_replace(".","",$nominalReplaceRp);
        $data['category_id']     = $param->category;
        $data['name']            = $param->name;
        $data['nominal']         = (float) $nominal;
        $data['description']     = $param->description;
        $save = Transaction::create($data);
        if(!$save){
            return redirect()->back()->with("errors", $errors);
        }
    }

    public static function update($param)
    {
        $nominalTemp = $param->nominal;
        $nominalReplaceRp = str_replace("Rp. ","",$nominalTemp);
        $nominal = str_replace(".","",$nominalReplaceRp);
        $data['category_id']     = $param->category;
        $data['name']            = $param->name;
        $data['nominal']         = (float) $nominal;
        $data['description']     = $param->description;

        $save = Transaction::where('id','=',$param->id)->update($data);
        if(!$save){
            return redirect()->back()->with("errors", $errors);
        }
    }
    


}

