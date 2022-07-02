<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Helpers\TransactionHelper;
use App\Models\Transaction;
use App\Models\Category;
use Validator;

class TransactionController extends Controller
{
    public function __construct()
    {
        $this->TransactionHelper = new TransactionHelper;
    }


    public function index()
    {
        $data = Transaction::all();
        $category = Category::all(); 
        return view('transaction',compact("data","category"));
    }

    public function create(Request $request)
    {
        $validation = Validator::make($request->all(), [
            "category"             => "required",
            "name"             => "required",
            "nominal"             => "required",
            "description"      => "required",
        ]);

        if($validation->fails()) {
            $errors = $validation->errors();
            return redirect()->back()->with("errors", $errors);
        }
        else {
            // dd($request);
            $this->TransactionHelper->create($request);
            return redirect()->route('transaction')->with("success",'Data Berhasil Ditambahkan');
        }
    }

    public function edit(Request $request)
    {
        $data = Transaction::findOrFail($request->get('id'));
        echo json_encode($data);
    }

    public function update(Request $request)
    {
        $validation = Validator::make($request->all(), [
            "name"             => "required",
            "nominal"             => "required",
            "description"      => "required",
        ]);

        if($validation->fails()) {
            $errors = $validation->errors();
            return redirect()->back()->with("errors", $errors);
            // return redirect()->back();
        }
        else {
            $this->TransactionHelper->update($request);
            return redirect()->route('transaction')->with("success",'Data Berhasil Diperbaharui');
        }
    }

    public function destroy($id){
        $post = Transaction::find($id); 
        $post->delete();
        return redirect()->route('transaction')->with("success",'Data Berhasil DIHAPUS');
    }

    public function filter(Request $request){
        $from = date($request->start);
        $to = date($request->end);
        
        $data = Transaction::whereBetween('created_at', [$from, $to])->get();
        $category = Category::all(); 
        return view('transaction',compact("data","category"));
    }
}
