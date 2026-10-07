@extends('layouts.app')
@section('title', 'Mes Favoris')

@section('content')
<h1 class="text-3xl font-bold main-color mb-6">Mes Recettes Favorites</h1>
<div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
    @foreach($favorites as $recipe)
    <div class="bg-white rounded shadow p-4">
        <h2 class="text-xl font-bold main-color">{{ $recipe->title }}</h2>
        @if($recipe->image)
            <img src="{{ asset('storage/' . $recipe->image) }}" class="w-full h-48 object-cover mt-2 mb-2 rounded">
        @endif
        <a href="{{ route('recipes.show', $recipe->id) }}" class="text-main-color font-bold mt-2 inline-block">Voir plus</a>
    </div>
    @endforeach
</div>
@endsection
