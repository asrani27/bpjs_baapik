@extends('layouts.app')

@push('css')
<link rel="stylesheet" href="https://code.ionicframework.com/ionicons/2.0.1/css/ionicons.min.css">
<link rel="stylesheet" href="/admin/plugins/tempusdominus-bootstrap-4/css/tempusdominus-bootstrap-4.min.css">
@endpush
@section('title')
<strong>BERANDA</strong>
@endsection
@section('content')
<br />
<div class="row">
    <div class="col-lg-12">
        <div class="card">
            <div class="card-header">
                <div class="user-block">
                    <span class="username"><a href="#">STATUS BRIDGING BPJS</a>
                        @if (Auth::user()->is_connect == 0)
                        <span class="badge badge-danger">Not Connected</span>
                        @else
                        <span class="badge badge-success">Connected</span>
                        @endif</span>
                    <span class="description">Jika Tidak terkoneksi dengan bpjs, silahkan klik <a
                            href="/setting/data/bpjs">disini</a></span>
                </div>
            </div>
        </div>
    </div>
</div>

<div class="row text-center">
    <div class="col-sm-12">
        <h1>{{\Carbon\Carbon::now()->format('d M Y')}}</h1>
        <a href="/daftarantrian" class="btn btn-primary">DAFTAR ANTRIAN</a><br /><br />
    </div>
