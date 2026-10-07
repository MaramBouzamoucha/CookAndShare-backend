@extends('layouts.app')
@section('title', 'Profil')

@section('content')
<h1 style="color:#CC5500; font-weight:bold; font-size:2rem; margin-bottom:20px;">Profil</h1>

<p><strong style="color:#CC5500;">Nom :</strong> {{ $user->name }}</p>
<p><strong style="color:#CC5500;">Email :</strong> {{ $user->email }}</p>

<form method="POST" action="{{ route('logoutBlade') }}">
    @csrf
    <button type="submit" style="background:#CC5500; color:white; font-weight:bold; padding:10px 20px; margin-top:20px; border:none; border-radius:5px;">Se déconnecter</button>
</form>
@endsection

