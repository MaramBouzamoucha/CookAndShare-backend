<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\MealPlan;
use App\Models\Recipe;
use Illuminate\Support\Facades\Auth;
use Illuminate\Validation\Rule;

class MealPlanController extends Controller
{
    public function index() {
        $mealPlans = MealPlan::with('recipe')->where('user_id', Auth::id())->get();
        return response()->json($mealPlans);
    }

    public function store(Request $request) {
        $validated = $request->validate([
            'day' => ['required', Rule::in(['Lundi','Mardi','Mercredi','Jeudi','Vendredi','Samedi','Dimanche'])],
            'recipe_id' => ['required', 'integer', 'exists:recipes,id'],
            'meal_type' => ['required', Rule::in(['Breakfast','Lunch','Dinner'])],
            'title' => ['required', 'string', 'max:255']
        ]);

        $mealPlan = MealPlan::updateOrCreate(
            ['user_id' => Auth::id(), 'day' => $validated['day'], 'meal_type' => $validated['meal_type']],
            ['recipe_id' => $validated['recipe_id'], 'title' => $validated['title']]
        );

        $mealPlan->load('recipe');
        return response()->json(['message' => 'Meal plan créé ou mis à jour !', 'meal_plan' => $mealPlan], 201);
    }

    public function destroy($id) {
        $mealPlan = MealPlan::where('id', $id)->where('user_id', Auth::id())->firstOrFail();
        $mealPlan->delete();
        return response()->json(['message' => 'Meal plan supprimé']);
    }


    public function indexBlade() {
        $mealPlans = MealPlan::with('recipe')->where('user_id', Auth::id())->get();
        $recipes = Recipe::all();
        return view('mealplans.index', compact('mealPlans', 'recipes'));
    }

    public function createBlade() {
        $recipes = Recipe::all();
        return view('mealplans.create', compact('recipes'));
    }
}