</div>
<div class="row">
    <div class="col-md-3">
        <div class="card card-primary">
            <div class="card-header">
                <h3 class="card-title">ANTRIAN POLI UMUM</h3>

                <div class="card-tools">
                    <button type="button" class="btn btn-tool" data-card-widget="collapse"><i class="fas fa-minus"></i>
                    </button>
                </div>
                <!-- /.card-tools -->
            </div>
            <!-- /.card-header -->
            <div class="card-body" style="display: block;">
                <table class="table table-sm table-bordered">
                    <thead>
                        <tr style="font-size: 11px">
                            <th>No</th>
                            <th>Nama</th>
                            <th>Poli</th>
                            <th>Status</th>
                            <th>#</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($umum as $item)
                        <tr style="font-size: 11px">
                            <td>{{$item->nomor_antrian}}</td>
                            <td>{{$item->nama}}</td>
                            <td>{{$item->nmPoli}}</td>
                            <td>
                                @if ($item->status == 0)
                                <span class="badge badge-info">menunggu</span>
                                @elseif ($item->status == 1)
                                <span class="badge badge-danger">Di Panggil</span>
                                @elseif ($item->status == 2)
                                <span class="badge badge-danger">Sedang Di Periksa</span>
                                @elseif ($item->status == 3)
                                <span class="badge badge-success">selesai</span>
                                @elseif ($item->status == 4)
                                <span class="badge badge-warning">di lewati</span>
                                @endif
                            </td>
                            <td>
                                <div class="btn-group">
                                    <button type="button" class="btn btn-xs dropdown-toggle" data-toggle="dropdown">
                                    </button>
                                    <ul class="dropdown-menu">
                                        @if ($item->status == 0)
                                        <li><a class="dropdown-item" href="/panggil/{{$item->id}}">Panggil</a></li>
                                        @elseif ($item->status == 1)
                                        <li><a class="dropdown-item" href="/periksa/{{$item->id}}">Periksa</a></li>
                                        <li><a class="dropdown-item" href="/selesai/{{$item->id}}">Selesai</a></li>
                                        <li><a class="dropdown-item" href="/lewati/{{$item->id}}">Lewati</a></li>
                                        @elseif($item->status == 2)
                                        <li><a class="dropdown-item" href="/selesai/{{$item->id}}">Selesai</a></li>
                                        <li><a class="dropdown-item" href="/lewati/{{$item->id}}">Lewati</a></li>
                                        @else
                                        <li><a class="dropdown-item" href="/lewati/{{$item->id}}">Lewati</a></li>
                                        @endif
                                    </ul>
                                </div>
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
            <!-- /.card-body -->
        </div>
        <!-- /.card -->
    </div>
    <div class="col-md-3">
        <div class="card card-primary">
            <div class="card-header">
                <h3 class="card-title">ANTRIAN POLI LANSIA</h3>

                <div class="card-tools">
                    <button type="button" class="btn btn-tool" data-card-widget="collapse"><i class="fas fa-minus"></i>
                    </button>
                </div>
                <!-- /.card-tools -->
            </div>
            <!-- /.card-header -->
            <div class="card-body" style="display: block;">
                <table class="table table-sm table-bordered">
                    <thead>
                        <tr style="font-size: 11px">
                            <th>No</th>
                            <th>Nama</th>
                            <th>Poli</th>
                            <th>Status</th>
                            <th>#</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($lansia as $item)
                        <tr style="font-size: 11px">
                            <td>{{$item->nomor_antrian}}</td>
                            <td>{{$item->nama}}</td>
                            <td>{{$item->nmPoli}}</td>
                            <td>
                                @if ($item->status == 0)
                                <span class="badge badge-info">menunggu</span>
                                @elseif ($item->status == 1)
                                <span class="badge badge-danger">Di Panggil</span>
                                @elseif ($item->status == 2)
                                <span class="badge badge-danger">Sedang Di Periksa</span>
                                @elseif ($item->status == 3)
                                <span class="badge badge-success">selesai</span>
                                @elseif ($item->status == 4)
                                <span class="badge badge-warning">di lewati</span>
                                @endif
                            </td>
                            <td>
                                <div class="btn-group">
                                    <button type="button" class="btn btn-xs dropdown-toggle" data-toggle="dropdown">
                                    </button>
                                    <ul class="dropdown-menu">
                                        @if ($item->status == 0)
                                        <li><a class="dropdown-item" href="/panggil/{{$item->id}}">Panggil</a></li>
                                        @elseif ($item->status == 1)
                                        <li><a class="dropdown-item" href="/periksa/{{$item->id}}">Periksa</a></li>
                                        <li><a class="dropdown-item" href="/selesai/{{$item->id}}">Selesai</a></li>
                                        <li><a class="dropdown-item" href="/lewati/{{$item->id}}">Lewati</a></li>
                                        @elseif($item->status == 2)
                                        <li><a class="dropdown-item" href="/selesai/{{$item->id}}">Selesai</a></li>
                                        <li><a class="dropdown-item" href="/lewati/{{$item->id}}">Lewati</a></li>
                                        @else
                                        <li><a class="dropdown-item" href="/lewati/{{$item->id}}">Lewati</a></li>
                                        @endif
                                    </ul>
                                </div>
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
            <!-- /.card-body -->
        </div>
        <!-- /.card -->
    </div>
    <div class="col-md-3">
        <div class="card card-primary">
            <div class="card-header">
                <h3 class="card-title">ANTRIAN POLI GIGI & MULUT</h3>

                <div class="card-tools">
                    <button type="button" class="btn btn-tool" data-card-widget="collapse"><i class="fas fa-minus"></i>
                    </button>
                </div>
                <!-- /.card-tools -->
            </div>
            <!-- /.card-header -->
            <div class="card-body" style="display: block;">
                <table class="table table-sm table-bordered">
                    <thead>
                        <tr style="font-size: 11px">
                            <th>No</th>
                            <th>Nama</th>
                            <th>Poli</th>
                            <th>Status</th>
                            <th>#</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($gigi as $item)
                        <tr style="font-size: 11px">
                            <td>{{$item->nomor_antrian}}</td>
                            <td>{{$item->nama}}</td>
                            <td>{{$item->nmPoli}}</td>
                            <td>
                                @if ($item->status == 0)
                                <span class="badge badge-info">menunggu</span>
                                @elseif ($item->status == 1)
                                <span class="badge badge-danger">Di Panggil</span>
                                @elseif ($item->status == 2)
                                <span class="badge badge-danger">Sedang Di Periksa</span>
                                @elseif ($item->status == 3)
                                <span class="badge badge-success">selesai</span>
                                @elseif ($item->status == 4)
                                <span class="badge badge-warning">di lewati</span>
                                @endif
                            </td>
                            <td>
                                <div class="btn-group">
                                    <button type="button" class="btn btn-xs dropdown-toggle" data-toggle="dropdown">
                                    </button>
                                    <ul class="dropdown-menu">
                                        @if ($item->status == 0)
                                        <li><a class="dropdown-item" href="/panggil/{{$item->id}}">Panggil</a></li>
                                        @elseif ($item->status == 1)
                                        <li><a class="dropdown-item" href="/periksa/{{$item->id}}">Periksa</a></li>
                                        <li><a class="dropdown-item" href="/selesai/{{$item->id}}">Selesai</a></li>
                                        <li><a class="dropdown-item" href="/lewati/{{$item->id}}">Lewati</a></li>
                                        @elseif($item->status == 2)
                                        <li><a class="dropdown-item" href="/selesai/{{$item->id}}">Selesai</a></li>
                                        <li><a class="dropdown-item" href="/lewati/{{$item->id}}">Lewati</a></li>
                                        @else
                                        <li><a class="dropdown-item" href="/lewati/{{$item->id}}">Lewati</a></li>
                                        @endif
                                    </ul>
                                </div>
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
            <!-- /.card-body -->
        </div>
        <!-- /.card -->
    </div>
    <div class="col-md-3">
        <div class="card card-primary">
            <div class="card-header">
                <h3 class="card-title">ANTRIAN POLI KIA</h3>

                <div class="card-tools">
                    <button type="button" class="btn btn-tool" data-card-widget="collapse"><i class="fas fa-minus"></i>
                    </button>
                </div>
                <!-- /.card-tools -->
            </div>
            <!-- /.card-header -->
            <div class="card-body" style="display: block;">
                <table class="table table-sm table-bordered">
                    <thead>
                        <tr style="font-size: 11px">
                            <th>No</th>
                            <th>Nama</th>
                            <th>Poli</th>
                            <th>Status</th>
                            <th>#</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($kia as $item)
                        <tr style="font-size: 11px">
                            <td>{{$item->nomor_antrian}}</td>
                            <td>{{$item->nama}}</td>
                            <td>{{$item->nmPoli}}</td>
                            <td>
                                @if ($item->status == 0)
                                <span class="badge badge-info">menunggu</span>
                                @elseif ($item->status == 1)
                                <span class="badge badge-danger">Di Panggil</span>
                                @elseif ($item->status == 2)
                                <span class="badge badge-danger">Sedang Di Periksa</span>
                                @elseif ($item->status == 3)
                                <span class="badge badge-success">selesai</span>
                                @elseif ($item->status == 4)
                                <span class="badge badge-warning">di lewati</span>
                                @endif
                            </td>
                            <td>
                                <div class="btn-group">
                                    <button type="button" class="btn btn-xs dropdown-toggle" data-toggle="dropdown">
                                    </button>
                                    <ul class="dropdown-menu">
                                        @if ($item->status == 0)
                                        <li><a class="dropdown-item" href="/panggil/{{$item->id}}">Panggil</a></li>
                                        @elseif ($item->status == 1)
                                        <li><a class="dropdown-item" href="/periksa/{{$item->id}}">Periksa</a></li>
                                        <li><a class="dropdown-item" href="/selesai/{{$item->id}}">Selesai</a></li>
                                        <li><a class="dropdown-item" href="/lewati/{{$item->id}}">Lewati</a></li>
                                        @elseif($item->status == 2)
                                        <li><a class="dropdown-item" href="/selesai/{{$item->id}}">Selesai</a></li>
                                        <li><a class="dropdown-item" href="/lewati/{{$item->id}}">Lewati</a></li>
                                        @else
                                        <li><a class="dropdown-item" href="/lewati/{{$item->id}}">Lewati</a></li>
                                        @endif
                                    </ul>
                                </div>
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
            <!-- /.card-body -->
        </div>
        <!-- /.card -->
    </div>
