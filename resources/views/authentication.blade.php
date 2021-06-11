@extends('layout')

@section('content')


<div class='body'>
<h4 style='margin-bottom: 1.5rem;margin-top: 1.5rem;'>Veuillez entrer votre identifiant client : </h4>
<form action='/client' method='post'>
{{ csrf_field() }}
    <div class='input-group mb-3'>
        <input type='number' name='id' required min='1' class='form-control' placeholder='Identifiant'>
    </div>
    <button type='submit' class='btn btn-primary'>Connexion</button>
</form>
</div>
@endsection