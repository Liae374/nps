@extends('layout')

@section('content')
<div class="body">
    <h3 style="margin: 3rem;text-align: center;">Quelle est la probabilité que vous recommandiez nos services à un proche?</h3>
    <form method="post" action="{{ route('client.thanks', [$id_client]) }}">
        {{ csrf_field() }}
        <fieldset @if(false) disabled @endif>
            <p class="infoLeft">Très peu probable</p>
            <p class="infoRight">Fort probable</p>
            <div class="rating" style="margin-left: 144px;margin-right: 144px;margin-bottom: 15px;">
                @for($i = 10; $i >= 1; $i--)  
                    <input type="radio" id="star{{ $i }}" name="rating" value="{{ $i }}"/>
                    <label for="star{{ $i }}">{{ $i }} stars</label>
                @endfor
            </div>
            <div class="form-row text-center">
                <button type="submit" class="btn btn-primary" value="Envoyer">Envoyer</button>
            </div>
        </fieldset>
        <input type="hidden" name="id_client" value="{{ $id_client }}">
    </form>
</div>
@endsection