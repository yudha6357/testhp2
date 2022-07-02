<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Helpers\CategoryHelper;
use App\Models\Category;
use Validator;

class CategoryController extends Controller
{
    public function __construct()
    {
        $this->CategoryHelper = new CategoryHelper;
    }


    public function index()
    {
        $data = Category::all();
        return view('category',compact("data"));
    }

    public function create(Request $request)
    {
        $validation = Validator::make($request->all(), [
            "type"             => "required",
            "name"             => "required",
            "description"      => "required",
        ]);

        if($validation->fails()) {
            $errors = $validation->errors();
            return redirect()->back()->with("errors", $errors);
        }
        else {
            $this->CategoryHelper->create($request);
            return redirect()->route('category')->with("success",'Data Berhasil Ditambahkan');
        }
    }

    public function edit(Request $request)
    {
        $data = Category::findOrFail($request->get('id'));
        echo json_encode($data);
    }

    public function update(Request $request)
    {
        $validation = Validator::make($request->all(), [
            "category_type"    => "required",
            "name"             => "required",
            "description"      => "required",
        ]);

        if($validation->fails()) {
            $errors = $validation->errors();
            return redirect()->back()->with("errors", $errors);
            // return redirect()->back();
        }
        else {
            $this->CategoryHelper->update($request);
            return redirect()->route('category')->with("success",'Data Berhasil Diperbaharui');
        }
    }

    public function destroy($id){
        $post = Category::find($id); 
        $post->delete();
        return redirect()->route('category')->with("success",'Data Berhasil DIHAPUS');
    }

}
