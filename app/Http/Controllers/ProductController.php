<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Product;
use DB;

class ProductController extends Controller
{
    public function index() {
        return view('products');
    }  


    public function loadmore(Request $request){
        $products = DB::table('products')
        ->limit($request['limit'])
        ->offset($request['start'])
        ->get();
    
        foreach ($products as $key) {
          echo '<div class="card">
          <img src="'.$key->image.'" alt="image">
          <div class="card-body">
              <h5 class="card-title">'.$key->title.'</h5>
          </div>
      </div>'; 
    
        }
      }
}
