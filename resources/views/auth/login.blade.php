@extends('layouts.app')
@section('title', 'Connexion')

@section('content')
<h1 style="color:#CC5500; font-weight:bold; font-size:2rem; margin-bottom:20px;">Connexion</h1>

@if ($errors->any())
    <div style="color:red; margin-bottom:10px;">
        <ul>
            @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
@endif

@if(session('success'))
    <div style="color:green; margin-bottom:10px;">{{ session('success') }}</div>
@endif

<form method="POST" action="{{ route('loginBlade') }}">
    @csrf
    <div>
        <label style="color:#CC5500;">Email :</label>
        <input type="email" name="email" value="{{ old('email') }}" required class="border p-2 rounded w-full">
    </div>
    <div class="mt-4">
        <label style="color:#CC5500;">Mot de passe :</label>
        <input type="password" name="password" required class="border p-2 rounded w-full">
    </div>
    <button type="submit" style="background:#CC5500; color:white; font-weight:bold; padding:10px 20px; margin-top:10px; border:none; border-radius:5px;">Se connecter</button>
</form>
<p class="mt-4">Pas encore inscrit ? <a href="{{ route('registerForm') }}" style="color:#CC5500; font-weight:bold;">Créer un compte</a></p>
@endsection
