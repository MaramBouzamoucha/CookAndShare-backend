<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Recipe;
use App\Models\Category;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;

class RecipeController extends Controller
{


    public function index(Request $request) {
        $ownerId = $request->query('owner_id');
        $query = Recipe::with('user','category');
        if ($ownerId) $query->where('user_id', $ownerId);
        return $query->get();
    }

    public function myIndex() {
        $userId = Auth::id();
        if (!$userId) return response()->json(['message' => 'Non connecté'], 401);
        return Recipe::where('user_id', $userId)->get();
    }

    public function store(Request $request) {
        $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'required|string',
            'ingredients' => 'required|string',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
            'category_id' => 'required|exists:categories,id'
        ]);

        $imagePath = null;
        if ($request->hasFile('image')) {
            $imagePath = $request->file('image')->store('recipes', 'public');
        }

        $recipe = Recipe::create([
            'title' => $request->title,
            'description' => $request->description,
            'ingredients' => $request->ingredients,
            'image' => $imagePath,
            'category_id' => $request->category_id,
            'user_id' => $request->user()->id,
        ]);

         return redirect()->route('recipes.myBlade')->with('success', 'Recette ajoutée !');
    }

    public function update(Request $request, $id) {
    $recipe = Recipe::findOrFail($id);
    if ($recipe->user_id != $request->user()->id) return response()->json(['message' => 'Forbidden'], 403);

    $validatedData = $request->validate([
        'title' => 'required|string|max:255',
        'description' => 'nullable|string',
        'ingredients' => 'nullable|string',
        'category_id' => 'required|exists:categories,id',
        'image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048'
    ]);

    if ($request->hasFile('image')) {
        if ($recipe->image) Storage::disk('public')->delete($recipe->image);
        $validatedData['image'] = $request->file('image')->store('recipes', 'public');
    }

    $recipe->update($validatedData);

    return redirect()->route('recipes.myBlade')->with('success', 'Recette modifiée !');
}


    public function destroy($id) {
        $recipe = Recipe::findOrFail($id);
        $recipe->delete();
        return redirect()->route('recipes.myBlade')->with('success', 'Recette supprimé !');
    }

    public function show($id) {
        $recipe = Recipe::with('comments')->find($id);
        if (!$recipe) return response()->json(null, 404);
        return response()->json($recipe);
    }

   

    public function indexBlade() {
        $recipes = Recipe::with('category')->get();
        return view('recipes.index', compact('recipes'));
    }
    

   public function myRecipesBlade() {
        $recipes = Recipe::where('user_id', Auth::id())->get();
        return view('recipes.my_recipes', compact('recipes'));}
   

    public function showBlade($id) {
        $recipe = Recipe::with('comments.user')->findOrFail($id);
        return view('recipes.show', compact('recipe'));
    }

    public function createBlade() {
        $categories = Category::all();
        return view('recipes.create', compact('categories'));
    }

    public function editBlade($id) {
        $recipe = Recipe::findOrFail($id);
        $categories = Category::all();
        return view('recipes.edit', compact('recipe', 'categories'));
    }
     public function edit($id)
    {
        $recipe = Recipe::findOrFail($id);
        $categories = Category::all(); 
        return view('recipes.create', compact('recipe', 'categories'));
    }
    
}
