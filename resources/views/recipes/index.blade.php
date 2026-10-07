@extends('layouts.app')
@section('title', 'Recettes')

@section('content')
<h1 class="text-3xl font-bold" style="color:#CC5500; margin-bottom:24px;">Toutes les recettes</h1>

<div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
    @foreach($recipes as $recipe)
    <div class="bg-white rounded shadow p-4">
        <h2 class="text-xl font-bold" style="color:#CC5500;">{{ $recipe->title }}</h2>

        @if($recipe->image)
            <img src="{{ asset('storage/' . $recipe->image) }}" class="w-full h-48 object-cover mt-2 mb-2 rounded">
        @endif

        <p>{{ Str::limit($recipe->description, 100) }}</p>

        <a href="{{ route('recipes.showBlade', $recipe->id) }}" 
           style="color:#CC5500; font-weight:bold; margin-top:8px; display:inline-block;">
           Voir plus
        </a>
    </div>
    @endforeach
</div>
@endsection
