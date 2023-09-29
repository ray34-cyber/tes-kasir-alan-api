<?php

namespace App\Http\Controllers;

use App\Models\Food;
use Illuminate\Http\Request;


class FoodController extends Controller
{
    
    public function index()
    {   
        
        $foods = Food::all();
        return response()->json($foods);
    }

    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'nama_makanan' => 'required|max:255',
            'image' => 'image|file|max:1024',
            'price' => 'required|numeric|gt:0'
        ]);

        if($request->file('image')) {
            $validatedData['image'] = $request->file('image')->store('product-images');
        }

        Food::create($validatedData);
    }

}
