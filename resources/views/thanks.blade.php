@extends('layout')

@section('content')
<h3 style="margin: 60px; text-align: center">Merci d'avoir participé!</h3>
<p style="text-align: center; margin-bottom: 1.5rem;">Votre note est de {{ $rating }}. Voulez-vous la modifier/supprimer?</p>

<div class="form-row text-center" style="margin: 15px 272px; align-items: center; ">
    <button type="button" style="margin:10px" class="btn btn-outline-primary" data-bs-toggle="modal" data-bs-target="#exampleModal">Modifier</button>
    <button type="button" style="margin:10px" class="btn btn-outline-danger" data-bs-toggle="modal" data-bs-target="#staticBackdrop">Supprimer</button>
</div>

<div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Modifier</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <form method="post" action="{{ route('client.update', [$id]) }}">
                {{ csrf_field() }}
                <div class="modal-body">
                    <div class="input-group">
                        <input type="number" required max="10" min="0" class="form-control" name="rating">
                        <input type="hidden" name="id" value="<?= $id ?>">
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Fermer</button>
                    <button type="submit" class="btn btn-primary">Envoyer</button>
                </div>
                <input type="hidden" name="id_client" value="{{ $id_client }}">
            </form>
        </div>
    </div>
</div>

<div class="modal fade" id="staticBackdrop" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="staticBackdropLabel">Suppression de la note</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                Êtes-vous sûr?
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Fermer</button>
                <form method="post" action="{{ route('client.destroy', [$id]) }}">
                    {{ csrf_field() }}
                    <div>
                        <input type="submit" class="btn btn-danger" value="Supprimer">
                    </div>
                    <input type="hidden" name="id" value={{ $id }}>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection
