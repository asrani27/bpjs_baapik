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
                        <tr>
                            <th>No</th>
                            <th>Nama</th>
                            <th>Poli</th>
                            <th>#</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($umum as $item)
                        <tr>
                            <td>{{$item->nomor_antrian}}</td>
                            <td>{{$item->nama}}</td>
                            <td>{{$item->nmPoli}}</td>
                            <td>#</td>
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
                        <tr>
                            <th>No</th>
                            <th>Nama</th>
                            <th>Poli</th>
                            <th>#</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($lansia as $item)
                        <tr>
                            <td>{{$item->nomor_antrian}}</td>
                            <td>{{$item->nama}}</td>
                            <td>{{$item->nmPoli}}</td>
                            <td>#</td>
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
                        <tr>
                            <th>No</th>
                            <th>Nama</th>
                            <th>Poli</th>
                            <th>#</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($gigi as $item)
                        <tr>
                            <td>{{$item->nomor_antrian}}</td>
                            <td>{{$item->nama}}</td>
                            <td>{{$item->nmPoli}}</td>
                            <td>#</td>
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
                        <tr>
                            <th>No</th>
                            <th>Nama</th>
                            <th>Poli</th>
                            <th>#</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($kia as $item)
                        <tr>
                            <td>{{$item->nomor_antrian}}</td>
                            <td>{{$item->nama}}</td>
                            <td>{{$item->nmPoli}}</td>
                            <td>#</td>
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