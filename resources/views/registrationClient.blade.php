@extends('layout')

@section('content')
<div class="body">
    <h2 style="margin-bottom: 1.5rem;margin-top: 1.5rem;">Nouveau Client</h2>
    <form action="{{ route('register-client') }}" method="post">
    {{ csrf_field() }}
        <div class="mb-3">
            <input type="text" name="name" placeholder="Nom" id="name" required class="form-control @error('name') is-invalid @enderror ">
        </div>
        <div class="mb-3">
            <input type="email" name="email" placeholder="Email" id="email" required class="form-control @error('email') is-invalid @enderror ">
            @if ($errors->has('email'))
                <span class="text-danger">L'adresse mail est déjà utilisée.</span>
            @endif
        </div>
        <button type="submit" class="btn btn-primary">Créer</button>
    </form>
</div>
@endsection