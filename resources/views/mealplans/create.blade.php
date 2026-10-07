@extends('layouts.app')
@section('title', 'Ajouter Meal Plan')

@section('content')
<div class="max-w-md mx-auto bg-white p-6 rounded shadow">
    <h1 class="text-2xl font-bold main-color mb-4">Ajouter ou Mettre à jour un Meal Plan</h1>
    <form method="POST" action="{{ route('mealplans.store') }}">
        @csrf
        <div class="mb-4">
            <label class="block font-bold main-color">Jour</label>
            <select name="day" class="w-full p-2 border rounded">
                @foreach(['Lundi','Mardi','Mercredi','Jeudi','Vendredi','Samedi','Dimanche'] as $day)
                    <option value="{{ $day }}">{{ $day }}</option>
                @endforeach
            </select>
        </div>
        <div class="mb-4">
            <label class="block font-bold main-color">Type de repas</label>
            <select name="meal_type" class="w-full p-2 border rounded">
                @foreach(['Breakfast','Lunch','Dinner'] as $mealType)
                    <option value="{{ $mealType }}">{{ $mealType }}</option>
                @endforeach
            </select>
        </div>
        <div class="mb-4">
            <label class="block font-bold main-color">Recette</label>
            <select name="recipe_id" class="w-full p-2 border rounded">
                @foreach($recipes as $recipe)
                    <option value="{{ $recipe->id }}">{{ $recipe->title }}</option>
                @endforeach
            </select>
        </div>
        <div class="mb-4">
            <label class="block font-bold main-color">Titre du repas</label>
            <input type="text" name="title" class="w-full p-2 border rounded">
        </div>
        <button type="submit" class="bg-main text-white px-4 py-2 rounded">Enregistrer</button>
    </form>
</div>
@endsection
