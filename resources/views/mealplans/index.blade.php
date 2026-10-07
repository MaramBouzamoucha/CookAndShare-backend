@extends('layouts.app')
@section('title', 'Mon Meal Plan')

@section('content')
<h1 class="text-3xl font-bold main-color mb-6">Mon Meal Plan</h1>

@foreach(['Lundi','Mardi','Mercredi','Jeudi','Vendredi','Samedi','Dimanche'] as $day)
<div class="bg-white p-4 rounded shadow mb-4">
    <h2 class="text-xl font-bold main-color">{{ $day }}</h2>
    @foreach(['Breakfast','Lunch','Dinner'] as $mealType)
        @php
            $meal = $mealPlans->first(fn($m) => $m->day === $day && $m->meal_type === $mealType);
        @endphp
        <div class="border-t py-2 flex justify-between items-center">
            <span class="font-semibold main-color">{{ $mealType }}</span>
            @if($meal)
                <span>{{ $meal->title }}</span>
                <form method="POST" action="{{ route('mealplans.destroy', $meal->id) }}">
                    @csrf
                    @method('DELETE')
                    <button type="submit" class="bg-main text-white px-2 py-1 rounded">Supprimer</button>
                </form>
            @else
                <span class="text-gray-400">Aucune recette</span>
            @endif
        </div>
    @endforeach
</div>
@endforeach

<a href="{{ route('mealplans.create') }}" class="bg-main text-white px-4 py-2 rounded inline-block mt-4">Ajouter un Meal Plan</a>
@endsection
