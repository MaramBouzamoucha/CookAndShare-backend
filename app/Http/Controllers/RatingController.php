<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class RatingController extends Controller
{
    public function storeOrUpdate(Request $request, $recipe_id){
        $request->validate([
            'rating' => 'required|integer|min:1|max:5'
        ]);

        $user = $request->user();

        $rating = Rating::updateOrCreate(
            [
                'user_id' => $user->id,
                'recipe_id' => $recipe_id
            ],
            ['rating' => $request->rating]
        );

        return response()->json($rating);
    }

  
    public function index($recipe_id){
        $ratings = Rating::where('recipe_id',$recipe_id)->with('user')->get();
        return response()->json($ratings);
    }
}
