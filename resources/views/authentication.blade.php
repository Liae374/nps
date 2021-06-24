@extends('layout')

@section('content')
<div class="body">
    <h4 style="margin-bottom: 1.5rem;margin-top: 1.5rem;">Veuillez entrer votre identifiant client : </h4>
    <form action="{{ route('client') }}" method="post">
        {{ csrf_field() }}
        <div class="mb-3">
            <input type="teext" id="email" name="email" required class="form-control @error('login') is-invalid @enderror" placeholder="Email">
            @error('login')
                <div id="email" class="invalid-feedback">
                    Adresse mail incorrecte.
                </div>
            @enderror
        </div>
        <button type="submit" class="btn btn-primary">Connexion</button>
    </form>
</div>
@endsection
