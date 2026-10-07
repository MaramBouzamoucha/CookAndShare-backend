@extends('layouts.app')
@section('title', 'Inscription')

@section('content')
<h1 style="color:#CC5500; font-weight:bold; font-size:2rem; margin-bottom:20px;">Inscription</h1>

@if ($errors->any())
    <div style="color:red; margin-bottom:10px;">
        <ul>
            @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
@endif

<form method="POST" action="{{ route('registerBlade') }}">
    @csrf
    <div>
        <label style="color:#CC5500;">Nom :</label>
        <input type="text" name="name" value="{{ old('name') }}" required class="border p-2 rounded w-full">
    </div>
    <div class="mt-4">
        <label style="color:#CC5500;">Email :</label>
        <input type="email" name="email" value="{{ old('email') }}" required class="border p-2 rounded w-full">
    </div>
    <div class="mt-4">
        <label style="color:#CC5500;">Mot de passe :</label>
        <input type="password" name="password" required class="border p-2 rounded w-full">
    </div>
    <button type="submit" style="background:#CC5500; color:white; font-weight:bold; padding:10px 20px; margin-top:10px; border:none; border-radius:5px;">S’inscrire</button>
</form>
<p class="mt-4">Déjà inscrit ? <a href="{{ route('loginForm') }}" style="color:#CC5500; font-weight:bold;">Se connecter</a></p>
@endsection