</div>

<div class="row">
    <div class="col-md-3">
        <div class="card card-primary">
            <div class="card-header">
                <h3 class="card-title">ANTRIAN LAB</h3>

                <div class="card-tools">
                    <button type="button" class="btn btn-tool" data-card-widget="collapse"><i class="fas fa-minus"></i>
                    </button>
                </div>
                <!-- /.card-tools -->
            </div>
            <!-- /.card-header -->
            <div class="card-body" style="display: block;">
                <table class="table table-sm table-bordered">
                    <thead>
                        <tr style="font-size: 11px">
                            <th>No</th>
                            <th>Nama</th>
                            <th>Poli</th>
                            <th>Status</th>
                            <th>#</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($lab as $item)
                        <tr style="font-size: 11px">
                            <td>{{$item->nomor_antrian}}</td>
                            <td>{{$item->nama}}</td>
                            <td>{{$item->nmPoli}}</td>
                            <td>
                                @if ($item->status == 0)
                                <span class="badge badge-info">menunggu</span>
                                @elseif ($item->status == 1)
                                <span class="badge badge-danger">Di Panggil</span>
                                @elseif ($item->status == 2)
                                <span class="badge badge-danger">Sedang Di Periksa</span>
                                @elseif ($item->status == 3)
                                <span class="badge badge-success">selesai</span>
                                @elseif ($item->status == 4)
                                <span class="badge badge-warning">di lewati</span>
                                @endif
                            </td>
                            <td>
                                <div class="btn-group">
                                    <button type="button" class="btn btn-xs dropdown-toggle" data-toggle="dropdown">
                                    </button>
                                    <ul class="dropdown-menu">
                                        @if ($item->status == 0)
                                        <li><a class="dropdown-item" href="/panggil/{{$item->id}}">Panggil</a></li>
                                        @elseif ($item->status == 1)
                                        <li><a class="dropdown-item" href="/periksa/{{$item->id}}">Periksa</a></li>
                                        <li><a class="dropdown-item" href="/selesai/{{$item->id}}">Selesai</a></li>
                                        <li><a class="dropdown-item" href="/lewati/{{$item->id}}">Lewati</a></li>
                                        @elseif($item->status == 2)
                                        <li><a class="dropdown-item" href="/selesai/{{$item->id}}">Selesai</a></li>
                                        <li><a class="dropdown-item" href="/lewati/{{$item->id}}">Lewati</a></li>
                                        @else
                                        <li><a class="dropdown-item" href="/lewati/{{$item->id}}">Lewati</a></li>
                                        @endif
                                    </ul>
                                </div>
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
            <!-- /.card-body -->
        </div>
        <!-- /.card -->
    </div>
    <div class="col-md-3">
        <div class="card card-primary">
            <div class="card-header">
                <h3 class="card-title">ANTRIAN POLI HOME VISIT</h3>

                <div class="card-tools">
                    <button type="button" class="btn btn-tool" data-card-widget="collapse"><i class="fas fa-minus"></i>
                    </button>
                </div>
                <!-- /.card-tools -->
            </div>
            <!-- /.card-header -->
            <div class="card-body" style="display: block;">
                <table class="table table-sm table-bordered">
                    <thead>
                        <tr style="font-size: 11px">
                            <th>No</th>
                            <th>Nama</th>
                            <th>Poli</th>
                            <th>Status</th>
                            <th>#</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($hv as $item)
                        <tr style="font-size: 11px">
                            <td>{{$item->nomor_antrian}}</td>
                            <td>{{$item->nama}}</td>
                            <td>{{$item->nmPoli}}</td>
                            <td>
                                @if ($item->status == 0)
                                <span class="badge badge-info">menunggu</span>
                                @elseif ($item->status == 1)
                                <span class="badge badge-danger">Di Panggil</span>
                                @elseif ($item->status == 2)
                                <span class="badge badge-danger">Sedang Di Periksa</span>
                                @elseif ($item->status == 3)
                                <span class="badge badge-success">selesai</span>
                                @elseif ($item->status == 4)
                                <span class="badge badge-warning">di lewati</span>
                                @endif
                            </td>
                            <td>
                                <div class="btn-group">
                                    <button type="button" class="btn btn-xs dropdown-toggle" data-toggle="dropdown">
                                    </button>
                                    <ul class="dropdown-menu">
                                        @if ($item->status == 0)
                                        <li><a class="dropdown-item" href="/panggil/{{$item->id}}">Panggil</a></li>
                                        @elseif ($item->status == 1)
                                        <li><a class="dropdown-item" href="/periksa/{{$item->id}}">Periksa</a></li>
                                        <li><a class="dropdown-item" href="/selesai/{{$item->id}}">Selesai</a></li>
                                        <li><a class="dropdown-item" href="/lewati/{{$item->id}}">Lewati</a></li>
                                        @elseif($item->status == 2)
                                        <li><a class="dropdown-item" href="/selesai/{{$item->id}}">Selesai</a></li>
                                        <li><a class="dropdown-item" href="/lewati/{{$item->id}}">Lewati</a></li>
                                        @else
                                        <li><a class="dropdown-item" href="/lewati/{{$item->id}}">Lewati</a></li>
                                        @endif
                                    </ul>
                                </div>
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
            <!-- /.card-body -->
        </div>
        <!-- /.card -->
    </div>
    <div class="col-md-3">
        <div class="card card-primary">
            <div class="card-header">
                <h3 class="card-title">ANTRIAN POLI KONSELING</h3>

                <div class="card-tools">
                    <button type="button" class="btn btn-tool" data-card-widget="collapse"><i class="fas fa-minus"></i>
                    </button>
                </div>
                <!-- /.card-tools -->
            </div>
            <!-- /.card-header -->
            <div class="card-body" style="display: block;">
                <table class="table table-sm table-bordered">
                    <thead>
                        <tr style="font-size: 11px">
                            <th>No</th>
                            <th>Nama</th>
                            <th>Poli</th>
                            <th>Status</th>
                            <th>#</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($konseling as $item)
                        <tr style="font-size: 11px">
                            <td>{{$item->nomor_antrian}}</td>
                            <td>{{$item->nama}}</td>
                            <td>{{$item->nmPoli}}</td>
                            <td>
                                @if ($item->status == 0)
                                <span class="badge badge-info">menunggu</span>
                                @elseif ($item->status == 1)
                                <span class="badge badge-danger">Di Panggil</span>
                                @elseif ($item->status == 2)
                                <span class="badge badge-danger">Sedang Di Periksa</span>
                                @elseif ($item->status == 3)
                                <span class="badge badge-success">selesai</span>
                                @elseif ($item->status == 4)
                                <span class="badge badge-warning">di lewati</span>
                                @endif
                            </td>
                            <td>
                                <div class="btn-group">
                                    <button type="button" class="btn btn-xs dropdown-toggle" data-toggle="dropdown">
                                    </button>
                                    <ul class="dropdown-menu">
                                        @if ($item->status == 0)
                                        <li><a class="dropdown-item" href="/panggil/{{$item->id}}">Panggil</a></li>
                                        @elseif ($item->status == 1)
                                        <li><a class="dropdown-item" href="/periksa/{{$item->id}}">Periksa</a></li>
                                        <li><a class="dropdown-item" href="/selesai/{{$item->id}}">Selesai</a></li>
                                        <li><a class="dropdown-item" href="/lewati/{{$item->id}}">Lewati</a></li>
                                        @elseif($item->status == 2)
                                        <li><a class="dropdown-item" href="/selesai/{{$item->id}}">Selesai</a></li>
                                        <li><a class="dropdown-item" href="/lewati/{{$item->id}}">Lewati</a></li>
                                        @else
                                        <li><a class="dropdown-item" href="/lewati/{{$item->id}}">Lewati</a></li>
                                        @endif
                                    </ul>
                                </div>
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
            <!-- /.card-body -->
        </div>
        <!-- /.card -->
    </div>
    <div class="col-md-3">
        <div class="card card-primary">
            <div class="card-header">
                <h3 class="card-title">ANTRIAN KUNJUNGAN ONLINE</h3>

                <div class="card-tools">
                    <button type="button" class="btn btn-tool" data-card-widget="collapse"><i class="fas fa-minus"></i>
                    </button>
                </div>
                <!-- /.card-tools -->
            </div>
            <!-- /.card-header -->
            <div class="card-body" style="display: block;">
                <table class="table table-sm table-bordered">
                    <thead>
                        <tr style="font-size: 11px">
                            <th>No</th>
                            <th>Nama</th>
                            <th>Poli</th>
                            <th>Status</th>
                            <th>#</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($ko as $item)
                        <tr style="font-size: 11px">
                            <td>{{$item->nomor_antrian}}</td>
                            <td>{{$item->nama}}</td>
                            <td>{{$item->nmPoli}}</td>
                            <td>
                                @if ($item->status == 0)
                                <span class="badge badge-info">menunggu</span>
                                @elseif ($item->status == 1)
                                <span class="badge badge-danger">Di Panggil</span>
                                @elseif ($item->status == 2)
                                <span class="badge badge-danger">Sedang Di Periksa</span>
                                @elseif ($item->status == 3)
                                <span class="badge badge-success">selesai</span>
                                @elseif ($item->status == 4)
                                <span class="badge badge-warning">di lewati</span>
                                @endif
                            </td>
                            <td>
                                <div class="btn-group">
                                    <button type="button" class="btn btn-xs dropdown-toggle" data-toggle="dropdown">
                                    </button>
                                    <ul class="dropdown-menu">
                                        @if ($item->status == 0)
                                        <li><a class="dropdown-item" href="/panggil/{{$item->id}}">Panggil</a></li>
                                        @elseif ($item->status == 1)
                                        <li><a class="dropdown-item" href="/periksa/{{$item->id}}">Periksa</a></li>
                                        <li><a class="dropdown-item" href="/selesai/{{$item->id}}">Selesai</a></li>
                                        <li><a class="dropdown-item" href="/lewati/{{$item->id}}">Lewati</a></li>
                                        @elseif($item->status == 2)
                                        <li><a class="dropdown-item" href="/selesai/{{$item->id}}">Selesai</a></li>
                                        <li><a class="dropdown-item" href="/lewati/{{$item->id}}">Lewati</a></li>
                                        @else
                                        <li><a class="dropdown-item" href="/lewati/{{$item->id}}">Lewati</a></li>
                                        @endif
                                    </ul>
                                </div>
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
            <!-- /.card-body -->
        </div>
        <!-- /.card -->
    </div>
</div>
@endsection

@push('js')

@endpush