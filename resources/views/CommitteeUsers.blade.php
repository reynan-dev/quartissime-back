@extends('layouts.app')

@section('content')

<div class="row">
    <h1>Comité de quartier {{ $committee_user->name }}</h1>
    <p>Nom du président: {{ $committee_user->president_name }}</p>
    <p>E-mail: {{ $committee_user->email }}</p>
    <p>Tel: {{ $committee_user->tel }}</p>
    <p>Description: {{ $committee_user->description }}</p>
</div>
    
@endsection