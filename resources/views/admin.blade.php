@extends('layout')

@section('content')


<div class='body'>


<table class='table'>
    <tr>
        <th>Moyenne : <span class='badge bg-secondary'>{{$average}}</span></th>
        <th>NPS : <span class='badge bg-secondary'>{{$NPS}}</span></th>
    </tr>
</table>


<script src='https://cdn.jsdelivr.net/npm/chart.js'></script>

@if (!(($stats['detracteurs'] == '0') && ($stats['passifs'] == '0') && ($stats['promoteurs'] == '0')))
  <div style='display: flex; margin:0 auto; width:300px;'>
    <canvas id='myChart'></canvas>
  </div>
@endif

<script>
  Chart.defaults.plugins.legend.position ='right';
const data = {
  labels: [
    'Détracteurs',
    'Passifs',
    'Promoteurs'
  ],
  position: 'right',
  datasets: [{
    label: 'My First Dataset',
    data: [{{$stats['detracteurs']}}, {{$stats['passifs']}}, {{$stats['promoteurs']}}],
    backgroundColor: [
      'rgb(255, 99, 132)',
      'rgb(255, 205, 86)',
      'rgb(54, 162, 235)'
    ],
    hoverOffset: 4

  }]
};
const config = {
  type: 'doughnut',
  data: data,
};

  var myChart = new Chart(
    document.getElementById('myChart'),
    config
  );
</script>

<p style='margin-bottom: 1.5rem'>Le Net Promoter Score est un indice qui permet de mesurer la satisfaction d'une marque, 
d'un produit ou d'un service. Il est calculé à partir de l’intention de recommandation d'un produit, 
d'un service, d'une marque ou d'une entreprise. 
<a target='_blank' href='https://www.bluenote-systems.com/faq-crm-sugarcrm/nps-definition-utilisation.html'>plus d'info</a></p>
<table class='table table-hover' style='margin-bottom: 1.5rem;'>
  <tr>
    <th scope='col'>ID</th>
    <th scope='col'>Note</th>
    <th scope='col'>Date</th>
    <th scope='col'>Actions</th>
  </tr>
    @foreach($notes as $note)
    <tr>
        <th scope='row'>{{$note->id}}</th>
        <td>{{$note->rating}}</td>
        <td>{{$note->updated_at}}</td>
        <td>
            <form action="/admin/delete" method='post'>
              {{ csrf_field() }}
                <button type='submit' class='btn btn-outline-danger btn-sm'>supprimer</button>
                <input type="hidden" value="{{ $note->id }}" name="id">
            </form>
        </td>
        </tr>
    @endforeach
</table>


@if (!(($stats['detracteurs'] == '0') && ($stats['passifs'] == '0') && ($stats['promoteurs'] == '0')))
  <div class='d-grid gap-2 col-6 mx-auto'>
  <button style='margin-bottom: 2rem;' type='button' class='btn btn-danger' data-bs-toggle='modal' data-bs-target='#staticBackdrop'>
    Supprimer tout
  </button>
  </div>
@endif

<!-- Modal -->
<div class='modal fade' id='staticBackdrop' data-bs-backdrop='static' data-bs-keyboard='false' tabindex='-1' aria-labelledby='staticBackdropLabel' aria-hidden='true'>
  <div class='modal-dialog'>
    <div class='modal-content'>
      <div class='modal-header'>
        <h5 class='modal-title' id='staticBackdropLabel'>Suppression des notes</h5>
        <button type='button' class='btn-close' data-bs-dismiss='modal' aria-label='Close'></button>
      </div>
      <div class='modal-body'>
        Êtes-vous sûr?
      </div>
      <div class='modal-footer'>
        <button type='button' class='btn btn-secondary' data-bs-dismiss='modal'>Close</button>
        <form method='post' action='/admin/deleteAll'>
          {{ csrf_field() }}
            <div>
                <input type='submit' class='btn btn-danger' value='Supprimer tout'>
            </div>
        </form>
      </div>
    </div>
  </div>
</div>
</div>
@endsection