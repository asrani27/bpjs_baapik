@extends('layouts.app')

@push('css')
<link rel="stylesheet" href="https://code.ionicframework.com/ionicons/2.0.1/css/ionicons.min.css">
<link rel="stylesheet" href="/admin/plugins/tempusdominus-bootstrap-4/css/tempusdominus-bootstrap-4.min.css">
@endpush
@section('title')
<strong>STATISTIK</strong>
@endsection
@section('content')
<br />
<div class="row">
    <div class="col-md-12">
        <div class="card card-info">
            <div class="card-header">
                <h3 class="card-title">Pasien / Ruangan Bulan {{\Carbon\Carbon::today()->format('M Y')}}</h3>
                <div class="card-tools">
                    <button type="button" class="btn btn-tool" data-card-widget="collapse"><i class="fas fa-minus"></i>
                    </button>
                </div>
            </div>
            <div class="card-body">
                <div class="chart">
                    <canvas id="barChart"></canvas>
                </div>
            </div>
        </div>
        <div id="namaPoli" data-info="{{$ruangan}}" data-jumlah="{{$jml}}">
        </div>
    </div>
</div>

@endsection

@push('js')

<script src="/admin/plugins/chart.js/Chart.min.js"></script>
<script>
    var myDiv = document.querySelector('#namaPoli');
var ruangan = JSON.parse(myDiv.dataset.info);
var jumlah = JSON.parse(myDiv.dataset.jumlah);

var popCanvas = document.getElementById("barChart");
var barChart = new Chart(popCanvas, {
  type: 'bar',
  data: {
    labels: ruangan,
    datasets: [{
      label: 'Pasien',
      data: jumlah,
      backgroundColor: [
        'rgba(255, 99, 132, 0.6)',
        'rgba(54, 162, 235, 0.6)',
        'rgba(255, 206, 86, 0.6)',
        'rgba(75, 192, 192, 0.6)',
        'rgba(153, 102, 255, 0.6)',
        'rgba(255, 159, 64, 0.6)',
        'rgba(255, 99, 132, 0.6)',
        'rgba(54, 162, 235, 0.6)',
        'rgba(255, 206, 86, 0.6)',
        'rgba(75, 192, 192, 0.6)',
        'rgba(75, 192, 192, 0.6)',
        'rgba(153, 102, 255, 0.6)',
        'rgba(255, 159, 64, 0.6)',
        'rgba(255, 99, 132, 0.6)',
        'rgba(54, 162, 235, 0.6)',
        'rgba(255, 206, 86, 0.6)',
        'rgba(75, 192, 192, 0.6)',
        'rgba(153, 102, 255, 0.6)'
      ]
    }]
  }
});
</script>
@endpush