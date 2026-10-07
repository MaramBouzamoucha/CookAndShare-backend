@extends('layouts.app')
@section('title', isset($recipe) ? 'Modifier Recette' : 'Créer Recette')

@section('content')
<div class="max-w-md mx-auto bg-white p-6 rounded shadow">
    <h1 class="text-2xl font-bold main-color mb-4">
        {{ isset($recipe) ? 'Modifier Recette' : 'Créer Recette' }}
    </h1>
    <form method="POST" action="{{ isset($recipe) ? route('recipes.update', $recipe->id) : route('recipes.store') }}" enctype="multipart/form-data">
        @csrf
        @if(isset($recipe))
            @method('PUT')
        @endif
        <div class="mb-4">
            <label class="block font-bold main-color">Titre</label>
            <input type="text" name="title" value="{{ $recipe->title ?? '' }}" class="w-full p-2 border rounded">
        </div>
        <div class="mb-4">
            <label class="block font-bold main-color">Description</label>
            <textarea name="description" class="w-full p-2 border rounded">{{ $recipe->description ?? '' }}</textarea>
        </div>
        <div class="mb-4">
            <label class="block font-bold main-color">Ingrédients</label>
            <textarea name="ingredients" class="w-full p-2 border rounded">{{ $recipe->ingredients ?? '' }}</textarea>
        </div>
        <div class="mb-4">
            <label class="block font-bold main-color">Image</label>
            <input type="file" name="image" class="w-full p-2 border rounded">
        </div>
        <div class="mb-4">
            <label class="block font-bold main-color">Catégorie</label>
            <select name="category_id" class="w-full p-2 border rounded">
                @foreach($categories as $category)
                    <option value="{{ $category->id }}" @if(isset($recipe) && $recipe->category_id == $category->id) selected @endif>
                        {{ $category->name }}
                    </option>
                @endforeach
            </select>
        </div>
       <button type="submit" style="background-color: #CC5500" class="text-white px-4 py-2 rounded">
    {{ isset($recipe) ? 'Mettre à jour' : 'Créer' }}
</button>

    </form>
</div>
@endsection
