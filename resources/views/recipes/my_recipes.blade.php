@extends('layouts.app')
@section('title', 'Mes recettes')

@section('content')
<h1 style="font-size: 28px; font-weight: bold; color: #ff6600; margin-bottom: 20px;">Mes recettes</h1>

<div style="display: flex; flex-wrap: wrap; gap: 20px;">
    @foreach($recipes as $recipe)
    <div style="background: #fff; border-radius: 10px; box-shadow: 0 2px 8px rgba(0,0,0,0.1); padding: 15px; width: 300px;">
        <h2 style="font-size: 20px; font-weight: bold; color: #ff6600; margin-bottom: 10px;">{{ $recipe->title }}</h2>

        @if($recipe->image)
            <img src="{{ asset('storage/' . $recipe->image) }}" style="width: 100%; height: 180px; object-fit: cover; border-radius: 8px; margin-bottom: 10px;">
        @endif

        <p>{{ Str::limit($recipe->description, 100) }}</p>

        <div style="margin-top: 10px;">
            <a href="{{ route('recipes.showBlade', $recipe->id) }}" style="display: inline-block; margin-right: 5px; color: #fff; background-color: #9e8371; padding: 5px 10px; border-radius: 5px; text-decoration: none; font-weight: bold;">Voir</a>

            <a href="{{ route('recipes.edit', $recipe->id) }}" style="display: inline-block; margin-right: 5px; color: #fff; background-color: #cc5500; padding: 5px 10px; border-radius: 5px; text-decoration: none; font-weight: bold;">Modifier</a>

            <form action="{{ route('recipes.destroy', $recipe->id) }}" method="POST" style="display: inline-block;">
                @csrf
                @method('DELETE')
                <button type="submit" style="background-color: #766c65; color: #fff; border: none; padding: 5px 10px; border-radius: 5px; font-weight: bold; cursor: pointer;" onclick="return confirm('Voulez-vous vraiment supprimer cette recette ?')">Supprimer</button>
            </form>
        </div>
    </div>
    @endforeach
</div>
@endsection
