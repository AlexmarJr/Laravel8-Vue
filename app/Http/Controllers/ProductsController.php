<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Products;
use Illuminate\Support\Carbon;

class ProductsController extends Controller
{
    public function index(){
        return Products::orderBy('created_at', 'DESC')->get();
    }

    public function store(Request $request){
        if($request->item["id"]){
            $head = Products::find($request->item["id"]);

            $head->name = $request->item["name"];
            $head->save();
            return "Item Atualizado";
        }
        else{
            $new = new Products;
            $new->name = $request->item["name"];
            $new->save(); 
    
            return "Item Criado";
        }
        
    }

    public function update(Request $request, $id){
        $head = Products::find($id);

        if($head){
            $head->completed = $request->item["completed"] ? true : false;
            $head->completed_at = $request->item["completed"] ? Carbon::now() : null;
            $head->save();

            return $head;
        }

        return "Item Not Founded";
    }

    public function edit($id){
       $head = Products::find($id);

       if($head){
           return $head;
       }

       return "Not Founded";
    }
    public function destroy($id){
        $head = Products::find($id);

        if($head){
            $head->delete();
            return "Deleted";
        }

        return "Not Delete";
    }
}
