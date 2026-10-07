<?php

namespace App\Http\Controllers;

use App\Models\Favorite;
use Illuminate\Support\Facades\Auth;

class FavoritesController extends Controller
{
    public function index() {
        $favorites = Favorite::with('recipe')->where('user_id', Auth::id())->get();
        return response()->json($favorites->map(fn($f) => $f->recipe));
    }

  
    public function indexBlade() {
        $favorites = Favorite::with('recipe')->where('user_id', Auth::id())->get()->map(fn($f) => $f->recipe);
        return view('favorites.index', compact('favorites'));
    }
}
