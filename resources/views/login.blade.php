@extends('layout')


@section('content')
<div class="body">
    <h2 style="margin-bottom: 1.5rem;margin-top: 1.5rem;">Se connecter</h2>
    <form action="login" method="post">
    {{ csrf_field() }}
        <div class="mb-3">
            <input type="text" name="email" placeholder="Email" id="email" required class="form-control @error('login') is-invalid @enderror ">
        </div>
        <div class="mb-3">
            <input type="password" name="password" required class="form-control @error('login') is-invalid @enderror" id="input" placeholder="Mot de passe">
            @error('login')
                <div id="password" class="invalid-feedback">
                    Identifiant ou mot de passe incorrect.
                </div>
            @enderror
        </div>
        <button type="submit" class="btn btn-primary">Connexion</button>
    </form>
</div>
@endsection
