@extends('layout')


@section('content')
<div class="body">
<h2 style='margin-bottom: 1.5rem;margin-top: 1.5rem;'>Se connecter</h2>
<form action='/connection' method='post'>
{{ csrf_field() }}
    <div class='mb-3'>
        <input type='text' name='login' required class='form-control{{$logError}}' id="input" placeholder='Identifiant'>
        @if ($logError != '')
            <div id="input" class="invalid-feedback">
                Identifiant ou mot de passe incorrect.
            </div>
        @endif
    </div>
    <div class='mb-3'>
        <input type='password' name='password' required class='form-control{{$logError}}' id="input" placeholder='Mot de passe'>
        @if ($logError != '')
            <div class="invalid-feedback">
                Identifiant ou mot de passe incorrect.
            </div>
        @endif
    </div>
    <button type='submit' class='btn btn-primary'>Connexion</button>
</form>
</div>
@endsection
