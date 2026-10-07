@extends('layouts.app')
@section('title', $recipe->title)

@section('content')
<div class="max-w-3xl mx-auto bg-white p-6 rounded shadow">
    <h1 class="text-3xl font-bold main-color mb-4">{{ $recipe->title }}</h1>
    @if($recipe->image)
        <img src="{{ asset('storage/' . $recipe->image) }}" class="w-full h-64 object-cover rounded mb-4">
    @endif
    <h2 class="text-xl font-bold main-color">Ingrédients</h2>
    <p>{{ $recipe->ingredients }}</p>
    <h2 class="text-xl font-bold main-color mt-4">Description</h2>
    <p>{{ $recipe->description }}</p>
    @if(auth()->check())
<form method="POST" action="{{ route('comments.store', $recipe->id) }}" class="mt-4">
    @csrf
    <textarea name="content" class="w-full p-2 border rounded mb-2" placeholder="Ajouter un commentaire"></textarea>
    <button type="submit" style="background-color: #CC5500; color: white; border: none; padding: 10px 20px; border-radius: 8px; font-weight: bold; cursor: pointer;">Envoyer</button>
</form>
@endif

@include('comments.comments', ['comments' => $recipe->comments])

</div>
@endsection
